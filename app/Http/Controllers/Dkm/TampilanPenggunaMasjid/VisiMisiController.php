<?php

namespace App\Http\Controllers\Dkm\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /**
     * Menampilkan daftar Visi & Misi.
     */
    public function index()
    {
        // Biasanya hanya akan ada satu data VisiMisi, jadi kita ambil yang pertama.
        // Jika belum ada, kita buat instance baru agar view tidak error.
        $visiMisi = VisiMisi::firstOrNew([]);
        $dataExists = VisiMisi::exists(); // Cek apakah sudah ada data di database

        return view('dkm.tampilanPenggunaMasjid.visiMisi.index', compact('visiMisi', 'dataExists'));
    }

    /**
     * Menampilkan form untuk membuat Visi & Misi baru.
     */
    public function create()
    {
        // Redirect ke halaman edit jika sudah ada data, karena VisiMisi biasanya hanya satu.
        if (VisiMisi::exists()) {
            $visiMisi = VisiMisi::first();
            return redirect()->route('visiMisi.edit', $visiMisi->id)->with('info', 'Data Visi & Misi sudah ada, silakan edit di sini.');
        }
        return view('dkm.tampilanPenggunaMasjid.visiMisi.create');
    }

    /**
     * Menyimpan Visi & Misi yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        // Mencegah pembuatan data baru jika sudah ada
        if (VisiMisi::exists()) {
             return redirect()->route('dkm.tampilanPenggunaMasjid.visiMisi.index')->with('error', 'Data Visi & Misi sudah ada.');
        }

        VisiMisi::create($request->all());

        return redirect()->route('dkm.tampilanPenggunaMasjid.visiMisi.index')
                         ->with('success', 'Visi & Misi berhasil dibuat.');
    }


    /**
     * Menampilkan form untuk mengedit Visi & Misi.
     * Menggunakan Route Model Binding untuk mengambil data VisiMisi secara otomatis.
     */
    public function edit(VisiMisi $visiMisi)
    {
        return view('dkm.tampilanPenggunaMasjid.visiMisi.edit', compact('visiMisi'));
    }

    /**
     * Memperbarui Visi & Misi di database.
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        $visiMisi->update($request->all());

        return redirect()->route('dkm.tampilanPenggunaMasjid.visiMisi.index')
                         ->with('success', 'Visi & Misi berhasil diperbarui.');
    }

    /**
     * Menghapus Visi & Misi dari database.
     */
    public function destroy(VisiMisi $visiMisi)
    {
        $visiMisi->delete();

        return redirect()->route('dkm.tampilanPenggunaMasjid.visiMisi.index')
                         ->with('success', 'Visi & Misi berhasil dihapus.');
    }
}
