<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\ArtikelRisnha;
use App\Models\KategoriArtikelRisnha;
use App\Models\NotifikasiRisnha; // <-- Menambahkan model NotifikasiRisnha
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelRisnhaController extends Controller
{
    public function index()
    {
        $artikel = ArtikelRisnha::with('kategori')->latest()->paginate(10);
        return view('risnha.manajemenKontenRisnha.artikelRisnha.index', compact('artikel'));
    }

    public function create()
    {
        $kategoriArtikelRisnha = KategoriArtikelRisnha::all();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.create', compact('kategoriArtikelRisnha'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_artikel_risnha_id' => 'required|exists:kategori_artikel_risnhas,id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('artikel_risnha', 'public');
            $validatedData['gambar'] = $path;
        }

        $validatedData['status'] = 'draft';
        $artikel = ArtikelRisnha::create($validatedData); // <-- Simpan artikel ke variabel

        // Membuat Notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'), // Asumsi risnha_id ada di session
            'aksi' => 'create',
            'tabel' => 'artikel_risnhas',
            'keterangan' => "Membuat artikel baru (ID: {$artikel->id}): " . $artikel->nama,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')->with('success', 'Artikel berhasil disimpan sebagai draf.');
    }

    public function edit(ArtikelRisnha $artikelRisnha)
    {
        $kategoriArtikelRisnha = KategoriArtikelRisnha::all();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.edit', ['artikel' => $artikelRisnha, 'kategori' => $kategoriArtikelRisnha]);
    }

    public function update(Request $request, ArtikelRisnha $artikelRisnha)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_artikel_risnha_id' => 'required|exists:kategori_artikel_risnhas,id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($artikelRisnha->gambar) {
                Storage::disk('public')->delete($artikelRisnha->gambar);
            }
            $path = $request->file('gambar')->store('artikel_risnha', 'public');
            $validatedData['gambar'] = $path;
        }

        $artikelRisnha->update($validatedData);

        // Membuat Notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'), // Asumsi risnha_id ada di session
            'aksi' => 'update',
            'tabel' => 'artikel_risnhas',
            'keterangan' => "Memperbarui artikel (ID: {$artikelRisnha->id}): " . $artikelRisnha->nama,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(ArtikelRisnha $artikelRisnha)
    {
        // Simpan data sebelum dihapus untuk notifikasi
        $artikelId = $artikelRisnha->id;
        $namaArtikel = $artikelRisnha->nama;

        if ($artikelRisnha->gambar) {
            Storage::disk('public')->delete($artikelRisnha->gambar);
        }
        $artikelRisnha->delete();

        // Membuat Notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'), // Asumsi risnha_id ada di session
            'aksi' => 'delete',
            'tabel' => 'artikel_risnhas',
            'keterangan' => "Menghapus artikel (ID: {$artikelId}): " . $namaArtikel,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function preview($id)
    {
        $artikel = ArtikelRisnha::with('kategori')->findOrFail($id);
        return view('risnha.manajemenKontenRisnha.artikelRisnha.preview', compact('artikel'));
    }

    public function publish($id)
    {
        $artikel = ArtikelRisnha::findOrFail($id);
        $artikel->status = 'published';
        $artikel->save();

        // Membuat Notifikasi
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'), // Asumsi risnha_id ada di session
            'aksi' => 'publish',
            'tabel' => 'artikel_risnhas',
            'keterangan' => "Mempublikasikan artikel (ID: {$artikel->id}): " . $artikel->nama,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')->with('success', 'Artikel berhasil dipublikasikan.');
    }
}
