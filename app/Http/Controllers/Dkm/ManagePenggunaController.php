<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dkm;
use Illuminate\Support\Facades\Hash;

class ManagePenggunaController extends Controller
{
    public function index()
    {
        // gunakan nama variabel yang sama seperti di view: $managePengguna
        $managePengguna = Dkm::orderBy('id')->get();
        return view('dkm.managePengguna.index', compact('managePengguna'));
    }

    public function create()
    {
        return view('dkm.managePengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:dkms,username',
            'password' => 'required|string|min:6',
        ]);

        Dkm::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dkm.managePengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    // NOTE: route-model binding otomatis akan inject Dkm $managePengguna
    public function edit(Dkm $managePengguna)
    {
        // pastikan nama variabel sama dengan yang view pakai
        return view('dkm.managePengguna.edit', compact('managePengguna'));
    }

    public function update(Request $request, Dkm $managePengguna)
    {
        $request->validate([
            'username' => 'required|string|unique:dkms,username,' . $managePengguna->id,
            'password' => 'nullable|string|min:6',
        ]);

        $managePengguna->username = $request->username;

        if ($request->filled('password')) {
            $managePengguna->password = Hash::make($request->password);
        }

        $managePengguna->save();

        return redirect()->route('dkm.managePengguna.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(Dkm $managePengguna)
    {
        // Cegah hapus akun yang sedang login
        if (session('dkm_id') && session('dkm_id') == $managePengguna->id) {
            return redirect()->route('dkm.managePengguna.index')
                ->with('error', 'Tidak bisa menghapus akun yang sedang login.');
        }

        // Cegah hapus jika hanya ada 1 akun DKM
        if (Dkm::count() <= 1) {
            return redirect()->route('dkm.managePengguna.index')
                ->with('error', 'Minimal harus ada 1 akun DKM, tidak bisa dihapus semua.');
        }

        // Jika lolos semua pengecekan → hapus
        $managePengguna->delete();

        return redirect()->route('dkm.managePengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

}
