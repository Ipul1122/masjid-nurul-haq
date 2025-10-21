<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\KegiatanRisnha;
use App\Models\ArtikelRisnha;
use App\Models\TampilanPenggunaMasjid\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RisnhaHomeController extends Controller
{
    public function index()
    {
        // Ambil kegiatan dan standarkan atributnya
        $kegiatan = KegiatanRisnha::where('status', 'published')
            ->latest()
            ->get()
            ->map(function ($item) {
                $item->judul = $item->nama;
                $item->foto = $item->gambar;
                $item->type = 'kegiatan';
                return $item;
            });

        // Ambil artikel dan standarkan atributnya
        $artikel = ArtikelRisnha::where('status', 'published')
            ->latest()
            ->get()
            ->map(function ($item) {
                $item->judul = $item->nama;
                $item->type = 'artikel';
                return $item;
            });

        // ✅ Gunakan concat agar tidak overwrite
        $kontenRisnha = $kegiatan
            ->concat($artikel) // tidak overwrite key numerik
            ->sortByDesc('created_at')
            ->values() // reset key
            ->take(6);

        $homeSection = HomeSection::all();

        return view('penggunaMasjid.risnhaMasjid.index', compact('kontenRisnha', 'homeSection'));
    }

    // Menampilkan detail kegiatan
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

         // Tambahkan setelah variabel $kegiatan atau $item sudah ada
    $kontenSebelumnya = KegiatanRisnha::where('id', '>', $kegiatan->id)
        ->orderBy('id', 'asc')
        ->take(5)
        ->get();

        return view('penggunaMasjid.risnhaMasjid.lihatKontenRisnha', [
            'item' => $kegiatan,
            'kontenSebelumnya' => $kontenSebelumnya,
        ]);
    }

    // Menampilkan detail artikel
    public function showArtikel(ArtikelRisnha $artikel, $slug = null)
    {
        if ($artikel->status !== 'published') {
            abort(404);
        }

        if ($slug !== $artikel->slug) {
            return redirect()->route('penggunaMasjid.risnhaMasjid.showArtikel', [
                'artikel' => $artikel->id,
                'slug' => $artikel->slug
            ], 301);
        }

        
    $kontenSebelumnya = ArtikelRisnha::where('id', '>', $artikel->id)
        ->orderBy('id', 'asc')
        ->take(5)
        ->get();


        return view('penggunaMasjid.risnhaMasjid.lihatKontenRisnha', [
            'item' => $artikel,
            'kontenSebelumnya' => $kontenSebelumnya,
        ]);
    }
}
