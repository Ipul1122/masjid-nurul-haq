<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiMisiRisnha extends Model
{
    use HasFactory;

    protected $table = 'visi_misi_risnhas';

    protected $fillable = [
        'visi',
        'misi',
    ];
}