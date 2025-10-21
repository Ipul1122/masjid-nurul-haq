<?php

namespace App\Http\Controllers\penggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\ArtikelRisnha;
use App\Models\KegiatanRisnha;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class KontenRisnhaController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'semua');

        // Ambil semua artikel dan tambahkan properti 'tipe'
        $artikel = ArtikelRisnha::latest()->get()->map(function ($item) {
            $item->tipe = 'artikel';
            return $item;
        });

        // Ambil semua kegiatan dan tambahkan properti 'tipe'
        $kegiatan = KegiatanRisnha::latest()->get()->map(function ($item) {
            $item->tipe = 'kegiatan';
            return $item;
        });

        // Gabungkan kedua collection, urutkan berdasarkan tanggal terbaru
        $semuaKonten = $artikel->concat($kegiatan)->sortByDesc('created_at')->values();

        // Terapkan filter
        $kontenDaring = collect();
        if ($filter === 'artikel') {
            $kontenDaring = $semuaKonten->where('tipe', 'artikel');
        } elseif ($filter === 'kegiatan') {
            $kontenDaring = $semuaKonten->where('tipe', 'kegiatan');
        } else {
            $kontenDaring = $semuaKonten;
        }

        // Buat paginasi secara manual
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $kontenDaring->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $konten = new LengthAwarePaginator(
            $currentPageItems,
            $kontenDaring->count(),
            $perPage,
            $currentPage,
            // Penting: agar filter tetap aktif saat pindah halaman
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('penggunaMasjid.risnhaMasjid.kontenRisnha', compact('konten', 'filter'));
    }

    public function show($type, $id)
    {
        $konten = null;
        $imagePath = '';
        $model = null;

        if ($type === 'artikel') {
            $model = new ArtikelRisnha();
            $konten = $model->findOrFail($id);
            $imagePath = 'images/artikel_risnha/';
        } elseif ($type === 'kegiatan') {
            $model = new KegiatanRisnha();
            $konten = $model->findOrFail($id);
            $imagePath = 'images/kegiatan_risnha/';
        } else {
            abort(404);
        }

        $kontenSebelumnya = $model::where('id', '!=', $id)->latest()->take(5)->get();

        return view('penggunaMasjid.risnhaMasjid.lihatKontenRisnha', compact('konten', 'imagePath', 'type', 'kontenSebelumnya'));
    }
}