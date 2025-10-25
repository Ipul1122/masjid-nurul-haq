<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\KegiatanRisnha;
use App\Models\KategoriKegiatanRisnha;
use App\Models\NotifikasiRisnha; // Import NotifikasiRisnha model
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus 'public/' dari path store
            $path = $request->file('gambar')->store('kegiatan_risnha', 'public');
            $validatedData['gambar'] = $path;
        }

        $validatedData['status'] = 'draft';
        $kegiatan = KegiatanRisnha::create($validatedData); // Assign the created model to $kegiatan

        // Create notification for adding data
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'create',
            'tabel' => 'kegiatan_risnhas',
            'keterangan' => "Menambahkan kegiatan baru (draft): " . $kegiatan->nama,
        ]);

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

        // Create notification for publishing data
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'publish', // Or 'update' if you prefer
            'tabel' => 'kegiatan_risnhas',
            'keterangan' => "Mempublikasikan kegiatan: " . $kegiatan->nama,
        ]);

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $oldNama = $kegiatanRisnha->nama; // Store old name for notification

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($kegiatanRisnha->gambar) {
                Storage::disk('public')->delete($kegiatanRisnha->gambar);
            }
            // Store new image
            $path = $request->file('gambar')->store('kegiatan_risnha', 'public');
            $validatedData['gambar'] = $path;
        }

        $kegiatanRisnha->update($validatedData);

        // Create notification for editing data
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'update',
            'tabel' => 'kegiatan_risnhas',
            'keterangan' => "Memperbarui kegiatan (ID: {$kegiatanRisnha->id}): dari '{$oldNama}' menjadi '{$kegiatanRisnha->nama}'",
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.kegiatanRisnha.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(KegiatanRisnha $kegiatanRisnha)
    {
        $namaKegiatan = $kegiatanRisnha->nama; // Store name before deleting
        $kegiatanId = $kegiatanRisnha->id; // Store ID for notification

        // Hapus gambar dari storage
        if ($kegiatanRisnha->gambar) {
            Storage::delete('public/' . $kegiatanRisnha->gambar);
        }

        $kegiatanRisnha->delete();

        // Create notification for deleting data
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'delete',
            'tabel' => 'kegiatan_risnhas',
            'keterangan' => "Menghapus kegiatan (ID: {$kegiatanId}): " . $namaKegiatan,
        ]);

        return redirect()->route('risnha.manajemenKontenRisnha.kegiatanRisnha.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
