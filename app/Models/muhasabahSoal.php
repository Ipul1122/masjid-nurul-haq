<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuhasabahSoal extends Model
{
    use HasFactory;

    protected $table = 'muhasabah_soals';

    protected $fillable = [
        'pertanyaan',
        'deskripsi',
        'tipe_soal',
        'opsi_jawaban',
        'is_required',
        'urutan',
        'is_active',
    ];

    // Magic: Otomatis convert JSON <-> Array
    protected $casts = [
        'opsi_jawaban' => 'array',
        'is_active' => 'boolean',
        'is_required' => 'boolean',
    ];
}