<?php

namespace App\Http\Controllers\Risnha\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\TampilanPenggunaMasjid\HomeSectionRisnha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSectionRisnhaController extends Controller
{
    public function index()
    {
        $homeSectionRisnhas = HomeSectionRisnha::all();
        return view('risnha.tampilanPenggunaMasjid.homeSectionRisnha.index', compact('homeSectionRisnhas'));
    }

    public function create()
    {
        return view('risnha.tampilanPenggunaMasjid.homeSectionRisnha.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('images/risnha_carousel'), $imageName);

        HomeSectionRisnha::create(['gambar' => $imageName]);

        return redirect()->route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.index')->with('success','Gambar berhasil ditambahkan.');
    }

    public function edit(HomeSectionRisnha $homeSectionRisnha)
    {
        return view('risnha.tampilanPenggunaMasjid.homeSectionRisnha.edit', compact('homeSectionRisnha'));
    }

    public function update(Request $request, HomeSectionRisnha $homeSectionRisnha)
    {
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if (file_exists(public_path('images/risnha_carousel/' . $homeSectionRisnha->gambar))) {
                unlink(public_path('images/risnha_carousel/' . $homeSectionRisnha->gambar));
            }

            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images/risnha_carousel'), $imageName);
            $homeSectionRisnha->update(['gambar' => $imageName]);
        }

        return redirect()->route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.index')->with('success','Gambar berhasil diperbarui.');
    }

    public function destroy(HomeSectionRisnha $homeSectionRisnha)
    {
        if (file_exists(public_path('images/risnha_carousel/' . $homeSectionRisnha->gambar))) {
            unlink(public_path('images/risnha_carousel/' . $homeSectionRisnha->gambar));
        }
        $homeSectionRisnha->delete();

        return redirect()->route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.index')->with('success','Gambar berhasil dihapus.');
    }
}