<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    // use HasFactory;
    protected $fillable = ['id','id_user','id_tiket','kuantitas','total_harga','status'];
    public $timestamps = true;

    // relasi ke tabel Merk
    public function user()
    {
        return $this->BelongsTo(user::class, 'id_user');
    }

    public function tiket()
    {
        return $this->BelongsTo(tiket::class, 'id_tiket');
    }

    public function pembayaran()
    {
        return $this->HasMany(pembayaran::class);
    }

    public function detail_tiket()
    {
        return $this->HasMany(detail_tiket::class);
    }
}
