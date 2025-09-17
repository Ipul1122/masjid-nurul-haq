<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPemasukkan extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function pemasukkans()
    {
        return $this->hasMany(Pemasukkan::class, 'kategori_id');
    }
}
