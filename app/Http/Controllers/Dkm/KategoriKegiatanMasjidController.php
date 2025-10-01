<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Notifikasi;
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

        $kategori = Kategori::create($request->only('nama'));

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id'     => session('dkm_id'),
            'aksi'       => 'create',
            'tabel'      => 'kategori_kegiatan_masjid',
            'keterangan' => "Menambahkan kategori kegiatan masjid: " . $kategori->nama,
        ]);

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

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id'     => session('dkm_id'),
            'aksi'       => 'update',
            'tabel'      => 'kategori_kegiatan_masjid',
            'keterangan' => "Mengubah kategori kegiatan masjid: " . $kategori->nama,
        ]);

        return redirect()->route('dkm.kategori.kegiatanMasjid.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $nama = $kategori->nama;

        $kategori->delete();

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id'     => session('dkm_id'),
            'aksi'       => 'delete',
            'tabel'      => 'kategori_kegiatan_masjid',
            'keterangan' => "Menghapus kategori kegiatan masjid: " . $nama,
        ]);

        return redirect()->route('dkm.kategori.kegiatanMasjid.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
