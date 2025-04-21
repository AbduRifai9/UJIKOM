<?php
namespace App\Http\Controllers;

use App\Models\detail_tiket;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Notification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
    }

    public function callback(Request $request)
    {
        try {
            $notification = new Notification();

            Log::info('Midtrans Callback', [
                'transaction_status' => $notification->transaction_status,
                'fraud_status'       => $notification->fraud_status,
                'order_id'           => $notification->order_id,
                'payment_type'       => $notification->payment_type,
                'gross_amount'       => $notification->gross_amount,
                'transaction_id'     => $notification->transaction_id,
            ]);

            $transactionStatus = $notification->transaction_status;
            $fraudStatus       = $notification->fraud_status;
            $orderId           = $notification->order_id;

            // Validasi order_id
            $parts = explode('-', $orderId);
            if (count($parts) < 2 || ! is_numeric($parts[1])) {
                throw new \Exception('Format order_id tidak valid: ' . $orderId);
            }

            $pemesananId = $parts[1];
            $pemesanan   = Pemesanan::with('tiket.event')->findOrFail($pemesananId);

            // Status Midtrans → internal status
            $status = match ($transactionStatus) {
                'capture' => $fraudStatus === 'challenge' ? 'pending' : 'success',
                'settlement' => 'success',
                'pending' => 'pending',
                'deny', 'expire', 'cancel' => 'failed',
                default => 'failed',
            };

            DB::transaction(function () use ($notification, $pemesanan, $status) {

                // Jangan turunkan status jika sudah "Sudah Bayar"
                if ($pemesanan->status !== 'Sudah Bayar') {
                    $pemesanan->update([
                        'status'  => match ($status) {
                            'success' => 'Sudah Bayar',
                            'pending' => 'Pending',
                            default   => 'Gagal',
                        },
                    ]);
                }

                // Update atau buat pembayaran
                $currentPayment = Pembayaran::where('pemesanan_id', $pemesanan->id)->first();

                if (! $currentPayment || $currentPayment->status_pembayaran !== 'success') {
                    $pembayaran = Pembayaran::updateOrCreate(
                        ['pemesanan_id' => $pemesanan->id],
                        [
                            'status_pembayaran'     => $status,
                            'metode_pembayaran'     => $notification->payment_type ?? null,
                            'jumlah_pembayaran'     => $notification->gross_amount ?? 0,
                            'waktu_pembayaran'      => now(),
                            'snap_token'            => null,
                            'midtrans_booking_code' => $notification->transaction_id ?? null,
                        ]
                    );
                }

                // Jika pembayaran berhasil dan detail_tiket belum dibuat
                if ($status === 'success') {
                    $sudahAda = detail_tiket::where('id_pemesanan', $pemesanan->id)->exists();

                    if (! $sudahAda) {
                        $event     = $pemesanan->tiket->event ?? null;
                        $expiredAt = $event && $event->tanggal_selesai && $event->waktu_selesai
                        ? Carbon::parse($event->tanggal_selesai . ' ' . $event->waktu_selesai)
                        : now()->addDay();

                        // Buat kode QR unik
                        $kodeUnik = 'QR-' . strtoupper(Str::random(10)) . '-' . $pemesanan->id;
                        $fileName = 'qr_codes/' . $kodeUnik . '.svg';

                        // Generate QR & simpan ke storage
                        $qrImage = QrCode::format('svg')->size(300)->generate($kodeUnik);
                        \Storage::disk('public')->put($fileName, $qrImage);

                        // Simpan detail tiket
                        detail_tiket::create([
                            'id_pemesanan'  => $pemesanan->id,
                            'id_tiket'      => $pemesanan->id_tiket,
                            'id_pembayaran' => $pembayaran->id,
                            'status'        => 'Belum Digunakan',
                            'expired_at'    => $expiredAt,
                            'qr_code'       => $kodeUnik,
                            'qr_path'       => 'storage/' . $fileName,
                        ]);

                        Log::info("Detail tiket berhasil dibuat untuk pemesanan ID: {$pemesanan->id}");
                    }
                }
            });

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function verifikasiQRCode($kode)
    {
        try {
            $detail = detail_tiket::with(['pemesanan.user', 'pemesanan.tiket.event'])
                ->where('qr_code', $kode)
                ->first();

            if (! $detail) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'QR Code tidak ditemukan.',
                ]);
            }

            // Cek apakah QR sudah expired
            if ($detail->expired_at && now()->greaterThan($detail->expired_at)) {
                return response()->json([
                    'status'  => 'expired',
                    'message' => 'QR Code sudah kadaluarsa.',
                ]);
            }

            // Cek apakah sudah digunakan
            if ($detail->status === 'Sudah Digunakan') {
                return response()->json([
                    'status'  => 'used',
                    'message' => 'QR Code sudah digunakan.',
                ]);
            }

            // Tandai sebagai sudah digunakan (kalau memang ingin sekali pakai)
            $detail->update(['status' => 'Sudah Digunakan']);

            return response()->json([
                'status'  => 'valid',
                'message' => 'QR Code valid.',
                'data'    => [
                    'nama'        => $detail->pemesanan->user->name ?? '-',
                    'event'       => $detail->pemesanan->tiket->event->nama_event ?? '-',
                    'jenis_tiket' => $detail->pemesanan->tiket->jenis_tiket ?? '-',
                    'expired_at'  => $detail->expired_at,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
