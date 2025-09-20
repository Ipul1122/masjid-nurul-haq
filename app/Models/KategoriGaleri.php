<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class KategoriGaleri extends Model
{

    use HasFactory;
    protected $fillable = ['nama'];

    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'kategori_id');
    }
}
