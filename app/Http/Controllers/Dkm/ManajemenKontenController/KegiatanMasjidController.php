<?php

namespace App\Http\Controllers\Dkm\ManajemenKontenController;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanMasjidController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();

        // Filter kategori jika dipilih
        $query = Kegiatan::with('kategori');
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $kegiatanMasjid = $query->latest()->get();

        return view('dkm.manajemenKonten.kegiatanMasjid.index', compact('kegiatanMasjid', 'kategori'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('dkm.manajemenKonten.kegiatanMasjid.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'nama_ustadz' => 'required|string|max:255',
            'gambar'      => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'jadwal'      => 'required|date',
            'catatan'     => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
        ], [
            'gambar.mimes' => 'Maaf, gambar hanya bisa berupa JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatanMasjid)
    {
        $kategori = Kategori::all();
        return view('dkm.manajemenKonten.kegiatanMasjid.edit', compact('kegiatanMasjid', 'kategori'));
    }

    public function update(Request $request, Kegiatan $kegiatanMasjid)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'nama_ustadz' => 'required|string|max:255',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jadwal'      => 'required|date',
            'catatan'     => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($kegiatanMasjid->gambar) {
                Storage::disk('public')->delete($kegiatanMasjid->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatanMasjid->update($data);

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatanMasjid)
    {
        if ($kegiatanMasjid->gambar) {
            Storage::disk('public')->delete($kegiatanMasjid->gambar);
        }
        $kegiatanMasjid->delete();

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
        ], [
            'ids.required' => 'Pilih minimal satu kegiatan untuk dihapus.',
        ]);

        Kegiatan::whereIn('id', $request->ids)->delete();

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index')
            ->with('success', 'Kegiatan terpilih berhasil dihapus.');
    }
}
