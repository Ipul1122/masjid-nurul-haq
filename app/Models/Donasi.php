<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Donasi extends Model
{
    use HasFactory;

    // WAJIB: Izinkan kolom ini diisi secara massal (Mass Assignment)
    protected $fillable = [
        'nama_donatur',
        'nominal',
        'pesan',
    ];

    // Opsional: Accessor untuk memformat tanggal otomatis ke format Indonesia
    public function getTanggalFormatIndoAttribute()
    {
        return Carbon::parse($this->created_at)->locale('id')->translatedFormat('d F Y, H:i');
    }
}