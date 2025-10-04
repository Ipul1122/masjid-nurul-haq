<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\KegiatanRisnha;
use App\Models\KategoriKegiatanRisnha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanRisnhaController extends Controller
{
    /**
     * Tampilkan semua kegiatan.
     */
    public function index()
    {
        $kegiatan = KegiatanRisnha::with('kategori')->latest()->get();
        return view('risnha.manajemenKontenRisnha.kegiatanRisnha.index', compact('kegiatan'));
    }

    /**
     * Tampilkan form tambah kegiatan.
     */
    public function create()
    {
        $kategori = KategoriKegiatanRisnha::all();
        return view('risnha.manajemenKontenRisnha.kegiatanRisnha.create', compact('kategori'));
    }

    /**
     * Simpan kegiatan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_kegiatan_risnha_id' => 'required|exists:kategori_kegiatan_risnhas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('risnha/kegiatan', 'public');
        }

        KegiatanRisnha::create($validated);

        return redirect()->route('risnha.manajemenKontenRisnha.kegiatanRisnha.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit kegiatan.
     */
    public function edit($id)
    {
        $kegiatan = KegiatanRisnha::findOrFail($id);
        $kategori = KategoriKegiatanRisnha::all();
        return view('risnha.manajemenKontenRisnha.kegiatanRisnha.edit', compact('kegiatan', 'kategori'));
    }

    /**
     * Update kegiatan.
     */
    public function update(Request $request, $id)
    {
        $kegiatan = KegiatanRisnha::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_kegiatan_risnha_id' => 'required|exists:kategori_kegiatan_risnhas,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('risnha/kegiatan', 'public');
        }

        $kegiatan->update($validated);

        return redirect()->route('risnha.manajemenKontenRisnha.kegiatanRisnha.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Hapus kegiatan.
     */
    public function destroy($id)
    {
        $kegiatan = KegiatanRisnha::findOrFail($id);

        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();

        return redirect()->route('risnha.manajemenKontenRisnha.kegiatanRisnha.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
