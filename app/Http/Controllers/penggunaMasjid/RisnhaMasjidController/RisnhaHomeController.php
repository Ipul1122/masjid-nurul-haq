<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\KegiatanRisnha;
use App\Models\ArtikelRisnha; // <-- Import the ArtikelRisnha model
use Illuminate\Http\Request;

class RisnhaHomeController extends Controller
{
    public function index()
    {
        // Ambil kegiatan, standarkan nama properti, dan tambahkan tipe
        $kegiatan = KegiatanRisnha::where('status', 'published')
            ->latest()
            ->get()
            ->map(function($item) {
                $item->judul = $item->nama; // Standarkan 'nama' menjadi 'judul'
                $item->foto = $item->gambar; // Standarkan 'foto' menjadi 'gambar'
                $item->type = 'kegiatan';
                return $item;
            });

        // Ambil artikel, standarkan nama properti, dan tambahkan tipe
        $artikel = ArtikelRisnha::where('status', 'published')
            ->latest()
            ->get()
            ->map(function($item) {
                $item->judul = $item->nama; // Standarkan 'nama' menjadi 'judul'
                // 'gambar' sudah sesuai, tidak perlu diubah
                $item->type = 'artikel';
                return $item;
            });

        // Gabungkan kedua koleksi, urutkan, dan batasi jumlahnya
        $kontenRisnha = $kegiatan->merge($artikel)
                                 ->sortByDesc('created_at')
                                 ->take(9); // Ambil 9 konten terbaru

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