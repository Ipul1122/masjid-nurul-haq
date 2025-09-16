<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriArtikel extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    // Relasi ke Artikel
    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'kategori_id');
    }

}
