<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\KegiatanRisnha;
use App\Models\KategoriKegiatanRisnha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanRisnhaController extends Controller
{
    public function index()
    {
        $kegiatanRisnha = KegiatanRisnha::with('kategori')->latest()->get();
        return view('risnha.manajemenKontenRisnha.kegiatanRisnha.index', compact('kegiatanRisnha'));
    }

    public function create()
    {
        $kategori = KategoriKegiatanRisnha::all();
        return view('risnha.manajemenKontenRisnha.kegiatanRisnha.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_kegiatan_risnha_id' => 'required|exists:kategori_kegiatan_risnhas,id',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus 'public/' dari path store
            $path = $request->file('foto')->store('kegiatan_risnha', 'public');
            $validatedData['foto'] = $path;
        }

        $validatedData['status'] = 'draft';
        KegiatanRisnha::create($validatedData);

        return redirect()->route('risnha.manajemenKontenRisnha.kegiatanRisnha.index')->with('success', 'Kegiatan berhasil disimpan sebagai draf.');
    }

    public function preview($id)
    {
        $kegiatan = KegiatanRisnha::with('kategori')->findOrFail($id);
        return view('risnha.manajemenKontenRisnha.kegiatanRisnha.preview', compact('kegiatan'));
    }

    public function publish($id)
    {
        $kegiatan = KegiatanRisnha::findOrFail($id);
        $kegiatan->status = 'published';
        $kegiatan->save();

        return redirect()->route('risnha.manajemenKontenRisnha.kegiatanRisnha.index')->with('success', 'Kegiatan berhasil dipublikasikan.');
    }

    public function edit(KegiatanRisnha $kegiatanRisnha)
    {
        $kategori = KategoriKegiatanRisnha::all();
        return view('risnha.manajemenKontenRisnha.kegiatanRisnha.edit', ['kegiatan' => $kegiatanRisnha, 'kategori' => $kategori]);
    }

   public function update(Request $request, KegiatanRisnha $kegiatanRisnha)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_kegiatan_risnha_id' => 'required|exists:kategori_kegiatan_risnhas,id',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($kegiatanRisnha->foto) {
                Storage::disk('public')->delete($kegiatanRisnha->foto);
            }
            // Hapus 'public/' dari path store
            $path = $request->file('foto')->store('kegiatan_risnha', 'public');
            $validatedData['foto'] = $path;
        }

        $kegiatanRisnha->update($validatedData);

        return redirect()->route('risnha.manajemenKontenRisnha.kegiatanRisnha.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(KegiatanRisnha $kegiatanRisnha)
    {
        // Hapus foto dari storage
        if ($kegiatanRisnha->foto) {
            Storage::delete('public/' . $kegiatanRisnha->foto);
        }

        $kegiatanRisnha->delete();
        return redirect()->route('risnha.manajemenKontenRisnha.kegiatanRisnha.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}