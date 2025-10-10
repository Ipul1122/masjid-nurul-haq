<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Impor model-model yang dibutuhkan
use App\Models\ArtikelRisnha;
use App\Models\GaleriRisnha;
use App\Models\KegiatanRisnha;

class DashboardRisnhaController extends Controller
{
    public function index()
    {
        // Hitung jumlah data dari masing-masing tabel
        $jumlahArtikel = ArtikelRisnha::count();
        $jumlahGaleri = GaleriRisnha::count();
        $jumlahKegiatan = KegiatanRisnha::count();

        // Kirim data ke view
        return view('risnha.dashboard', [
            'jumlahArtikel' => $jumlahArtikel,
            'jumlahGaleri' => $jumlahGaleri,
            'jumlahKegiatan' => $jumlahKegiatan,
        ]);
    }
}