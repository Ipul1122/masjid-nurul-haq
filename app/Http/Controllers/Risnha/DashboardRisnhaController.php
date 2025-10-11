<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Impor model-model yang dibutuhkan
use App\Models\ArtikelRisnha;
use App\Models\GaleriRisnha;
use App\Models\KegiatanRisnha;
use App\Models\KategoriArtikelRisnha;
use App\Models\KategoriGaleriRisnha;
use App\Models\KategoriKegiatanRisnha;

class DashboardRisnhaController extends Controller
{
    public function index()
    {
        // Hitung jumlah data dari masing-masing tabel
        $jumlahArtikel = ArtikelRisnha::count();
        $jumlahGaleri = GaleriRisnha::count();
        $jumlahKegiatan = KegiatanRisnha::count();
        $jumlahKategoriArtikel = KategoriArtikelRisnha::count();
        $jumlahKategoriGaleri = KategoriGaleriRisnha::count();
        $jumlahKategoriKegiatan = KategoriKegiatanRisnha::count();

        // Kirim data ke view
        return view('risnha.dashboard', [
            'jumlahArtikel' => $jumlahArtikel,
            'jumlahGaleri' => $jumlahGaleri,
            'jumlahKegiatan' => $jumlahKegiatan,
            'jumlahKategoriArtikel' => $jumlahKategoriArtikel,
            'jumlahKategoriGaleri' => $jumlahKategoriGaleri,
            'jumlahKategoriKegiatan' => $jumlahKategoriKegiatan,
        ]);
    }
}