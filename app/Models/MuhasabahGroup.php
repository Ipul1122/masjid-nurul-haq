<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Penting untuk Auth nanti

// Kita extend Authenticatable agar model ini bisa dipakai login
class MuhasabahGroup extends Authenticatable
{
    use HasFactory;

    protected $table = 'muhasabah_groups';

    protected $fillable = [
        'nama_group',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function anggotas()
    {
        return $this->hasMany(MuhasabahAnggota::class, 'group_id');
    }
}