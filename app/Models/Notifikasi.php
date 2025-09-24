<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $fillable = [
        'dkm_id',
        'aksi',
        'tabel',
        'keterangan',
    ];

    public function dkm()
    {
        return $this->belongsTo(Dkm::class);
    }
}
