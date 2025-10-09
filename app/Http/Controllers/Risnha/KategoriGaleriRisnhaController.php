<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\KategoriGaleriRisnha;
use Illuminate\Http\Request;

class KategoriGaleriRisnhaController extends Controller
{
    /**
     * Menampilkan daftar kategori galeri.
     */
    public function index()
    {
        $kategori = KategoriGaleriRisnha::orderBy('id', 'DESC')->get();
        return view('risnha.kategori.galeriRisnha.index', compact('kategori'));
    }

    /**
     * Menampilkan form tambah kategori.
     */
    public function create()
    {
        return view('risnha.kategori.galeriRisnha.create');
    }

    /**
     * Simpan data kategori baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriGaleriRisnha::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('risnha.kategori.galeriRisnha.index')
                         ->with('success', 'Kategori galeri berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit kategori.
     */
    public function edit($id)
    {
        $kategori = KategoriGaleriRisnha::findOrFail($id);
        return view('risnha.kategori.galeriRisnha.edit', compact('kategori'));
    }

    /**
     * Update data kategori.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriGaleriRisnha::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('risnha.kategori.galeriRisnha.index')
                         ->with('success', 'Kategori galeri berhasil diperbarui.');
    }

    /**
     * Hapus kategori galeri.
     */
    public function destroy($id)
    {
        $kategori = KategoriGaleriRisnha::findOrFail($id);
        $kategori->delete();

        return redirect()->route('risnha.kategori.galeriRisnha.index')
                         ->with('success', 'Kategori galeri berhasil dihapus.');
    }
}
