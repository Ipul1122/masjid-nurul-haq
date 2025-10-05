<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\KategoriArtikelRisnha;
use App\Models\NotifikasiRisnha; // <-- 1. Tambahkan model NotifikasiRisnha
use Illuminate\Http\Request;

class KategoriArtikelRisnhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriArtikelRisnha = KategoriArtikelRisnha::all();
        return view('risnha.kategori.artikelRisnha.index', compact('kategoriArtikelRisnha'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('risnha.kategori.artikelRisnha.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_artikel_risnhas,nama',
        ]);

        $kategori = KategoriArtikelRisnha::create($request->all());

        // <-- 2. Buat Notifikasi untuk aksi 'create'
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'create',
            'tabel' => 'kategori_artikel_risnhas',
            'keterangan' => "Menambahkan kategori artikel: " . $kategori->nama,
        ]);

        return redirect()->route('risnha.kategori.artikelRisnha.index')
                         ->with('success', 'Kategori artikel berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = KategoriArtikelRisnha::findOrFail($id);
        return view('risnha.kategori.artikelRisnha.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori = KategoriArtikelRisnha::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_artikel_risnhas,nama,' . $kategori->id,
        ]);

        $kategori->update($request->all());

        // <-- 3. Buat Notifikasi untuk aksi 'update'
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'update',
            'tabel' => 'kategori_artikel_risnhas',
            'keterangan' => "Memperbarui kategori artikel: " . $kategori->nama,
        ]);

        return redirect()->route('risnha.kategori.artikelRisnha.index')
                         ->with('success', 'Kategori artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = KategoriArtikelRisnha::findOrFail($id);

        // <-- 4. Buat Notifikasi untuk aksi 'delete'
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'delete',
            'tabel' => 'kategori_artikel_risnhas',
            'keterangan' => "Menghapus kategori artikel: " . $kategori->nama,
        ]);

        $kategori->delete();

        return redirect()->route('risnha.kategori.artikelRisnha.index')
                         ->with('success', 'Kategori artikel berhasil dihapus.');
    }
}

