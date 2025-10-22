<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasiRisnha extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi_risnhas';

    protected $fillable = [
        'gambar_organisasi',
        'deskripsi',
    ];
}