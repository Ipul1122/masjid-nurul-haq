<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class MuhasabahAnggota extends Authenticatable
{
    use HasFactory;

    protected $table = 'muhasabah_anggotas';

    protected $fillable = [
        'group_id',
        'nama_lengkap',
        'no_wa',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi balik: Anggota ini milik Group siapa?
    public function group()
    {
        return $this->belongsTo(MuhasabahGroup::class, 'group_id');
    }
}