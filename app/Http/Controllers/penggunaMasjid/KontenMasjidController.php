<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\JadwalImam;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class KontenMasjidController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        // Mengambil semua artikel dan kegiatan yang sudah di-publish
        $artikel = Artikel::where('status', 'published')->latest()->get()->map(function($item) {
            $item->type = 'artikel';
            return $item;
        });

        $kegiatan = Kegiatan::where('status', 'published')->latest()->get()->map(function($item) {
            $item->type = 'kegiatan';
            return $item;
        });

        // Menggabungkan semua konten dan mengurutkan berdasarkan tanggal terbaru
        $semuaKonten = $artikel->merge($kegiatan)->sortByDesc('created_at');
        
        // Melakukan filter berdasarkan query
        if ($filter === 'artikel') {
            $kontenTerbaru = $semuaKonten->where('type', 'artikel');
        } elseif ($filter === 'kegiatan') {
            $kontenTerbaru = $semuaKonten->where('type', 'kegiatan');
        } else {
            $kontenTerbaru = $semuaKonten;
        }

        $perPage = 20; // Jumlah item per halaman diubah menjadi 20
        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $kontenTerbaru->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($kontenTerbaru), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => $request->query(),
        ]);

        $jadwalImam = JadwalImam::latest()->get();

        return view('penggunaMasjid.lihatKonten.kontenMasjid', [
            'kontenTerbaru' => $paginatedItems,
            'jadwalImam' => $jadwalImam
        ]);
    }
}