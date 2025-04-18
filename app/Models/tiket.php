<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiket extends Model
{
    // use HasFactory;
    protected $fillable = ['id', 'event_id', 'jenis_tiket', 'harga_tiket', 'kuota_tiket', 'tiket_terjual', 'tiket_kadaluwarsa'];
    public $timestamps = true;

    // relasi ke tabel Merk
    public function event()
    {
        return $this->BelongsTo(event::class, 'event_id');
    }

    public function pemesanan()
    {
        return $this->HasMany(pemesanan::class);
    }

    public function detail_tiket()
    {
        return $this->HasMany(detail_tiket::class);
    }
}
