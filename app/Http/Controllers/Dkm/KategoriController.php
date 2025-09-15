<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('dkm.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('dkm.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100'
        ]);

        Kategori::create($request->only('nama'));

        return redirect()->route('dkm.kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori)
    {
        return view('dkm.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:100'
        ]);

        $kategori->update($request->only('nama'));

        return redirect()->route('dkm.kategori.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('dkm.kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
