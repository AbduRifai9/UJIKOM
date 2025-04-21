<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class event extends Model
{
    protected $fillable = [
        'id', 'nama_event', 'slug', 'deskripsi', 'poster', 'tanggal_event', 'waktu_event',
        'tanggal_selesai', 'waktu_selesai', 'id_lokasi', 'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->slug = Str::slug($event->nama_event);
        });

        static::updating(function ($event) {
            $event->slug = Str::slug($event->nama_event);
        });
    }

    public function lokasi()
    {
        return $this->belongsTo(lokasi::class, 'id_lokasi');
    }

    public function sponsor()
    {
        return $this->hasMany(sponsor::class);
    }

    public function tiket()
    {
        return $this->hasMany(tiket::class);
    }
}
