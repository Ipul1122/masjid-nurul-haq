<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\KategoriArtikel;
use App\Models\Notifikasi;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::with('kategori')->latest()->get();
        return view('dkm.manajemenKonten.artikel.index', compact('artikels'));
    }

    public function create()
    {
        $artikels = KategoriArtikel::all();
        return view('dkm.manajemenKonten.artikel.create', compact('artikels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori_artikels,id',
        ]);

        $data = $request->all();
        $data['tanggal_rilis'] = now();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel = Artikel::create($data);

        // ✅ simpan notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'create',
            'tabel' => 'artikel',
            'keterangan' => $artikel->judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        $kategori = KategoriArtikel::all();
        return view('dkm.manajemenKonten.artikel.edit', compact('artikel', 'kategori'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'tanggal_rilis' => 'required|date',
            'kategori_id' => 'required|exists:kategori_artikels,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($data);

        // ✅ simpan notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'artikel',
            'keterangan' => $artikel->judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $judul = $artikel->judul;

        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        // ✅ simpan notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'artikel',
            'keterangan' => $judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
