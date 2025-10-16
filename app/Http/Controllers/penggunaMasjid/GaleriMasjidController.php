<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;

class GaleriMasjidController extends Controller
{
    // app/Http/Controllers/PenggunaMasjid/GaleriController.php

    public function index(Request $request)
    {
       $query = Galeri::latest();

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $galeris = $query->paginate(10);

        // Mengambil tahun unik dari data galeri yang ada
        $years = Galeri::selectRaw('YEAR(tanggal) as year')
                        ->distinct()
                        ->orderBy('year', 'desc')
                        ->pluck('year');

        $kategoris = KategoriGaleri::all();
        return view('penggunaMasjid.galeriMasjid.index', compact('galeris', 'years', 'kategoris'));
    }
}
