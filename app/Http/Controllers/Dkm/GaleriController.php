<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::with('kategori')->latest()->get();
        return view('dkm.manajemenFasilitas.galeri.index', compact('galeris'));
    }

    public function create()
    {
        $kategoris = KategoriGaleri::all();
        return view('dkm.manajemenFasilitas.galeri.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_galeris,id',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'gambar.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('galeri', 'public');
                $gambarPaths[] = $path;
            }
        }

        Galeri::create([
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'gambar' => $gambarPaths,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('dkm.manajemenFasilitas.galeri.index')
                         ->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit(Galeri $galeri)
    {
        $kategoris = KategoriGaleri::all();
        return view('dkm.manajemenFasilitas.galeri.edit', compact('galeri', 'kategoris'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_galeris,id',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'gambar.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $gambarPaths = $galeri->gambar ?? [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('galeri', 'public');
                $gambarPaths[] = $path;
            }
        }

        $galeri->update([
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'gambar' => $gambarPaths,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('dkm.manajemenFasilitas.galeri.index')
                         ->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar) {
            foreach ($galeri->gambar as $file) {
                Storage::disk('public')->delete($file);
            }
        }
        $galeri->delete();

        return redirect()->route('dkm.manajemenFasilitas.galeri.index')
                         ->with('success', 'Galeri berhasil dihapus');
    }
}