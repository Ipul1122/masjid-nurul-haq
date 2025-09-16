<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;

class KategoriArtikelController extends Controller
{
    public function index()
    {
        $kategoriArtikel = KategoriArtikel::all();
        return view('dkm.kategori.artikel.index', compact('kategoriArtikel'));
    }

    public function create()
    {
        return view('dkm.kategori.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriArtikel::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('dkm.kategori.artikel.index')
                         ->with('success', 'Kategori artikel berhasil ditambahkan.');
    }

    public function edit(KategoriArtikel $artikel)
    {
        return view('dkm.kategori.artikel.edit', ['kategoriArtikel' => $artikel]);
    }

    public function update(Request $request, KategoriArtikel $artikel)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $artikel->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('dkm.kategori.artikel.index')
                         ->with('success', 'Kategori artikel berhasil diperbarui.');
    }

    public function destroy(KategoriArtikel $artikel)
    {
        $artikel->delete();

        return redirect()->route('dkm.kategori.artikel.index')
                         ->with('success', 'Kategori artikel berhasil dihapus.');
    }
}
