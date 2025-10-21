<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\TampilanPenggunaMasjid\HomeSection;
use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\JadwalImam; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan konten terbaru dari artikel dan kegiatan.
     */
    public function index()
    {
        // $homeSections = HomeSection::all();

        // Mengambil 6 artikel terbaru yang sudah di-publish sebagai "kandidat"
        $artikelMasjid = Artikel::where('status', 'published') 
            ->latest()
            ->get()
            ->map(function($item) {
                $item->type = 'artikel';
                return $item;
            });

        // Mengambil 6 kegiatan terbaru yang sudah di-publish sebagai "kandidat"
        $kegiatanMasjid = Kegiatan::where('status', 'published')
            ->latest()
            ->get()
            ->map(function($item) {
                $item->type = 'kegiatan';
                return $item;
            });

        // 1. Gabungkan DUA koleksi (total maks. 12 item).
        // 2. Urutkan berdasarkan tanggal pembuatan secara menurun.
        // 3. Ambil 6 item teratas dari hasil gabungan yang sudah terurut.
        $kontenTerbaru = collect()
            ->merge($artikelMasjid->take(3))
            ->merge($kegiatanMasjid->take(3))
            ->sortByDesc('created_at')
            ->values();

        $jadwalImam = JadwalImam::latest()->get();

        $homeSections = HomeSection::all();


        return view('index', compact( 'kontenTerbaru', 'jadwalImam', 'homeSections'));
    }
}
