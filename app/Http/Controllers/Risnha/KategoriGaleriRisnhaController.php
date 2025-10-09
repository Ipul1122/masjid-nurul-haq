<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\KategoriGaleriRisnha;
use App\Models\NotifikasiRisnha;
use Illuminate\Http\Request;

class KategoriGaleriRisnhaController extends Controller
{
    public function index()
    {
        $kategori = KategoriGaleriRisnha::orderBy('id', 'DESC')->get();
        return view('risnha.kategori.galeriRisnha.index', compact('kategori'));
    }

    public function create()
    {
        return view('risnha.kategori.galeriRisnha.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriGaleriRisnha::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // 🔔 Catat ke notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'create',
            'tabel' => 'kategori_galeri_risnha',
            'keterangan' => "Menambahkan kategori galeri: " . $kategori->nama_kategori,
        ]);

        return redirect()->route('risnha.kategori.galeriRisnha.index')
                         ->with('success', 'Kategori galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = KategoriGaleriRisnha::findOrFail($id);
        return view('risnha.kategori.galeriRisnha.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriGaleriRisnha::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // 🔔 Catat ke notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'update',
            'tabel' => 'kategori_galeri_risnha',
            'keterangan' => "Memperbarui kategori galeri: " . $kategori->nama_kategori,
        ]);

        return redirect()->route('risnha.kategori.galeriRisnha.index')
                         ->with('success', 'Kategori galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriGaleriRisnha::findOrFail($id);
        $nama = $kategori->nama_kategori;
        $kategori->delete();

        // 🔔 Catat ke notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'delete',
            'tabel' => 'kategori_galeri_risnha',
            'keterangan' => "Menghapus kategori galeri: " . $nama,
        ]);

        return redirect()->route('risnha.kategori.galeriRisnha.index')
                         ->with('success', 'Kategori galeri berhasil dihapus.');
    }
}
