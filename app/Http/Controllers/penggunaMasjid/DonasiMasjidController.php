<?php

namespace App\Http\Controllers\PenggunaMasjid; // Pastikan namespace-nya benar

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi; 

class DonasiMasjidController extends Controller // Nama kelas diubah menjadi DonasiController
{
    /**
     * Menampilkan halaman donasi utama.
     */
    public function index()
    {
        // Langsung arahkan ke view yang benar
        return view('penggunaMasjid.donasi.index'); 
    }

    /**
     * Menampilkan halaman form untuk mengirim bukti donasi.
     */
    public function kirimBukti()
    {
        return view('penggunaMasjid.donasi.kirimBukti');
    }

    /**
     * Menyimpan data bukti donasi yang dikirim dari form.
     */
    public function storeBukti(Request $request)
    {
        $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $file = $request->file('bukti_transfer');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('bukti_donasi'), $fileName);

        // Simpan informasi ke database
        Donasi::create([
            'nama_donatur' => $request->nama_donatur,
            'file_bukti' => $fileName,
            'status' => 'pending', // Status awal adalah pending
        ]);
        
        // Arahkan redirect ke nama route yang benar
        return redirect()->route('penggunaMasjid.donasi.index')->with('success', 'Terima kasih, bukti transfer Anda akan segera kami verifikasi.');
    }

    /**
     * Menampilkan donasi yang sudah terverifikasi.
     */
    public function hasilDonasi()
    {
        $donasiTerverifikasi = Donasi::where('status', 'verified')->latest()->get();
        return view('penggunaMasjid.donasi.hasilDonasi', compact('donasiTerverifikasi'));
    }
}