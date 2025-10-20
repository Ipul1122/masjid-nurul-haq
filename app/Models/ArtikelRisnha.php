<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ArtikelRisnha extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori_artikel_risnha_id',
        'gambar',
        'deskripsi',
        'status',
    ];

    /**
     * Get the kategori for the artikel.
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriArtikelRisnha::class, 'kategori_artikel_risnha_id');
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->nama);
    }
}
