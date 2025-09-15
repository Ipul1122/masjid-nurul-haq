<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManajemenKontenController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();

        // Filter berdasarkan kategori
        $query = Kegiatan::with('kategori');

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $kegiatan = $query->latest()->get();

        return view('dkm.manajemenKonten.index', compact('kegiatan', 'kategori'));
    }


    public function create()
    {
        $kategori = Kategori::all();
        return view('dkm.manajemenKonten.create', compact('kategori'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'nama_ustadz' => 'required|string|max:255',
            'gambar'      => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // hanya 2MB jpg/png/jpeg
            'jadwal'      => 'required|date',
            'catatan'     => 'nullable|string',
        ], [
            'gambar.mimes' => 'Maaf, gambar hanya bisa berupa file JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Maaf, ukuran gambar maksimal 2MB.',
        ]);


        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('dkm.manajemenKonten.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $manajemenKonten)
    {
        $kategori = Kategori::all();
        return view('dkm.manajemenKonten.edit', ['kegiatan' => $manajemenKonten]);
    }

    public function update(Request $request, Kegiatan $manajemenKonten)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nama_ustadz' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jadwal' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // hapus file lama kalau ada
            if ($manajemenKonten->gambar) {
                Storage::disk('public')->delete($manajemenKonten->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $manajemenKonten->update($data);

        return redirect()->route('dkm.manajemenKonten.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $manajemenKonten)
    {
        if ($manajemenKonten->gambar) {
            Storage::disk('public')->delete($manajemenKonten->gambar);
        }
        $manajemenKonten->delete();

        return redirect()->route('dkm.manajemenKonten.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    // Hapus banyak sekaligus
    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
        ], [
            'ids.required' => 'Pilih minimal satu kegiatan untuk dihapus.',
        ]);

        Kegiatan::whereIn('id', $request->ids)->delete();

        return redirect()->route('dkm.manajemenKonten.index')->with('success', 'Kegiatan terpilih berhasil dihapus.');
    }
}
