<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelRisnha extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori_artikel_risnha_id',
        'foto',
        'deskripsi',
    ];

    /**
     * Get the kategori for the artikel.
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriArtikelRisnha::class, 'kategori_artikel_risnha_id');
    }
}
