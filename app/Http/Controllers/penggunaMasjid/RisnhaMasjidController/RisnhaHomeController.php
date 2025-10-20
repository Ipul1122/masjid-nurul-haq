<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\KegiatanRisnha;
use Illuminate\Http\Request;

class RisnhaHomeController extends Controller
{
    public function index()
    {
        $kegiatanRisnha = KegiatanRisnha::where('status', 'published')->latest()->paginate(9); 
        return view('penggunaMasjid.risnhaMasjid.index', compact('kegiatanRisnha'));
    }

    public function show(KegiatanRisnha $kegiatan, $slug = null)
    {
        // $kegiatan = KegiatanRisnha::where('status', 'published')->findOrFail($id);
        
        // Pastikan hanya konten yang sudah publish yang bisa diakses
        if ($kegiatan->status !== 'published') {
            abort(404);
        }

        // Jika slug di URL tidak cocok dengan slug yang seharusnya, arahkan ke URL yang benar
        if ($slug !== $kegiatan->slug) {
            return redirect()->route('penggunaMasjid.risnhaMasjid.show', [
                'kegiatan' => $kegiatan->id,
                'slug' => $kegiatan->slug
            ], 301); // 301 redirect baik untuk SEO
        }
        
        return view('penggunaMasjid.risnhaMasjid.lihatKontenRisnha', compact('kegiatan'));
    }
}
