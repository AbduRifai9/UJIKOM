<?php
namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    /**
     * Buat transaksi Snap Midtrans
     *
     * @param array $params
     * @return object
     */
    public function createTransaction(array $params)
    {
        return Snap::createTransaction($params);
    }
}
