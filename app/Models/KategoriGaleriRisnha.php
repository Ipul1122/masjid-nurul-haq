<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGaleriRisnha extends Model
{
    use HasFactory;

    protected $table = 'kategori_galeri_risnhas';
    protected $fillable = ['nama_kategori'];

    public function galeri()
    {
        return $this->hasMany(GaleriRisnha::class, 'kategori_galeri_risnha_id');
    }
}
