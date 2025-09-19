<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'gambar',
    ];

    /**
     * Casts atribut ke tipe data asli.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'gambar' => 'array', // Otomatis konversi JSON ke Array
        'tanggal' => 'date',
    ];
}