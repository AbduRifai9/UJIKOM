<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notifikasi extends Model
{
    // use HasFactory;
    protected $fillable = ['id', 'id_user', 'judul_notifikasi', 'pesan_notifikasi'];
    public $timestamps = true;

    // relasi ke tabel Merk
    public function user()
    {
        return $this->BelongsTo(user::class, 'id_user');
    }
}
