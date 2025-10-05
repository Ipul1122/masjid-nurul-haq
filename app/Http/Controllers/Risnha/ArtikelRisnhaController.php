<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\ArtikelRisnha;
use App\Models\KategoriArtikelRisnha;
use App\Models\NotifikasiRisnha; // <-- 1. Import model notifikasi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelRisnhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikelRisnha = ArtikelRisnha::with('kategori')->latest()->get();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.index', compact('artikelRisnha'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriArtikelRisnha::all();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_artikel_risnha_id' => 'required|exists:kategori_artikel_risnhas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('risnha/artikel', 'public');
        }

        $artikel = ArtikelRisnha::create($validated);

        // 2. Buat Notifikasi untuk penambahan data
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'create',
            'tabel' => 'artikel_risnha',
            'keterangan' => "Menambahkan artikel baru: " . $artikel->nama,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $artikel = ArtikelRisnha::findOrFail($id);
        $kategori = KategoriArtikelRisnha::all();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.edit', compact('artikel', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $artikel = ArtikelRisnha::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_artikel_risnha_id' => 'required|exists:kategori_artikel_risnhas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            if ($artikel->foto) {
                Storage::disk('public')->delete($artikel->foto);
            }
            $validated['foto'] = $request->file('foto')->store('risnha/artikel', 'public');
        }

        $artikel->update($validated);

        // 3. Buat Notifikasi untuk pembaruan data
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'update',
            'tabel' => 'artikel_risnha',
            'keterangan' => "Memperbarui artikel: " . $artikel->nama,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $artikel = ArtikelRisnha::findOrFail($id);

        if ($artikel->foto) {
            Storage::disk('public')->delete($artikel->foto);
        }
        
        // 4. Buat Notifikasi sebelum data dihapus
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'delete',
            'tabel' => 'artikel_risnha',
            'keterangan' => "Menghapus artikel: " . $artikel->nama,
        ]);

        $artikel->delete();

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}

