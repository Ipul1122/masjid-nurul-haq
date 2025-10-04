<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanRisnha extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'nama',
        'foto',
        'deskripsi',
        'kategori_kegiatan_risnha_id',
    ];

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriKegiatanRisnha::class, 'kategori_kegiatan_risnha_id');
    }
}
