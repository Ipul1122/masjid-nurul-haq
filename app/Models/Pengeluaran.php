<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'total', // simpan angka murni (tanpa Rp/. dan titik)
        'tanggal',
        'kategori_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function kategori()
{
    return $this->belongsTo(KategoriPengeluaran::class, 'kategori_id');
}

}
