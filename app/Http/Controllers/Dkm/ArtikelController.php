<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->get();
        return view('dkm.manajemenKonten.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('dkm.manajemenKonten.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['tanggal_rilis'] = now(); // default hari ini

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create($data);

        return redirect()->route('dkm.manajemenKonten.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('dkm.manajemenKonten.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'tanggal_rilis' => 'required|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($data);

        return redirect()->route('dkm.manajemenKonten.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('dkm.manajemenKonten.artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
