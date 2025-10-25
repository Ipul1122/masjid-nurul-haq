<?php

namespace App\Http\Controllers\Risnha\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\TampilanPenggunaMasjid\HomeSectionRisnha;
use App\Models\NotifikasiRisnha; // Import NotifikasiRisnha model
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

        $homeSection = HomeSectionRisnha::create(['gambar' => $imageName]);

        // Create notification for adding data
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'create',
            'tabel' => 'home_section_risnhas',
            'keterangan' => "Menambahkan gambar baru ke carousel: " . $imageName,
        ]);

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

        $oldImageName = $homeSectionRisnha->gambar; // Store old image name for notification
        $newImageName = $oldImageName; // Initialize new image name

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($oldImageName && file_exists(public_path('images/risnha_carousel/' . $oldImageName))) {
                unlink(public_path('images/risnha_carousel/' . $oldImageName));
            }

            $newImageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/risnha_carousel'), $newImageName);
            $homeSectionRisnha->update(['gambar' => $newImageName]);
        }

        // Create notification for editing data only if image was changed
        if ($oldImageName !== $newImageName) {
            NotifikasiRisnha::create([
                'risnha_id' => session('risnha_id'),
                'aksi' => 'update',
                'tabel' => 'home_section_risnhas',
                'keterangan' => "Memperbarui gambar carousel (ID: {$homeSectionRisnha->id}) dari {$oldImageName} menjadi {$newImageName}",
            ]);
        } else {
             // Optional: Create notification even if only other fields (if any) are updated
             // NotifikasiRisnha::create([
             //     'risnha_id' => session('risnha_id'),
             //     'aksi' => 'update',
             //     'tabel' => 'home_section_risnhas',
             //     'keterangan' => "Memperbarui data gambar carousel (ID: {$homeSectionRisnha->id}) tanpa mengubah file gambar.",
             // ]);
        }


        return redirect()->route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.index')->with('success','Gambar berhasil diperbarui.');
    }

    public function destroy(HomeSectionRisnha $homeSectionRisnha)
    {
        $imageNameToDelete = $homeSectionRisnha->gambar; // Store image name before deleting record
        $homeSectionId = $homeSectionRisnha->id; // Store ID for notification

        // Delete the image file if it exists
        if ($imageNameToDelete && file_exists(public_path('images/risnha_carousel/' . $imageNameToDelete))) {
            unlink(public_path('images/risnha_carousel/' . $imageNameToDelete));
        }

        // Delete the record from database
        $homeSectionRisnha->delete();

        // Create notification for deleting data
        NotifikasiRisnha::create([
            'risnha_id' => session('risnha_id'),
            'aksi' => 'delete',
            'tabel' => 'home_section_risnhas',
            'keterangan' => "Menghapus gambar carousel (ID: {$homeSectionId}): " . $imageNameToDelete,
        ]);

        return redirect()->route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.index')->with('success','Gambar berhasil dihapus.');
    }
}
