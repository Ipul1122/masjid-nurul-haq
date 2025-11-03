<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturDkm extends Model
{
    use HasFactory;

    /**
     * Tentukan nama tabel jika tidak sesuai konvensi.
     *
     * @var string
     */
    protected $table = 'struktur_dkms';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'divisi',
        'gambar',
    ];
}