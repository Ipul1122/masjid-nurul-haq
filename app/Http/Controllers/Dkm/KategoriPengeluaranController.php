<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengeluaran;
use Illuminate\Http\Request;

class KategoriPengeluaranController extends Controller
{
    public function index()
    {
        $kategori = KategoriPengeluaran::all();
        return view('dkm.kategori.pengeluaran.index', compact('kategori'));
    }

    public function create()
    {
        return view('dkm.kategori.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriPengeluaran::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('dkm.kategori.pengeluaran.index')
                         ->with('success', 'Kategori pengeluaran berhasil ditambahkan.');
    }

    public function edit(KategoriPengeluaran $pengeluaran)
    {
        return view('dkm.kategori.pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, KategoriPengeluaran $pengeluaran)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $pengeluaran->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('dkm.kategori.pengeluaran.index')
                         ->with('success', 'Kategori pengeluaran berhasil diperbarui.');
    }

    public function destroy(KategoriPengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()->route('dkm.kategori.pengeluaran.index')
                         ->with('success', 'Kategori pengeluaran berhasil dihapus.');
    }
}
