<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\ArtikelRisnha;
use App\Models\KategoriArtikelRisnha;
use App\Models\Notifikasi;      // <- Notifikasi DKM
use App\Models\NotifikasiRisnha; // <- Notifikasi Risnha
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelRisnhaController extends Controller
{
    public function index()
    {
        $artikelRisnha = ArtikelRisnha::with('kategori')->latest()->get();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.index', compact('artikelRisnha'));
    }

    public function create()
    {
        $kategori = KategoriArtikelRisnha::all();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.create', compact('kategori'));
    }

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

        // Buat Notifikasi Risnha
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'create',
            'tabel' => 'artikel_risnha',
            'keterangan' => "Menambahkan artikel baru: " . $artikel->nama,
        ]);

        // Buat Notifikasi untuk DKM supaya terlihat interaksi Risnha
        Notifikasi::create([
            'dkm_id' => session('dkm_id'), // atau bisa null jika ingin global
            'aksi' => 'create',
            'tabel' => 'artikel_risnha',
            'keterangan' => "Risnha menambahkan artikel baru: " . $artikel->nama,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $artikel = ArtikelRisnha::findOrFail($id);
        $kategori = KategoriArtikelRisnha::all();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.edit', compact('artikel', 'kategori'));
    }

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

        // Notifikasi Risnha
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'update',
            'tabel' => 'artikel_risnha',
            'keterangan' => "Memperbarui artikel: " . $artikel->nama,
        ]);

        // Notifikasi DKM
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'artikel_risnha',
            'keterangan' => "Risnha memperbarui artikel: " . $artikel->nama,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $artikel = ArtikelRisnha::findOrFail($id);

        if ($artikel->foto) {
            Storage::disk('public')->delete($artikel->foto);
        }

        // Notifikasi Risnha
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'delete',
            'tabel' => 'artikel_risnha',
            'keterangan' => "Menghapus artikel: " . $artikel->nama,
        ]);

        // Notifikasi DKM
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'artikel_risnha',
            'keterangan' => "Risnha menghapus artikel: " . $artikel->nama,
        ]);

        $artikel->delete();

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
