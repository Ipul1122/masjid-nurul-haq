<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NotifikasiRisnha extends Model
{
    use HasFactory;

    protected $fillable = [
        'risnha_id',
        'aksi',
        'tabel',
        'keterangan',
    ];

    public function risnha()
    {
        return $this->belongsTo(\App\Models\Risnha::class, 'risnha_id');
    }

    // Scope untuk notifikasi < 5 menit
    public function scopeValid($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->subMinutes(5));
    }
}
