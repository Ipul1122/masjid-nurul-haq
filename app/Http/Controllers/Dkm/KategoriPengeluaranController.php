<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengeluaran;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class KategoriPengeluaranController extends Controller
{
    public function index()
    {
        $kategori = KategoriPengeluaran::all();
        return view('dkm.kategori.pengeluaran.index', compact('kategori'));
    }

    public function create()
    {
        return view('dkm.kategori.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori = KategoriPengeluaran::create([
            'nama' => $request->nama,
        ]);

        // Catat notifikasi CREATE
        Notifikasi::create([
            'dkm_id'     => session('dkm_id'),
            'aksi'       => 'create',
            'tabel'      => 'kategori_pengeluaran',
            'keterangan' => "Menambahkan kategori pengeluaran: " . $kategori->nama,
        ]);

        return redirect()->route('dkm.kategori.pengeluaran.index')
                         ->with('success', 'Kategori pengeluaran berhasil ditambahkan.');
    }

    public function edit(KategoriPengeluaran $pengeluaran)
    {
        return view('dkm.kategori.pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, KategoriPengeluaran $pengeluaran)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $oldNama = $pengeluaran->nama;

        $pengeluaran->update([
            'nama' => $request->nama,
        ]);

        // Catat notifikasi UPDATE
        Notifikasi::create([
            'dkm_id'     => session('dkm_id'),
            'aksi'       => 'update',
            'tabel'      => 'kategori_pengeluaran',
            'keterangan' => "Mengubah kategori pengeluaran: $oldNama menjadi " . $request->nama,
        ]);

        return redirect()->route('dkm.kategori.pengeluaran.index')
                         ->with('success', 'Kategori pengeluaran berhasil diperbarui.');
    }

    public function destroy(KategoriPengeluaran $pengeluaran)
    {
        $nama = $pengeluaran->nama;
        $pengeluaran->delete();

        // Catat notifikasi DELETE
        Notifikasi::create([
            'dkm_id'     => session('dkm_id'),
            'aksi'       => 'delete',
            'tabel'      => 'kategori_pengeluaran',
            'keterangan' => "Menghapus kategori pengeluaran: " . $nama,
        ]);

        return redirect()->route('dkm.kategori.pengeluaran.index')
                         ->with('success', 'Kategori pengeluaran berhasil dihapus.');
    }
}
