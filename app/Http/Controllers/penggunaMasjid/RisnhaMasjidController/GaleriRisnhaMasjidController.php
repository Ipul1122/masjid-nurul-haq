<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\GaleriRisnha;
use App\Models\KategoriGaleriRisnha; // Tambahkan ini
use Illuminate\Http\Request;

class GaleriRisnhaMasjidController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua kategori untuk ditampilkan sebagai filter
        $kategories = KategoriGaleriRisnha::all();

        // Query dasar untuk galeri
        $query = GaleriRisnha::latest();

        // Jika ada request filter kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        // Ambil data dengan pagination dan pertahankan query string saat berpindah halaman
        $galeries = $query->paginate(10)->withQueryString();

        return view('penggunaMasjid.risnhaMasjid.galeriRisnhaMasjid', compact('galeries', 'kategories'));
    }
}