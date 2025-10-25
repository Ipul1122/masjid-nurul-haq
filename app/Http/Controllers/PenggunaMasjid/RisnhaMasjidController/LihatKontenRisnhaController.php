<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\ArtikelRisnha;
use App\Models\KegiatanRisnha;
use Illuminate\Http\Request;

class LihatKontenRisnhaController extends Controller
{
    /**
     * Menampilkan konten utama dan konten sebelumnya berdasarkan ID.
     */

    

    public function show($type, $id)
    {
        // Tentukan model berdasarkan tipe konten (mengikuti parameter 'type' yang dikirim dari view)
        if ($type === 'artikel') {
            $model = ArtikelRisnha::class;
        } elseif ($type === 'kegiatan') {
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
