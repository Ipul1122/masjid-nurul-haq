<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatanRisnha;
use Illuminate\Http\Request;

class KategoriKegiatanRisnhaController extends Controller
{
    public function index()
    {
        $kategori = KategoriKegiatanRisnha::latest()->get();
        return view('risnha.kategori.kegiatanRisnha.index', compact('kategori'));
    }

    public function create()
    {
        return view('risnha.kategori.kegiatanRisnha.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_kegiatan_risnhas,nama_kategori',
        ]);

        KategoriKegiatanRisnha::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('risnha.kategori.kegiatanRisnha.index')
                         ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = KategoriKegiatanRisnha::findOrFail($id);
        return view('risnha.kategori.kegiatanRisnha.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriKegiatanRisnha::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_kegiatan_risnhas,nama_kategori,' . $id,
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('risnha.kategori.kegiatanRisnha.index')
                         ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = KategoriKegiatanRisnha::findOrFail($id);
        $kategori->delete();

        return redirect()->route('risnha.kategori.kegiatanRisnha.index')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}
