<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\KategoriGaleri;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class KategoriGaleriController extends Controller
{
    public function index()
    {
        $kategoris = KategoriGaleri::latest()->get();
        return view('dkm.kategori.galeri.index', compact('kategoris'));
    }

    public function create()
    {
        return view('dkm.kategori.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        $kategori = KategoriGaleri::create($request->only('nama'));

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id'     => session('dkm_id'),
            'aksi'       => 'create',
            'tabel'      => 'kategori_galeri',
            'keterangan' => "Menambahkan kategori galeri: " . $kategori->nama,
        ]);

        return redirect()->route('dkm.kategori.galeri.index')
                         ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(KategoriGaleri $galeri)
    {
        return view('dkm.kategori.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, KategoriGaleri $galeri)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        $galeri->update($request->only('nama'));

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id'     => session('dkm_id'),
            'aksi'       => 'update',
            'tabel'      => 'kategori_galeri',
            'keterangan' => "Memperbarui kategori galeri: " . $galeri->nama,
        ]);

        return redirect()->route('dkm.kategori.galeri.index')
                         ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(KategoriGaleri $galeri)
    {
        $nama = $galeri->nama;

        $galeri->delete();

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id'     => session('dkm_id'),
            'aksi'       => 'delete',
            'tabel'      => 'kategori_galeri',
            'keterangan' => "Menghapus kategori galeri: " . $nama,
        ]);

        return redirect()->route('dkm.kategori.galeri.index')
                         ->with('success', 'Kategori berhasil dihapus');
    }
}
