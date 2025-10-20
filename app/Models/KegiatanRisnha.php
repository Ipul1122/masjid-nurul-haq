<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KegiatanRisnha extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'nama',
        'foto',
        'deskripsi',
        'kategori_kegiatan_risnha_id',
        'status',
    ];

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriKegiatanRisnha::class, 'kategori_kegiatan_risnha_id');
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->nama);
    }
}
