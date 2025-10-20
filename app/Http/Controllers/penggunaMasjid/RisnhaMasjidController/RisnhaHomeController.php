<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\KegiatanRisnha;
use App\Models\ArtikelRisnha; // <-- Import the ArtikelRisnha model
use Illuminate\Http\Request;

class RisnhaHomeController extends Controller
{
    // app/Http/Controllers/penggunaMasjid/RisnhaMasjidController/RisnhaHomeController.php

    public function index()
    {
        // Ambil kegiatan dan standarkan nama propertinya
        $kegiatan = KegiatanRisnha::where('status', 'published')
            ->latest()
            ->get()
            ->map(function($item) {
                $item->judul = $item->nama; // Mengubah 'nama' menjadi 'judul'
                $item->foto = $item->gambar; // Mengubah 'foto' menjadi 'gambar'
                $item->type = 'kegiatan';
                return $item;
            });

        // Ambil artikel dan standarkan nama propertinya
        $artikel = ArtikelRisnha::where('status', 'published')
            ->latest()
            ->get()
            ->map(function($item) {
                $item->judul = $item->nama; // Mengubah 'nama' menjadi 'judul'
                // Properti 'gambar' sudah ada, jadi tidak perlu diubah
                $item->type = 'artikel';
                return $item;
            });

        // Gabungkan, urutkan, dan kirim ke view
        $kontenRisnha = $kegiatan->merge($artikel)
                                ->sortByDesc('created_at')
                                ->take(6);

        return view('penggunaMasjid.risnhaMasjid.index', compact('kontenRisnha'));
    }

    // Method untuk menampilkan detail kegiatan
    public function show(KegiatanRisnha $kegiatan, $slug = null)
    {
        if ($kegiatan->status !== 'published') {
            abort(404);
        }

        if ($slug !== $kegiatan->slug) {
            return redirect()->route('penggunaMasjid.risnhaMasjid.show', [
                'kegiatan' => $kegiatan->id,
                'slug' => $kegiatan->slug
            ], 301);
        }
        
        return view('penggunaMasjid.risnhaMasjid.lihatKontenRisnha', ['item' => $kegiatan]);
    }

    /**
     * Perbarui method ini untuk menerima dan memvalidasi slug.
     */
    public function showArtikel(ArtikelRisnha $artikel, $slug = null)
    {
        if ($artikel->status !== 'published') {
            abort(404);
        }

        // Jika slug di URL tidak cocok dengan slug yang seharusnya, arahkan ke URL yang benar
        if ($slug !== $artikel->slug) {
            return redirect()->route('penggunaMasjid.risnhaMasjid.showArtikel', [
                'artikel' => $artikel->id,
                'slug' => $artikel->slug
            ], 301); // 301 redirect baik untuk SEO
        }

        return view('penggunaMasjid.risnhaMasjid.lihatKontenRisnha', ['item' => $artikel]);
    }
}