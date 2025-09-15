<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = [
        'nama',
    ];

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'kategori_id');
    }
}
