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
    public function index(Request $request)
    {
        $query = Artikel::with('kategori')->latest();

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // ✅ Pagination 10
        $artikels = $query->paginate(10)->appends($request->query());

        return view('dkm.manajemenKonten.artikel.index', compact('artikels'));
    }

    public function create(Request $request)
    {
        $artikels = KategoriArtikel::all();
        $page = $request->page ?? 1;
        return view('dkm.manajemenKonten.artikel.create', compact('artikels', 'page'));
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
            ->route('dkm.manajemenKonten.artikel.index', ['page' => $request->page ?? 1])
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel, Request $request)
    {
        $kategori = KategoriArtikel::all();
        $page = $request->page ?? 1;
        return view('dkm.manajemenKonten.artikel.edit', compact('artikel', 'kategori', 'page'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'tanggal_rilis' => 'required|date',
            'kategori_id' => 'required|exists:kategori_artikels,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($data);

        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'artikel',
            'keterangan' => $artikel->judul,
        ]);

        return redirect()
            ->route('dkm.manajemenKonten.artikel.index', ['page' => $request->page ?? 1])
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Request $request, Artikel $artikel)
    {
        $judul = $artikel->judul;

        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'artikel',
            'keterangan' => $judul,
        ]);

        return redirect()
            ->route('dkm.manajemenKonten.artikel.index', ['page' => $request->page ?? 1])
            ->with('success', 'Artikel berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:artikels,id',
        ]);

        $ids = $data['ids'];

        $artikels = Artikel::whereIn('id', $ids)->get();

        foreach ($artikels as $artikel) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }

            Notifikasi::create([
                'dkm_id' => session('dkm_id'),
                'aksi' => 'delete',
                'tabel' => 'artikel',
                'keterangan' => $artikel->judul,
            ]);
        }

        Artikel::whereIn('id', $ids)->delete();

        return redirect()
            ->route('dkm.manajemenKonten.artikel.index', ['page' => $request->page ?? 1])
            ->with('success', 'Artikel terpilih berhasil dihapus.');
    }
}
