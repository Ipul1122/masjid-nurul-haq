<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Kegiatan extends Model
{
    protected $table = 'kegiatans';
    protected $fillable = [
        'judul',
        'nama_ustadz',
        'gambar',
        'jadwal',
        'catatan',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
