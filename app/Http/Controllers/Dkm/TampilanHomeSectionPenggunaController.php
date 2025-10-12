<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\TampilanHomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\RunningText;

// Mengembalikan nama controller agar konsisten
class TampilanHomeSectionPenggunaController extends Controller 
{
    // ... (metode untuk homeSection tidak perlu diubah)
    public function homeSectionIndex()
    {
        $images = TampilanHomeSection::orderBy('order')->get();
        return view('dkm.tampilanPenggunaMasjid.homeSection', compact('images'));
    }

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
                    'order' => TampilanHomeSection::max('order') + 1 + $index,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Gambar baru berhasil ditambahkan.');
    }

    public function homeSectionDestroy($id)
    {
        $image = TampilanHomeSection::findOrFail($id);
        
        Storage::disk('public')->delete($image->image_path);
        
        $image->delete();

        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }

    // RUNNNING TEXT
    public function runningTextIndex()
    {
        $runningText = RunningText::first();
        return view('dkm.tampilanPenggunaMasjid.runningText', compact('runningText'));
    }

    public function runningTextUpdate(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'text_color' => 'required|string',
            'background_color' => 'required|string',
        ]);

        RunningText::updateOrCreate(
            ['id' => 1],
            [
                // Menggunakan metode input() untuk menghindari peringatan
                'content' => $request->input('content'),
                'text_color' => $request->input('text_color'),
                'background_color' => $request->input('background_color'),
            ]
        );

        return redirect()->back()->with('success', 'Running text berhasil diperbarui.');
    }
}