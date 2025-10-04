<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\Risnha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenPenggunaRisnhaController extends Controller
{
    /**
     * Tampilkan daftar pengguna Risnha.
     */
    public function index()
    {
        $risnhas = Risnha::latest()->get();
        return view('risnha.manajemenPenggunaRisnha.index', compact('risnhas'));
    }

    /**
     * Form tambah pengguna.
     */
    public function create()
    {
        return view('risnha.manajemenPenggunaRisnha.create');
    }

    /**
     * Simpan pengguna baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:risnhas,username',
            'password' => 'required|string|min:6',
        ]);

        Risnha::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('risnha.manajemenPenggunaRisnha.index')
                         ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Form edit pengguna.
     */
    public function edit($id)
    {
        $risnha = Risnha::findOrFail($id);
        return view('risnha.manajemenPenggunaRisnha.edit', compact('risnha'));
    }

    /**
     * Update pengguna.
     */
    public function update(Request $request, $id)
    {
        $risnha = Risnha::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255|unique:risnhas,username,' . $risnha->id,
            'password' => 'nullable|string|min:6',
        ]);

        $risnha->username = $request->username;

        if ($request->filled('password')) {
            $risnha->password = Hash::make($request->password);
        }

        $risnha->save();

        return redirect()->route('risnha.manajemenPenggunaRisnha.index')
                         ->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Hapus pengguna.
     */
    public function destroy($id)
    {
        $risnha = Risnha::findOrFail($id);

        // 🚫 Tidak boleh hapus akun admin
        if ($risnha->username === 'admin') {
            return redirect()->route('risnha.manajemenPenggunaRisnha.index')
                            ->withErrors(['delete' => 'Akun admin tidak bisa dihapus.']);
        }

        // ✅ Admin boleh hapus semua akun kecuali admin
        if (session('risnha_username') === 'admin') {
            $risnha->delete();
            return redirect()->route('risnha.manajemenPenggunaRisnha.index')
                            ->with('success', 'Pengguna berhasil dihapus.');
        }

        // ✅ User biasa hanya boleh hapus dirinya sendiri
        if (session('risnha_id') == $risnha->id) {
            $risnha->delete();
            session()->forget(['risnha_id', 'risnha_username']); // otomatis logout
            return redirect()->route('risnha.login')->with('success', 'Akun Anda berhasil dihapus.');
        }

        // 🚫 Selain itu tolak
        return redirect()->route('risnha.manajemenPenggunaRisnha.index')
                        ->withErrors(['delete' => 'Anda tidak punya akses menghapus akun ini.']);
    }

}
