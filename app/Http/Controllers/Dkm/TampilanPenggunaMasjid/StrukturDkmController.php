<?php

namespace App\Http\Controllers\Dkm\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\StrukturDkm;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage; // Tidak perlu jika pakai File
use Illuminate\Support\Facades\File; // Pastikan ini ada

class StrukturDkmController extends Controller
{
    /**
     * Menampilkan halaman index.
     */
    public function index()
    {
        $strukturDkms = StrukturDkm::orderBy('created_at', 'desc')->get();
        return view('dkm.tampilanPenggunaMasjid.strukturDkm.index', compact('strukturDkms'));
    }

    /**
     * Menampilkan halaman create.
     */
    public function create()
    {
        return view('dkm.tampilanPenggunaMasjid.strukturDkm.create');
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            // Buat nama file unik
            $gambarName = time() . '.' . $image->getClientOriginalExtension();
            // Pindahkan file ke public/images/struktur_dkm
            $image->move(public_path('images/struktur_dkm'), $gambarName);
        }

        StrukturDkm::create([
            'nama' => $request->nama,
            'divisi' => $request->divisi,
            'gambar' => $gambarName, // Simpan hanya nama filenya
        ]);

        return redirect()->route('dkm.tampilanPenggunaMasjid.strukturDkm.index')->with('success', 'Data struktur DKM berhasil ditambahkan.');
    }

    /**
     * Menampilkan halaman edit.
     */
    public function edit(StrukturDkm $strukturDkm)
    {
        return view('dkm.tampilanPenggunaMasjid.strukturDkm.edit', compact('strukturDkm'));
    }

    /**
     * Mengupdate data.
     */
    public function update(Request $request, StrukturDkm $strukturDkm)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'divisi' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambarName = $strukturDkm->gambar; // Ambil nama file lama

        if ($request->hasFile('gambar')) {
            // 1. Hapus gambar lama jika ada
            if ($strukturDkm->gambar) {
                $oldImagePath = public_path('images/struktur_dkm/' . $strukturDkm->gambar);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // 2. Upload gambar baru
            $image = $request->file('gambar');
            $gambarName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/struktur_dkm'), $gambarName);
        }

        $strukturDkm->update([
            'nama' => $request->nama,
            'divisi' => $request->divisi,
            'gambar' => $gambarName, // Simpan nama file (baru atau lama)
        ]);

        return redirect()->route('dkm.tampilanPenggunaMasjid.strukturDkm.index')->with('success', 'Data struktur DKM berhasil diperbarui.');
    }

    /**
     * Menghapus data.
     */
    public function destroy(StrukturDkm $strukturDkm)
    {
        // Hapus gambar dari folder public
        if ($strukturDkm->gambar) {
            $imagePath = public_path('images/struktur_dkm/' . $strukturDkm->gambar);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $strukturDkm->delete();

        return redirect()->route('dkm.tampilanPenggunaMasjid.strukturDkm.index')->with('success', 'Data struktur DKM berhasil dihapus.');
    }
}