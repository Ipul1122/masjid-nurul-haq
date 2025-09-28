<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Artikel;
use App\Models\JadwalImam;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKegiatan = Kegiatan::count();
        $jumlahArtikel = Artikel::count();
        $jumlahJadwalImam = JadwalImam::count();;
        return view('dkm.dashboard', compact(
        'jumlahKegiatan', 
        'jumlahArtikel',
                'jumlahJadwalImam'
            ));
    }
}
