<?php

namespace App\Http\Controllers\penggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Kegiatan;
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
            } elseif ($type === 'kegiatan') {
                $konten = Kegiatan::where('status', 'published')->findOrFail($id);
            } else {
                abort(404); // Tipe konten tidak valid
            }

             $konten->increment('views');

        } catch (ModelNotFoundException $e) {
            abort(404); // Konten tidak ditemukan atau belum dipublikasikan
        }

        return view('penggunaMasjid.lihatKonten.index', compact('konten'));
    }
}