<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sponsor extends Model
{
    // use HasFactory;
    protected $fillable = ['id','id_event','nama_sponsor','logo','deskripsi'];
    public $timestamps = true;

    // relasi ke tabel Merk
    public function event()
    {
        return $this->BelongsTo(event::class, 'id_event');
    }
}
