<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\MuhasabahGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MuhasabahGroupController extends Controller
{
    public function index()
    {
        $groups = MuhasabahGroup::latest()->get();
        return view('dkm.muhasabah.group.index', compact('groups'));
    }

    public function create()
    {
        return view('dkm.muhasabah.group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_group' => 'required|string|max:255',
            'username' => 'required|string|unique:muhasabah_groups,username',
            'password' => 'required|string|min:4', // Minimal 4 biar mudah diingat bapak-bapak
        ], [
            'username.unique' => 'Username ini sudah dipakai oleh group lain.',
        ]);

        MuhasabahGroup::create([
            'nama_group' => $request->nama_group,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dkm.muhasabah.group.index')
            ->with('success', 'Group berhasil dibuat!');
    }

    public function edit($id)
    {
        $group = MuhasabahGroup::findOrFail($id);
        return view('dkm.muhasabah.group.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $group = MuhasabahGroup::findOrFail($id);

        $request->validate([
            'nama_group' => 'required|string|max:255',
            'username' => 'required|string|unique:muhasabah_groups,username,' . $id,
            'password' => 'nullable|string|min:4',
        ]);

        $data = [
            'nama_group' => $request->nama_group,
            'username' => $request->username,
        ];

        // Hanya update password jika diisi formnya (biar tidak overwrite jika kosong)
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $group->update($data);

        return redirect()->route('dkm.muhasabah.group.index')
            ->with('success', 'Data Group berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $group = MuhasabahGroup::findOrFail($id);
        $group->delete();

        return redirect()->route('dkm.muhasabah.group.index')
            ->with('success', 'Group berhasil dihapus.');
    }
}