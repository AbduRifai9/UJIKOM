<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

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
            // Tangkap notifikasi Midtrans
            $notification = new Notification();

            // Ubah menjadi array untuk dicatat ke log
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

            // Pastikan format order ID sesuai
            $parts = explode('-', $orderId);
            if (count($parts) < 2) {
                throw new \Exception('Format order_id tidak valid: ' . $orderId);
            }

            $pemesananId = $parts[1];

            $pemesanan = Pemesanan::find($pemesananId);
            if (! $pemesanan) {
                throw new \Exception('Pemesanan tidak ditemukan: ' . $pemesananId);
            }

            // Tentukan status pembayaran
            $status = match ($transactionStatus) {
                'capture' => $fraudStatus == 'challenge' ? 'pending' : 'success',
                'settlement' => 'success',
                'pending' => 'pending',
                'deny', 'expire', 'cancel' => 'failed',
                default => 'failed',
            };

            // Update status di tabel pemesanan
            $pemesanan->update([
                'status'  => match ($status) {
                    'success' => 'Sudah Bayar',
                    'pending' => 'Pending',
                    default   => 'Gagal'
                },
            ]);

            // Simpan data pembayaran — snap_token mungkin tidak tersedia
            Pembayaran::updateOrCreate(
                ['pemesanan_id' => $pemesanan->id],
                [
                    'status_pembayaran'     => $status,
                    'metode_pembayaran'     => $notification->payment_type ?? null,
                    'jumlah_pembayaran'     => $notification->gross_amount ?? 0,
                    'waktu_pembayaran'      => now(),
                    'snap_token'            => null, // Jangan pakai session di callback Midtrans
                    'midtrans_booking_code' => $notification->transaction_id ?? null,
                ]
            );

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
