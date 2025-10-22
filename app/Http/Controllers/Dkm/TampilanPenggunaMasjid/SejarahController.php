<?php

namespace App\Http\Controllers\Dkm\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Notifikasi; // Pastikan model Notifikasi sudah di-import

class SejarahController extends Controller
{
    public function index()
    {
        // AMBIL SEMUA DATA, LALU URUTKAN DENGAN PHP
        $sejarahs = Sejarah::all()->sortByDesc(function ($sejarah) {
            preg_match('/(\d{4})/', $sejarah->judul, $matches);
            return (int) ($matches[1] ?? 0);
        });

        return view('dkm.tampilanPenggunaMasjid.sejarah.index', compact('sejarahs'));
    }

    public function create()
    {
        return view('dkm.tampilanPenggunaMasjid.sejarah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        // Simpan data seperti biasa
        $sejarah = Sejarah::create($request->all());

        // Buat Notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'), // Pastikan session 'dkm_id' tersedia
            'aksi' => 'create',
            'tabel' => 'sejarah', // ** Perbaikan: Ganti 'artikel' menjadi 'sejarah' **
            'keterangan' => 'Menambahkan sejarah baru: "' . Str::limit($sejarah->judul, 50) . '"', // ** Perbaikan: Keterangan lebih deskriptif **
        ]);

        // Cek apakah judul yang disimpan mengandung tahun
        $judul = $request->input('judul');
        $hasYear = preg_match('/(\d{4})/', $judul);

        $redirect = redirect()->route('dkm.tampilanPenggunaMasjid.sejarah.index');

        $redirect->with('success','Sejarah berhasil dibuat.');

        if (!$hasYear) {
            $redirect->with('warning_no_year', 'Peringatan: Judul "' . Str::limit($judul, 30) . '..." tidak mengandung tahun 4 digit. Pengurutan mungkin tidak akurat.');
        }

        return $redirect;
    }


    public function edit(Sejarah $sejarah)
    {
        return view('dkm.tampilanPenggunaMasjid.sejarah.edit', compact('sejarah'));
    }


    public function update(Request $request, Sejarah $sejarah)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        // Simpan judul lama sebelum update untuk notifikasi
        $judulLama = $sejarah->judul;

        // Update data seperti biasa
        $sejarah->update($request->all());

        // ** Tambahkan Notifikasi untuk Update **
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'sejarah',
            'keterangan' => 'Memperbarui sejarah: "' . Str::limit($judulLama, 50) . '" menjadi "' . Str::limit($sejarah->judul, 50) . '"',
        ]);

        // Cek apakah judul yang diupdate mengandung tahun
        $judul = $request->input('judul');
        $hasYear = preg_match('/(\d{4})/', $judul);

        $redirect = redirect()->route('dkm.tampilanPenggunaMasjid.sejarah.index');

        $redirect->with('success','Sejarah berhasil diperbarui.');

        if (!$hasYear) {
            $redirect->with('warning_no_year', 'Peringatan: Judul "' . Str::limit($judul, 30) . '..." tidak mengandung tahun 4 digit. Pengurutan mungkin tidak akurat.');
        }

        return $redirect;
    }

    public function destroy(Sejarah $sejarah)
    {
        // Simpan judul sebelum dihapus untuk notifikasi
        $judulDihapus = $sejarah->judul;

        // ** Tambahkan Notifikasi untuk Hapus (sebelum data dihapus) **
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'sejarah',
            'keterangan' => 'Menghapus sejarah: "' . Str::limit($judulDihapus, 50) . '"',
        ]);
        // ** Akhir Tambahan Notifikasi Hapus **

        // Hapus data
        $sejarah->delete();

        return redirect()->route('dkm.tampilanPenggunaMasjid.sejarah.index')
                         ->with('success','Sejarah berhasil dihapus.');
    }
}