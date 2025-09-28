<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\KategoriArtikel;
use App\Models\Notifikasi;
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

        $kategori = KategoriArtikel::create([
            'nama' => $request->nama,
        ]);

        // Simpan notifikasi
        Notifikasi::create([
            'dkm_id'    => session('dkm_id'),
            'aksi'      => 'create',
            'tabel'     => 'kategori_artikel',
            'keterangan'=> 'Menambahkan kategori artikel: ' . $kategori->nama,
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

        $oldNama = $artikel->nama;

        $artikel->update([
            'nama' => $request->nama,
        ]);

        // Simpan notifikasi
        Notifikasi::create([
            'dkm_id'    => session('dkm_id'),
            'aksi'      => 'update',
            'tabel'     => 'kategori_artikel',
            'keterangan'=> "Mengubah kategori artikel dari '$oldNama' menjadi '{$artikel->nama}'",
        ]);

        return redirect()->route('dkm.kategori.artikel.index')
                         ->with('success', 'Kategori artikel berhasil diperbarui.');
    }

    public function destroy(KategoriArtikel $artikel)
    {
        $nama = $artikel->nama;
        $artikel->delete();

        // Simpan notifikasi
        Notifikasi::create([
            'dkm_id'    => session('dkm_id'),
            'aksi'      => 'delete',
            'tabel'     => 'kategori_artikel',
            'keterangan'=> 'Menghapus kategori artikel: ' . $nama,
        ]);

        return redirect()->route('dkm.kategori.artikel.index')
                         ->with('success', 'Kategori artikel berhasil dihapus.');
    }
}
