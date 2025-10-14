<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\TampilanPenggunaMasjid\HomeSection;
use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\JadwalImam; 
use Illuminate\Http\Request;

// app/Http/Controllers/penggunaMasjid/homeController.php

// ... (namespace dan use statements sudah ada)

class HomeController extends Controller
{
    public function index()
    {
        $homeSections = HomeSection::all();

         // Mengambil 5 artikel terbaru yang sudah di-publish
        $artikel = Artikel::where('status', 'published') 
            ->latest()
            ->take(5)
            ->get()
            ->map(function($item) {
                $item->type = 'artikel';
                return $item;
            });

        // Mengambil 5 kegiatan terbaru yang sudah di-publish
        $kegiatan = Kegiatan::where('status', 'published')
            ->latest()
            ->take(5)
            ->get()
            ->map(function($item) {
                $item->type = 'kegiatan';
                return $item;
            });

        // Menggabungkan dan mengurutkan berdasarkan tanggal terbaru
         $kontenTerbaru = $artikel->merge($kegiatan)
                                 ->sortByDesc('created_at')
                                 ->take(6); 

        $jadwalImam = JadwalImam::latest()->get();

        return view('index', compact('homeSections', 'kontenTerbaru', 'jadwalImam'));
    }
}