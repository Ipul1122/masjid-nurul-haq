<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\KategoriPemasukkan;
use App\Models\Notifikasi;
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

        $kategori = KategoriPemasukkan::create([
            'nama' => $request->nama,
        ]);

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'create',
            'tabel' => 'kategori_pemasukkan',
            'keterangan' => "Menambahkan kategori pemasukkan: " . $kategori->nama,
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

        $oldName = $pemasukkan->nama;

        $pemasukkan->update([
            'nama' => $request->nama,
        ]);

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'kategori_pemasukkan',
            'keterangan' => "Mengubah kategori pemasukkan dari: {$oldName} menjadi: {$request->nama}",
        ]);

        return redirect()->route('dkm.kategori.pemasukkan.index')
                         ->with('success', 'Kategori pemasukkan berhasil diperbarui.');
    }

    public function destroy(KategoriPemasukkan $pemasukkan)
    {
        $nama = $pemasukkan->nama;
        $pemasukkan->delete();

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'kategori_pemasukkan',
            'keterangan' => "Menghapus kategori pemasukkan: " . $nama,
        ]);

        return redirect()->route('dkm.kategori.pemasukkan.index')
                         ->with('success', 'Kategori pemasukkan berhasil dihapus.');
    }
}
