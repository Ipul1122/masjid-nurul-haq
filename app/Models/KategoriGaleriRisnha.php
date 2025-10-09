<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGaleriRisnha extends Model
{
    use HasFactory;

    protected $table = 'kategori_galeri_risnhas'; // nama tabel

    protected $fillable = [
        'nama_kategori',
    ];
}
