<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    // use HasFactory;
    protected $fillable = ['id', 'nama_alamat', 'alamat_lokasi', 'kapasitas', 'foto', 'url'];
    protected $visible = ['id', 'nama_alamat', 'alamat_lokasi', 'kapasitas', 'foto', 'url'];
    public $timestamps = true;

    // // relasi ke tabel Merk
    // public function Merk()
    // {
    //     return $this->BelongsTo(Merk::class, 'id_merek');
    // }

    public function event()
    {
        return $this->HasMany(event::class);
    }
}
