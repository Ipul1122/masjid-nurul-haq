<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'tanggal_rilis',
    ];

    protected $casts = [
        'tanggal_rilis' => 'date',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
