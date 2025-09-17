<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\KategoriPemasukkan;
use Illuminate\Http\Request;

class KategoriPemasukkanController extends Controller
{
    public function index()
    {
        $kategori = KategoriPemasukkan::all();
        return view('dkm.kategori.pemasukkan.index', compact('kategori'));
    }

    public function create()
    {
        return view('dkm.kategori.pemasukkan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriPemasukkan::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('dkm.kategori.pemasukkan.index')
                         ->with('success', 'Kategori pemasukkan berhasil ditambahkan.');
    }

    public function edit(KategoriPemasukkan $pemasukkan)
    {
        return view('dkm.kategori.pemasukkan.edit', compact('pemasukkan'));
    }

    public function update(Request $request, KategoriPemasukkan $pemasukkan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $pemasukkan->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('dkm.kategori.pemasukkan.index')
                         ->with('success', 'Kategori pemasukkan berhasil diperbarui.');
    }

    public function destroy(KategoriPemasukkan $pemasukkan)
    {
        $pemasukkan->delete();

        return redirect()->route('dkm.kategori.pemasukkan.index')
                         ->with('success', 'Kategori pemasukkan berhasil dihapus.');
    }
}
