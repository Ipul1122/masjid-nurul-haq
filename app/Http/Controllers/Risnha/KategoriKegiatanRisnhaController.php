<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\KategoriKegiatanRisnha;
use App\Models\NotifikasiRisnha;
use Illuminate\Http\Request;

class KategoriKegiatanRisnhaController extends Controller
{
    /**
     * Tampilkan daftar kategori kegiatan
     */
    public function index()
    {
        $kategori = KategoriKegiatanRisnha::latest()->get();
        return view('risnha.kategori.kegiatanRisnha.index', compact('kategori'));
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view('risnha.kategori.kegiatanRisnha.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriKegiatanRisnha::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Catat notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'create',
            'tabel' => 'kategori_kegiatan_risnha',
            'keterangan' => "Menambahkan kategori kegiatan: " . $kategori->nama_kategori,
        ]);

        return redirect()
            ->route('risnha.kategori.kegiatanRisnha.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Form edit kategori
     */
    public function edit($id)
    {
        $kategori = KategoriKegiatanRisnha::findOrFail($id);
        return view('risnha.kategori.kegiatanRisnha.edit', compact('kategori'));
    }

    /**
     * Update data kategori
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriKegiatanRisnha::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Catat notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'update',
            'tabel' => 'kategori_kegiatan_risnha',
            'keterangan' => "Mengupdate kategori kegiatan menjadi: " . $kategori->nama_kategori,
        ]);

        return redirect()
            ->route('risnha.kategori.kegiatanRisnha.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori
     */
    public function destroy($id)
    {
        $kategori = KategoriKegiatanRisnha::findOrFail($id);
        $nama = $kategori->nama_kategori;

        $kategori->delete();

        // Catat notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'delete',
            'tabel' => 'kategori_kegiatan_risnha',
            'keterangan' => "Menghapus kategori kegiatan: " . $nama,
        ]);

        return redirect()
            ->route('risnha.kategori.kegiatanRisnha.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
