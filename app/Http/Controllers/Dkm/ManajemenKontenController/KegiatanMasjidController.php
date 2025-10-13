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
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
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
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jadwal'      => 'required|date',
            'deskripsi'     => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }
        $data['status'] = 'draft';
        $kegiatan = Kegiatan::create($data);

        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'create',
            'tabel' => 'kegiatan',
            'keterangan' => 'Menambahkan kegiatan baru: ' . $kegiatan->judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index')
            ->with('success', 'Kegiatan berhasil ditambahkan sebagai draft.');
    }

    public function edit(Request $request, Kegiatan $kegiatanMasjid)
    {
        $kategori = Kategori::all();
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
            'deskripsi'     => 'nullable|string',
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

        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'kegiatan',
            'keterangan' => 'Memperbarui kegiatan: ' . $kegiatanMasjid->judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index', ['page' => $request->input('page', 1)])
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }
    
    public function publish(Request $request, Kegiatan $kegiatan)
    {
        $kegiatan->update(['status' => 'published']);

        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'publish',
            'tabel' => 'kegiatan',
            'keterangan' => 'Mempublikasikan kegiatan: ' . $kegiatan->judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index', ['page' => $request->input('page', 1)])
            ->with('success', 'Kegiatan berhasil dipublikasikan.');
    }

    public function destroy(Request $request, Kegiatan $kegiatanMasjid)
    {
        $judul = $kegiatanMasjid->judul;

        if ($kegiatanMasjid->gambar) {
            Storage::disk('public')->delete($kegiatanMasjid->gambar);
        }
        $kegiatanMasjid->delete();

        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'kegiatan',
            'keterangan' => 'Menghapus kegiatan: ' . $judul,
        ]);

        return redirect()->route('dkm.manajemenKonten.kegiatanMasjid.index', [
            'page' => $request->input('page', 1),
        ])->with('success', 'Kegiatan berhasil dihapus.');
    }

    // ✅ METHOD destroyMultiple / bulkDelete DIHAPUS untuk menyederhanakan

    public function preview(Kegiatan $kegiatanMasjid)
    {
        // ✅ PERBAIKAN: Mengirim variabel dengan nama 'kegiatan' agar cocok dengan view
        return view('dkm.manajemenKonten.kegiatanMasjid.preview', ['kegiatan' => $kegiatanMasjid]);
    }
}

