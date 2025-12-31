<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\MuhasabahAnggota;
use App\Models\MuhasabahGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MuhasabahAnggotaController extends Controller
{
    // Menampilkan daftar anggota dalam group tertentu
    public function index($group_id)
    {
        $group = MuhasabahGroup::findOrFail($group_id);
        // Ambil anggota milik group ini saja
        $anggotas = $group->anggotas()->latest()->get(); 
        
        return view('dkm.muhasabah.anggota.index', compact('group', 'anggotas'));
    }

    public function create($group_id)
    {
        $group = MuhasabahGroup::findOrFail($group_id);
        return view('dkm.muhasabah.anggota.create', compact('group'));
    }

    public function store(Request $request, $group_id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|unique:muhasabah_anggotas,username',
            'password' => 'required|string|min:4',
        ], [
            'username.unique' => 'Username anggota ini sudah dipakai.',
        ]);

        MuhasabahAnggota::create([
            'group_id' => $group_id, // Otomatis masuk ke group yang dipilih
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dkm.muhasabah.anggota.index', $group_id)
            ->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $anggota = MuhasabahAnggota::with('group')->findOrFail($id);
        return view('dkm.muhasabah.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = MuhasabahAnggota::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|unique:muhasabah_anggotas,username,' . $id,
            'password' => 'nullable|string|min:4',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $anggota->update($data);

        // Redirect balik ke halaman list anggota group tersebut
        return redirect()->route('dkm.muhasabah.anggota.index', $anggota->group_id)
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $anggota = MuhasabahAnggota::findOrFail($id);
        $groupId = $anggota->group_id; // Simpan dulu id groupnya buat redirect
        $anggota->delete();

        return redirect()->route('dkm.muhasabah.anggota.index', $groupId)
            ->with('success', 'Anggota berhasil dihapus.');
    }
}   