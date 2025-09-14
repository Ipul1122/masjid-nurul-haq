<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Dkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagePenggunaController extends Controller
{
    public function index()
    {
        $managePengguna = Dkm::all();
        return view('dkm.managePengguna.index', compact('managePengguna'));
    }

    public function create()
    {
        return view('dkm.managePengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:dkms,username',
            'password' => 'required|min:6',
        ]);

        Dkm::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dkm.managePengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit(Dkm $user)
    {
        return view('dkm.managePengguna.edit', compact('user'));
    }

    public function update(Request $request, Dkm $user)
    {
        $request->validate([
            'username' => 'required|unique:dkms,username,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $data = ['username' => $request->username];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('dkm.managePengguna.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(Dkm $user)
    {
        $user->delete();
        return redirect()->route('dkm.managePengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
