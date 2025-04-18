<?php
namespace App\Http\Controllers;

use App\Models\detail_tiket;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
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

            // Pastikan format order_id valid
            $parts = explode('-', $orderId);
            if (count($parts) < 2 || ! is_numeric($parts[1])) {
                throw new \Exception('Format order_id tidak valid: ' . $orderId);
            }

            $pemesananId = $parts[1];
            $pemesanan   = Pemesanan::with('tiket.event')->findOrFail($pemesananId);

            // Tentukan status pembayaran
            $status = match ($transactionStatus) {
                'capture' => $fraudStatus == 'challenge' ? 'pending' : 'success',
                'settlement' => 'success', // Pastikan status settlement langsung dianggap berhasil
                'pending' => 'pending',
                'deny', 'expire', 'cancel' => 'failed',
                default => 'failed',
            };

            $pembayaran = null;

            DB::transaction(function () use (&$pembayaran, $notification, $pemesanan, $status) {
                $pemesanan->update([
                    'status'  => match ($status) {
                        'success' => 'Sudah Bayar',
                        'pending' => 'Pending',
                        default   => 'Gagal'
                    },
                ]);

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
            });

            if ($status === 'success') {
                try {
                    $sudahAda = detail_tiket::where('id_pemesanan', $pemesanan->id)->exists();

                    if (! $sudahAda) {
                        $expiredAt = now()->addDay();
                        $event     = $pemesanan->tiket->event ?? null;

                        if ($event && $event->tanggal_selesai && $event->waktu_selesai) {
                            $expiredAt = \Carbon\Carbon::parse($event->tanggal_selesai . ' ' . $event->waktu_selesai);
                        }

                        // Buat kode unik QR & path
                        $kodeUnik = 'QR-' . strtoupper(Str::random(10)) . '-' . $pemesanan->id;
                        $fileName = 'qr_codes/' . $kodeUnik . '.png';
                        $qrPath   = storage_path('app/public/' . $fileName);

                        Log::info('Mau generate QR', ['path' => $qrPath, 'kode' => $kodeUnik]);

                        // Generate QR
                        QrCode::format('png')->size(300)->driver('gd')->generate($kodeUnik, $qrPath);

                        Log::info('Berhasil generate QR');

                        // Simpan ke DB
                        detail_tiket::create([
                            'id_pemesanan'  => $pemesanan->id,
                            'id_tiket'      => $pemesanan->id_tiket,
                            'id_pembayaran' => $pembayaran->id,
                            'status'        => 'Belum Digunakan',
                            'expired_at'    => $expiredAt,
                            'qr_code'       => $kodeUnik,
                            'qr_path'       => 'storage/' . $fileName,
                        ]);

                        Log::info('Detail tiket & QR berhasil dibuat untuk pemesanan ID: ' . $pemesanan->id);
                    }
                } catch (\Exception $e) {
                    Log::error('Gagal membuat QR Code: ' . $e->getMessage());
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
