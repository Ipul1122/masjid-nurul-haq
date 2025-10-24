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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Artikel::with('kategori')->latest();

        

        // Terapkan filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Terapkan filter berdasarkan kategori jika ada
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $artikels = $query->paginate(10);

        return view('dkm.manajemenKonten.artikel.index', compact('artikels'));
    }

    // ... (method lainnya biarkan seperti semula)
    // ... (store, create, edit, update, destroy, preview, publish)

    public function create()
    {
        $kategoriArtikels = KategoriArtikel::all();
        return view('dkm.manajemenKonten.artikel.create', compact('kategoriArtikels'));
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
        $data['status'] = 'draft';

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel = Artikel::create($data);

        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'create',
            'tabel' => 'artikel',
            'keterangan' => $artikel->judul,
        ]);

        return redirect()
            ->route('dkm.manajemenKonten.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan sebagai draf.');
    }

     public function edit(Request $request, Artikel $artikel)
    {
        $kategoriArtikels = KategoriArtikel::all();
        $page = $request->query('page', 1); // Ambil 'page' dari URL, default-nya 1
        
        return view('dkm.manajemenKonten.artikel.edit', compact('artikel', 'kategoriArtikels', 'page'));
    }


    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori_artikels,id',
        ]);

        $data = $request->all();

        // ✅ PERUBAHAN DIMULAI DI SINI
        if ($request->hasFile('gambar')) {
            // Jika ada gambar baru, hapus gambar lama (jika ada) dan simpan yang baru
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        } else {
            // Jika tidak ada gambar baru, hapus 'gambar' dari array $data
            // agar tidak menimpa path gambar yang ada di database dengan null
            unset($data['gambar']);
        }
        // ✅ PERUBAHAN SELESAI

        $artikel->update($data);
        
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'artikel',
            'keterangan' => 'Mengubah artikel: ' . $artikel->judul,
        ]);

        return redirect()
            ->route('dkm.manajemenKonten.artikel.index', ['page' => $request->page ?? 1])
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }
        $artikel->delete();
        
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'artikel',
            'keterangan' => 'Menghapus artikel: ' . $artikel->judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function preview(Artikel $artikel)
    {
        return view('dkm.manajemenKonten.artikel.preview', compact('artikel'));
    }

    public function publish(Artikel $artikel)
    {
        $artikel->update(['status' => 'published']);
        
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'publish',
            'tabel' => 'artikel',
            'keterangan' => 'Mempublikasikan artikel: ' . $artikel->judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.artikel.index')
            ->with('success', 'Artikel berhasil dipublikasikan.');
    }
}