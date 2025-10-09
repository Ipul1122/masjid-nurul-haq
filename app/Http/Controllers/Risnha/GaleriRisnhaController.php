<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\GaleriRisnha;
use App\Models\KategoriGaleriRisnha;
use App\Models\NotifikasiRisnha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriRisnhaController extends Controller
{
    /**
     * Tampilkan semua galeri.
     */
    public function index()
    {
        $galeri = GaleriRisnha::with('kategori')->latest()->get();
        return view('risnha.manajemenKontenRisnha.galeriRisnha.index', compact('galeri'));
    }

    /**
     * Tampilkan form tambah galeri.
     */
    public function create()
    {
        $kategori = KategoriGaleriRisnha::all();
        return view('risnha.manajemenKontenRisnha.galeriRisnha.create', compact('kategori'));
    }

    /**
     * Simpan galeri baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_galeri' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_galeri_risnha_id' => 'required|exists:kategori_galeri_risnhas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('risnha/galeri', 'public');
        }

        $galeri = GaleriRisnha::create($validated);

        // 🔔 Notifikasi untuk create
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'create',
            'tabel' => 'galeri_risnha',
            'keterangan' => "Menambahkan galeri baru: " . $galeri->nama_galeri,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.galeriRisnha.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit galeri.
     */
    public function edit($id)
    {
        $galeri = GaleriRisnha::findOrFail($id);
        $kategori = KategoriGaleriRisnha::all();
        return view('risnha.manajemenKontenRisnha.galeriRisnha.edit', compact('galeri', 'kategori'));
    }

    /**
     * Update galeri.
     */
    public function update(Request $request, $id)
    {
        $galeri = GaleriRisnha::findOrFail($id);

        $validated = $request->validate([
            'nama_galeri' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori_galeri_risnhas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $validated['foto'] = $request->file('foto')->store('risnha/galeri', 'public');
        }

        $galeri->update($validated);

        // 🔔 Notifikasi untuk update
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'update',
            'tabel' => 'galeri_risnha',
            'keterangan' => "Memperbarui galeri: " . $galeri->nama_galeri,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.galeriRisnha.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Hapus galeri.
     */
    public function destroy($id)
    {
        $galeri = GaleriRisnha::findOrFail($id);

        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        // 🔔 Notifikasi untuk delete
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'delete',
            'tabel' => 'galeri_risnha',
            'keterangan' => "Menghapus galeri: " . $galeri->nama_galeri,
        ]);

        $galeri->delete();

        return redirect()->route('risnha.manajemenKontenRisnha.galeriRisnha.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}
