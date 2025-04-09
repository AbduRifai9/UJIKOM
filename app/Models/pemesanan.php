<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    // use HasFactory;
    protected $fillable = ['id', 'id_user', 'id_tiket', 'kuantitas', 'total_harga', 'status'];
    public $timestamps  = true;

    // relasi ke tabel Merk
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'id_tiket');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pemesanan');
    }
}
