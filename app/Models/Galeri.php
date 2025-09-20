<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = ['kategori_id', 'judul', 'tanggal', 'gambar', 'deskripsi'];

    protected $casts = [
        'gambar' => 'array',
        'tanggal' => 'date',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriGaleri::class, 'kategori_id');
    }
}
