<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_tiket extends Model
{
    // use HasFactory;
    protected $fillable = ['id', 'id_pemesanan', 'id_tiket', 'id_pembayaran', 'expired_at', 'status', 'qr_code', 'qr_path'];
    public $timestamps = true;

    // relasi ke tabel Merk
    public function pemesanan()
    {
        return $this->BelongsTo(pemesanan::class, 'id_pemesanan');
    }

    public function tiket()
    {
        return $this->BelongsTo(tiket::class, 'id_tiket');
    }

    public function pembayaran()
    {
        return $this->BelongsTo(pembayaran::class, 'id_pembayaran');
    }
}
