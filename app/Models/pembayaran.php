<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    // use HasFactory;
    protected $fillable = ['id', 'id_pemesanan', 'jumlah_pembayaran', 'status_pembayaran', 'metode_pembayaran'];
    public $timestamps = true;

    // relasi ke tabel Merk
    public function pemesanan()
    {
        return $this->BelongsTo(pemesanan::class, 'id_pemesanan');
    }

    public function detail_tiket()
    {
        return $this->HasMany(detail_tiket::class);
    }
}
