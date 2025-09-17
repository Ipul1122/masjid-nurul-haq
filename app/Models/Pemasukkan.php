<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukkan extends Model
{
    use HasFactory;

    protected $fillable = [
        'total', // simpan angka murni (tanpa Rp/. dan titik)
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
