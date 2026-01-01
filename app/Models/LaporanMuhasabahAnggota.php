<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMuhasabahAnggota extends Model
{
    use HasFactory;

    protected $table = 'laporan_muhasabah_anggotas';

    protected $fillable = [
        'anggota_id',
        'muhasabah_soal_id',
        'jawaban',
        'tanggal',
    ];

    // Relasi ke Anggota
    public function anggota()
    {
        return $this->belongsTo(MuhasabahAnggota::class, 'anggota_id');
    }

    // Relasi ke Soal
    public function soal()
    {
        return $this->belongsTo(MuhasabahSoal::class, 'muhasabah_soal_id');
    }
}