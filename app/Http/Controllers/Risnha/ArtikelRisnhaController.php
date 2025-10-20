<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\ArtikelRisnha;
use App\Models\KategoriArtikelRisnha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelRisnhaController extends Controller
{
    public function index()
    {
        $artikel = ArtikelRisnha::with('kategori')->latest()->paginate(10);
        return view('risnha.manajemenKontenRisnha.artikelRisnha.index', compact('artikel'));
    }

    public function create()
    {
        $kategoriArtikelRisnha = KategoriArtikelRisnha::all();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.create', compact('kategoriArtikelRisnha'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_artikel_risnha_id' => 'required|exists:kategori_artikel_risnhas,id',
            'deskripsi' => 'required|string', 
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('artikel_risnha', 'public');
            $validatedData['gambar'] = $path;
        }

        $validatedData['status'] = 'draft';
        ArtikelRisnha::create($validatedData);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')->with('success', 'Artikel berhasil disimpan sebagai draf.');
    }

    public function edit(ArtikelRisnha $artikelRisnha)
    {
        $kategoriArtikelRisnha = KategoriArtikelRisnha::all();
        return view('risnha.manajemenKontenRisnha.artikelRisnha.edit', ['artikel' => $artikelRisnha, 'kategori' => $kategoriArtikelRisnha]);
    }

    public function update(Request $request, ArtikelRisnha $artikelRisnha)
    {

        // dd($request->all());

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255', 
            'kategori_artikel_risnha_id' => 'required|exists:kategori_artikel_risnhas,id',
            'deskripsi' => 'required|string', 
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($artikelRisnha->gambar) {
                Storage::disk('public')->delete($artikelRisnha->gambar);
            }
            $path = $request->file('gambar')->store('artikel_risnha', 'public');
            $validatedData['gambar'] = $path;
        }

        $artikelRisnha->update($validatedData);

        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(ArtikelRisnha $artikelRisnha)
    {
        if ($artikelRisnha->gambar) {
            Storage::disk('public')->delete($artikelRisnha->gambar);
        }
        $artikelRisnha->delete();
        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function preview($id)
    {
        $artikel = ArtikelRisnha::with('kategori')->findOrFail($id);
        return view('risnha.manajemenKontenRisnha.artikelRisnha.preview', compact('artikel'));
    }

    public function publish($id)
    {
        $artikel = ArtikelRisnha::findOrFail($id);
        $artikel->status = 'published';
        $artikel->save();
        return redirect()->route('risnha.manajemenKontenRisnha.artikelRisnha.index')->with('success', 'Artikel berhasil dipublikasikan.');
    }
}