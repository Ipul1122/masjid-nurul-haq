<?php
namespace App\Http\Controllers\penggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\ArtikelRisnha;
use App\Models\Kegiatan;
use App\Models\KegiatanRisnha;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LihatKontenController extends Controller
{
    /**
     * Menampilkan detail konten berdasarkan tipe dan ID.
     */
    public function show($type, $id)
    {
        $konten = null;

        try {
            if ($type === 'artikel') {
                $konten = Artikel::where('status', 'published')->findOrFail($id);
                
                // Ambil artikel terbaru (kecuali artikel yang sedang dibuka)
                $latestUpdates = Artikel::where('status', 'published')
                    ->where('id', '!=', $id)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                    
            } elseif ($type === 'kegiatan') {
                $konten = Kegiatan::where('status', 'published')->findOrFail($id);
                
                // Ambil kegiatan terbaru (kecuali kegiatan yang sedang dibuka)
                $latestUpdates = Kegiatan::where('status', 'published')
                    ->where('id', '!=', $id)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                    
            } else {
                abort(404); // Tipe konten tidak valid
            }

            $konten->increment('views');

        } catch (ModelNotFoundException $e) {
            abort(404); // Konten tidak ditemukan atau belum dipublikasikan
        }

        return view('penggunaMasjid.lihatKonten.index', compact('konten', 'latestUpdates', 'type'));
    }
}