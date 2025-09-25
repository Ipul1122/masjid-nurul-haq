<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriKegiatanMasjidController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('dkm.kategori.kegiatanMasjid.index', compact('kategori'));
    }

    public function create()
    {
        return view('dkm.kategori.kegiatanMasjid.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100'
        ]);

        Kategori::create($request->only('nama'));

        return redirect()->route('dkm.kategori.kegiatanMasjid.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show($id)
    {
        // Jika tidak ingin menampilkan detail, redirect saja
        return redirect()->route('dkm.kategori.kegiatanMasjid.index');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id); 
        $daftarKategori = Kategori::all(); // untuk dropdown jika ada relasi

        return view('dkm.kategori.kegiatanMasjid.edit', compact('kategori', 'daftarKategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('dkm.kategori.kegiatanMasjid.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('dkm.kategori.kegiatanMasjid.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
