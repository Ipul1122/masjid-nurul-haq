<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->paginate(10);
        return view('dkm.manajemenFasilitas.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('dkm.manajemenFasilitas.galeri.create');
    }

    public function store(Request $request)
    {
        // ... (Validasi tetap sama)
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|array',
            'gambar.*' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                // PERUBAHAN DI SINI: Simpan di disk 'public' di dalam folder 'galeri'
                // Ini akan menghasilkan path seperti 'galeri/namafile.jpg'
                $path = $file->store('galeri', 'public');
                $gambarPaths[] = $path;
            }
        }

        Galeri::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPaths, // Simpan path relatifnya
        ]);

        return redirect()->route('dkm.manajemenFasilitas.galeri.index')
                        ->with('success', 'Galeri berhasil ditambahkan.');
    }
    
    public function edit(Galeri $galeri)
    {
        return view('dkm.manajemenFasilitas.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        // ... (Validasi tetap sama)

        $gambarPaths = $galeri->gambar; // Mulai dengan path yang sudah ada

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                // PERUBAHAN DI SINI JUGA
                $path = $file->store('galeri', 'public');
                $gambarPaths[] = $path;
            }
        }

        $galeri->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPaths,
        ]);

        return redirect()->route('dkm.manajemenFasilitas.galeri.index')
                        ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        // Hapus file gambar dari storage
        foreach ($galeri->gambar as $pathGambar) {
            // Ubah URL kembali menjadi path storage
            $pathStorage = str_replace('/storage', 'public', $pathGambar);
            if (Storage::exists($pathStorage)) {
                Storage::delete($pathStorage);
            }
        }

        $galeri->delete();

        return redirect()->route('dkm.manajemenFasilitas.galeri.index')
                         ->with('success', 'Galeri berhasil dihapus.');
    }
}