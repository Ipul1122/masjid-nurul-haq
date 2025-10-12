<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\TampilanHomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TampilanHomeSectionPenggunaController extends Controller
{
    public function homeSectionIndex()
    {
        $images = TampilanHomeSection::orderBy('order')->get();
        return view('dkm.tampilanPenggunaMasjid.homeSection', compact('images'));
    }

    // Metode ini sekarang hanya untuk MENAMBAH gambar baru
    public function homeSectionStore(Request $request)
    {
        $request->validate([
            'carousel_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('carousel_images')) {
            foreach ($request->file('carousel_images') as $index => $file) {
                $path = $file->store('carousel', 'public');
                TampilanHomeSection::create([
                    'image_path' => $path,
                    // Dapatkan order terakhir dan tambahkan 1
                    'order' => TampilanHomeSection::max('order') + 1 + $index,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Gambar baru berhasil ditambahkan.');
    }

    // Metode baru untuk MENGHAPUS gambar
    public function homeSectionDestroy($id)
    {
        $image = TampilanHomeSection::findOrFail($id);
        
        // Hapus file dari storage
        Storage::disk('public')->delete($image->image_path);
        
        // Hapus record dari database
        $image->delete();

        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }
}