<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriArtikel;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'tanggal_rilis',
        'kategori_id',
        'status',
    ];

    protected $casts = [
        'tanggal_rilis' => 'date',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriArtikel::class, 'kategori_id');
    }

}
