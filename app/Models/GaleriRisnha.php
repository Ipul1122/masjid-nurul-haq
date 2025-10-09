<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriRisnha extends Model
{
    use HasFactory;

    protected $table = 'galeri_risnhas';
    protected $fillable = [
        'nama_galeri',
        'kategori_galeri_risnha_id',
        'foto',
        'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriGaleriRisnha::class, 'kategori_galeri_risnha_id');
    }
}
