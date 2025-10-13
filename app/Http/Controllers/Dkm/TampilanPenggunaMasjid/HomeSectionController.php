<?php

namespace App\Http\Controllers\Dkm\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TampilanPenggunaMasjid\HomeSection;
use Illuminate\Support\Facades\Storage;

class HomeSectionController extends Controller
{
    public function index()
    {
        $images = HomeSection::all();
        return view('dkm.TampilanPenggunaMasjid.homeSection', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'carousel_images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('carousel_images')) {
            foreach ($request->file('carousel_images') as $image) {
                // Perubahan: Simpan file di 'storage/app/public/carousel' dan dapatkan path relatifnya
                $path = $image->store('carousel', 'public');

                // Simpan path relatif ini ke database, contoh: 'carousel/namafile.jpg'
                HomeSection::create(['image_path' => $path]);
            }
        }

        return back()->with('success', 'Gambar berhasil diunggah.');
    }

    public function destroy(HomeSection $homeSection)
    {
        // Perubahan: Gunakan path relatif dari database untuk menghapus file dari disk 'public'
        Storage::disk('public')->delete($homeSection->image_path);

        $homeSection->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}