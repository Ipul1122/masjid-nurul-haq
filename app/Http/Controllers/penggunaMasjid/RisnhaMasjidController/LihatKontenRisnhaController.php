<?php

namespace App\Http\Controllers\penggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\ArtikelRisnha;
use App\Models\KegiatanRisnha;
use Illuminate\Http\Request;

class LihatKontenRisnhaController extends Controller
{
    /**
     * Menampilkan konten utama dan konten sebelumnya berdasarkan ID.
     */
    public function show($tipe, $id)
    {
        // Tentukan model berdasarkan tipe konten
        if ($tipe === 'artikel') {
            $model = ArtikelRisnha::class;
        } elseif ($tipe === 'kegiatan') {
            $model = KegiatanRisnha::class;
        } else {
            abort(404, 'Tipe konten tidak dikenal.');
        }

        // Ambil konten utama
        $kontenUtama = $model::findOrFail($id);

        // Ambil konten sebelumnya (id > konten yang dipilih)
        $kontenSebelumnya = $model::where('id', '>', $id)
            ->orderBy('id', 'asc')
            ->take(5) // tampilkan 5 konten berikutnya
            ->get();

        // Kirim ke view
        return view('penggunaMasjid.risnhaMasjid.lihatKontenRisnha', [
            'item' => $kontenUtama,
            'kontenSebelumnya' => $kontenSebelumnya,
        ]);
    }
}
