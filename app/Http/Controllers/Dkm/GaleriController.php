<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\KategoriGaleri;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{

    public function index(Request $request)
    {
        $query = Galeri::with('kategori')->latest();

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $galeris = $query->paginate(10);

        // Mengambil tahun unik dari data galeri yang ada
        $years = Galeri::selectRaw('YEAR(tanggal) as year')
                       ->distinct()
                       ->orderBy('year', 'desc')
                       ->pluck('year');

        // Berdasarkan kategori
        $kategoris = KategoriGaleri::all();

        return view('dkm.manajemenFasilitas.galeri.index', compact(
            'galeris', 
            'years',
                           'kategoris'));
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
            'gambar.*' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validasi setiap file dalam array
            'deskripsi' => 'nullable|string',
        ]);

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('galeri', 'public');
                $gambarPaths[] = $path;
            }
        }

        $galeri = Galeri::create([
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'gambar' => $gambarPaths, // Simpan array path
            'deskripsi' => $request->deskripsi,
        ]);

        // Tambah Notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'create',
            'tabel' => 'galeri',
            'keterangan' => "Menambahkan galeri: " . $galeri->judul,
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
            'gambar.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Gambar tidak wajib saat update
            'deskripsi' => 'nullable|string',
        ]);

        // Ambil data yang akan diupdate, kecuali gambar untuk sementara
        $dataToUpdate = $request->except('gambar');

        // ✅ PERUBAHAN: Logika update gambar
        if ($request->hasFile('gambar')) {
            // Ambil array path gambar yang sudah ada
            $existingPaths = $galeri->gambar ?? [];
            $newPaths = [];

            // Simpan gambar baru dan tambahkan path ke array baru
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('galeri', 'public');
                $newPaths[] = $path;
            }
            
            $dataToUpdate['gambar'] = array_merge($existingPaths, $newPaths);
          
        } 
        $galeri->update($dataToUpdate);

        // Tambah Notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'galeri',
            'keterangan' => "Memperbarui galeri: " . $galeri->judul,
        ]);

        return redirect()->route('dkm.manajemenFasilitas.galeri.index')
                         ->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        // Hapus file gambar dari storage jika ada
        if ($galeri->gambar) {
            foreach ($galeri->gambar as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $judul = $galeri->judul; // Simpan judul sebelum dihapus
        $galeri->delete(); // Hapus record dari database

        // Tambah Notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'galeri',
            'keterangan' => "Menghapus galeri: " . $judul, // Gunakan judul yang disimpan
        ]);

        return redirect()->route('dkm.manajemenFasilitas.galeri.index')
                         ->with('success', 'Galeri berhasil dihapus');
    }
}
