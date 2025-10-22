<?php

namespace App\Http\Controllers\Dkm\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TampilanPenggunaMasjid\HomeSection;
use App\Models\TampilanPenggunaMasjid\RunningText;
use App\Models\Notifikasi; 
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
                $path = $image->store('carousel', 'public');
                HomeSection::create(['image_path' => $path]);
            }

            // <-- TAMBAHKAN NOTIFIKASI DI SINI
            Notifikasi::create([
                'dkm_id' => session('dkm_id'),
                'aksi' => 'create',
                'tabel' => 'home_section', // Sesuaikan dengan tabel Anda
                'keterangan' => 'Menambah gambar carousel baru',
            ]);
        }

        return back()->with('success', 'Gambar berhasil diunggah.');
    }

    public function destroy(HomeSection $homeSection)
    {
        Storage::disk('public')->delete($homeSection->image_path);
        $homeSection->delete();

        // <-- TAMBAHKAN NOTIFIKASI DI SINI
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'home_section', // Sesuaikan dengan tabel Anda
            'keterangan' => 'Menghapus gambar carousel: ' . $homeSection->image_path,
        ]);

        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    // --- Fungsi Baru Untuk Running Text ---

    /**
     * Menampilkan halaman untuk mengatur running text.
     */
    public function runningText()
    {
        $runningText = RunningText::first(); // Ambil teks yang ada
        return view('dkm.TampilanPenggunaMasjid.runningText', compact('runningText'));
    }

    public function storeRunningText(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $runningText = RunningText::updateOrCreate(
            ['id' => 1], // Asumsikan hanya ada satu entri untuk running text
            ['content' => $request->input('content')] // Gunakan metode input() untuk menghindari peringatan
        );

        // <-- TAMBAHKAN NOTIFIKASI DI SINI
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'running_text', // Sesuaikan dengan tabel Anda
            'keterangan' => 'Memperbarui running text: ' . $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Running text berhasil diperbarui.');
    }

    /**
     * Menyimpan atau memperbarui running text.
     */
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

        // <-- TAMBAHKAN NOTIFIKASI DI SINI
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'running_text', // Sesuaikan dengan tabel Anda
            'keterangan' => 'Memperbarui running text (dengan warna): ' . $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Running text berhasil diperbarui.');
    }
}