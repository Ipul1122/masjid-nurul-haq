<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\JadwalImam;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class KontenMasjidController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        // Ambil semua artikel dan kegiatan yang sudah dipublish
        $artikel = Artikel::where('status', 'published')->latest()->get()->map(function ($item) {
            $item->type = 'artikel';
            return $item;
        });

        $kegiatan = Kegiatan::where('status', 'published')->latest()->get()->map(function ($item) {
            $item->type = 'kegiatan';
            return $item;
        });

        // ✅ Gunakan concat bukan merge agar tidak replace
        $semuaKonten = $artikel->concat($kegiatan)->sortByDesc('created_at')->values();

        // Filter berdasarkan type
        if ($filter === 'artikel') {
            $kontenTerbaru = $semuaKonten->where('type', 'artikel');
        } elseif ($filter === 'kegiatan') {
            $kontenTerbaru = $semuaKonten->where('type', 'kegiatan');
        } else {
            $kontenTerbaru = $semuaKonten;
        }

        // Pagination manual
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $kontenTerbaru->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedItems = new LengthAwarePaginator(
            $currentPageItems,
            $kontenTerbaru->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        $jadwalImam = JadwalImam::latest()->get();

        return view('penggunaMasjid.lihatKonten.kontenMasjid', [
            'kontenTerbaru' => $paginatedItems,
            'jadwalImam' => $jadwalImam
        ]);
    }
}
