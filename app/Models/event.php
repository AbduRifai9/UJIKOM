<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    // use HasFactory;
    protected $fillable = ['id','nama_event','deskripsi','poster','tanggal_event','waktu_event','tanggal_selesai','waktu_selesai','id_lokasi','status'];
    public $timestamps = true;

    // relasi ke tabel Merk
    public function lokasi()
    {
        return $this->BelongsTo(lokasi::class, 'id_lokasi');
    }

    public function sponsor()
    {
        return $this->HasMany(sponsor::class);
    }

    public function tiket()
    {
        return $this->HasMany(tiket::class);
    }
}
