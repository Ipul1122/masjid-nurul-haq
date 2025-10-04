<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKegiatanRisnha extends Model
{
    use HasFactory;

    protected $table = 'kategori_kegiatan_risnhas';

    protected $fillable = [
        'nama_kategori',
    ];
}
