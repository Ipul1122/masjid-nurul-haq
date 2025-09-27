<?php

namespace App\Http\Controllers\Dkm\ManajemenKontenController;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kategori;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanMasjidController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();

        $query = Kegiatan::with('kategori');
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // ✅ gunakan paginate(10) + withQueryString agar filter tetap jalan
        $kegiatanMasjid = $query->latest()->paginate(10)->withQueryString();

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
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatan = Kegiatan::create($data);

        // Notifikasi create
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'create',
            'tabel' => 'kegiatan',
            'keterangan' => $kegiatan->judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Request $request, Kegiatan $kegiatanMasjid)
    {
        $kategori = Kategori::all();
        // ✅ kirim juga nomor halaman agar bisa balik ke page yang sama
        $page = $request->query('page', 1);

        return view('dkm.manajemenKonten.kegiatanMasjid.edit', compact('kegiatanMasjid', 'kategori', 'page'));
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

        // Notifikasi update
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'kegiatan',
            'keterangan' => $kegiatanMasjid->judul,
        ]);

        // ✅ setelah update, kembali ke page yang sama
        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index', [
            'page' => $request->input('page', 1),
        ])->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Request $request, Kegiatan $kegiatanMasjid)
    {
        $judul = $kegiatanMasjid->judul;

        if ($kegiatanMasjid->gambar) {
            Storage::disk('public')->delete($kegiatanMasjid->gambar);
        }
        $kegiatanMasjid->delete();

        // Notifikasi delete
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'kegiatan',
            'keterangan' => $judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index', [
            'page' => $request->input('page', 1),
        ])->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:kegiatans,id',
        ]);

        $kegiatans = Kegiatan::whereIn('id', $request->ids)->get();

        foreach ($kegiatans as $kegiatan) {
            if ($kegiatan->gambar) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            // Notifikasi delete
            Notifikasi::create([
                'dkm_id' => session('dkm_id'),
                'aksi' => 'delete',
                'tabel' => 'kegiatan',
                'keterangan' => $kegiatan->judul,
            ]);
        }

        Kegiatan::whereIn('id', $request->ids)->delete();

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index', [
            'page' => $request->input('page', 1),
        ])->with('success', 'Kegiatan terpilih berhasil dihapus.');
    }
}
