<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\JadwalImam;
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
        $jadwal = JadwalImam::all();
        return view('dkm.manajemenKonten.jadwalImam.create', compact('jadwal'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'waktu_sholat' => 'required|in:Subuh,Zhuhur,Ashar,Maghrib,Isya',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('jadwal-imam', 'public');
        }

        JadwalImam::create($data);

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

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            if ($jadwalImam->gambar) {
                Storage::disk('public')->delete($jadwalImam->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('jadwal-imam', 'public');
        }

        $jadwalImam->update($data);

        return redirect()->route('dkm.manajemenKonten.jadwalImam.index')
                        ->with('success', 'Jadwal imam berhasil diperbarui.');
    }


    public function destroy(JadwalImam $jadwalImam)
    {
        if ($jadwalImam->gambar) {
            Storage::disk('public')->delete($jadwalImam->gambar);
        }

        $jadwalImam->delete();

        return redirect()->route('dkm.manajemenKonten.jadwalImam.index')
                        ->with('success', 'Jadwal imam berhasil dihapus.');
    }

}
