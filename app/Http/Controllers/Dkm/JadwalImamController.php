<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\JadwalImam;
use App\Models\Notifikasi;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalImamController extends Controller
{
    public function index()
    {
        $jadwal = JadwalImam::latest()->get();
        return view('dkm.manajemenKonten.jadwalImam.index', compact('jadwal'));
    }

    public function create()
    {
        return view('dkm.manajemenKonten.jadwalImam.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'waktu_sholat' => 'required|in:Subuh,Zhuhur,Ashar,Maghrib,Isya',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama', 'waktu_sholat']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('jadwal-imam', 'public');
        }

        $jadwalImam = JadwalImam::create($data);

        // Simpan notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'create',
            'tabel' => 'jadwal_imam',
            'keterangan' => $jadwalImam->nama,
        ]);

        return redirect()->route('dkm.manajemenKonten.jadwalImam.index')
                        ->with('success', 'Jadwal imam berhasil ditambahkan.');
    }

    public function edit(JadwalImam $jadwalImam)
    {
        return view('dkm.manajemenKonten.jadwalImam.edit', compact('jadwalImam'));
    }

    public function update(Request $request, JadwalImam $jadwalImam)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'waktu_sholat' => 'required|in:Subuh,Zhuhur,Ashar,Maghrib,Isya',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama', 'waktu_sholat']);

        if ($request->hasFile('gambar')) {
            if ($jadwalImam->gambar) {
                Storage::disk('public')->delete($jadwalImam->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('jadwal-imam', 'public');
        }

        $jadwalImam->update($data);

        // Simpan notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'jadwal_imam',
            'keterangan' => $jadwalImam->nama,
        ]);

        return redirect()->route('dkm.manajemenKonten.jadwalImam.index')
                        ->with('success', 'Jadwal imam berhasil diperbarui.');
    }

    public function destroy(JadwalImam $jadwalImam)
    {
        if ($jadwalImam->gambar) {
            Storage::disk('public')->delete($jadwalImam->gambar);
        }

        $nama = $jadwalImam->nama;
        $jadwalImam->delete();

        // Simpan notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'jadwal_imam',
            'keterangan' => $nama,
        ]);

        return redirect()->route('dkm.manajemenKonten.jadwalImam.index')
                        ->with('success', 'Jadwal imam berhasil dihapus.');
    }
}
