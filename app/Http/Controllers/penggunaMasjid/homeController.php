<?php

namespace App\Http\Controllers\penggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\TampilanPenggunaMasjid\HomeSection;
use App\Models\Artikel;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

// app/Http/Controllers/penggunaMasjid/homeController.php

// ... (namespace dan use statements sudah ada)

class HomeController extends Controller
{
    public function index()
    {
        $homeSections = HomeSection::all();

        // Mengambil 5 artikel terbaru (ini sudah benar)
        $artikel = Artikel::latest()->take(5)->get()->map(function($item) {
            $item->type = 'artikel';
            return $item;
        });

        // --- UBAH BAGIAN INI ---
        // Mengambil 5 kegiatan terbaru yang sudah di-publish
        $kegiatan = Kegiatan::where('status', 'published') // Tambahkan baris ini
            ->latest()
            ->take(5)
            ->get()
            ->map(function($item) {
                $item->type = 'kegiatan';
                return $item;
            });

        // Menggabungkan dan mengurutkan berdasarkan tanggal terbaru
        $kontenTerbaru = $artikel->merge($kegiatan)->sortByDesc('created_at');

        return view('index', compact('homeSections', 'kontenTerbaru'));
    }
}