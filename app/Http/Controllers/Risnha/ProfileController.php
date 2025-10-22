<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasiRisnha;
use App\Models\VisiMisiRisnha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profile dengan VisiMisi dan semua item Organisasi.
     */
    public function index()
    {
        $profile = VisiMisiRisnha::firstOrNew([]);
        $organisasis = StrukturOrganisasiRisnha::orderBy('created_at', 'desc')->get(); // Ambil semua

        return view('risnha.profile.index', compact('profile', 'organisasis'));
    }

    /**
     * Menyimpan atau memperbarui Visi & Misi.
     */
    public function storeVisiMisi(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        VisiMisiRisnha::updateOrCreate(
            ['id' => 1],
            ['visi' => $request->visi, 'misi' => $request->misi]
        );

        return back()->with('successVisiMisi', 'Visi & Misi berhasil diperbarui.');
    }

    /**
     * Menyimpan data Struktur Organisasi BARU.
     */
    public function storeOrganisasi(Request $request)
    {
        $request->validate([
            'gambar_organisasi' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $imageName = time() . '.' . $request->file('gambar_organisasi')->getClientOriginalExtension();
        $request->file('gambar_organisasi')->move(public_path('images/organisasi_risnha'), $imageName);

        StrukturOrganisasiRisnha::create([
            'gambar_organisasi' => $imageName,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('successOrganisasi', 'Struktur Organisasi baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui data Struktur Organisasi yang sudah ada.
     */
    public function updateOrganisasi(Request $request, $id)
    {
        $request->validate([
            'gambar_organisasi' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // Opsional saat update
            'deskripsi' => 'nullable|string',
        ]);

        $organisasi = StrukturOrganisasiRisnha::findOrFail($id);
        $organisasi->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar_organisasi')) {
            // Hapus gambar lama
            $oldImagePath = public_path('images/organisasi_risnha/' . $organisasi->gambar_organisasi);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Upload gambar baru
            $image = $request->file('gambar_organisasi');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/organisasi_risnha'), $imageName);
            $organisasi->gambar_organisasi = $imageName;
        }

        $organisasi->save();

        return back()->with('successOrganisasi', 'Struktur Organisasi berhasil diperbarui.');
    }

    /**
     * Menghapus data Struktur Organisasi.
     */
    public function destroyOrganisasi($id)
    {
        $organisasi = StrukturOrganisasiRisnha::findOrFail($id);

        // Hapus gambar dari folder public
        $imagePath = public_path('images/organisasi_risnha/' . $organisasi->gambar_organisasi);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Hapus data dari database
        $organisasi->delete();

        return back()->with('successOrganisasi', 'Struktur Organisasi berhasil dihapus.');
    }
}