<?php
// app/Http/Controllers/Dkm/TampilanPenggunaMasjid/BuktiDonasiController.php
namespace App\Http\Controllers\Dkm\TampilanPenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BuktiDonasiMasjidController extends Controller
{
    // Menampilkan daftar donasi yang masih pending
    public function index()
    {
        $donasiPending = Donasi::where('status', 'pending')->latest()->get();
        return view('dkm.tampilanPenggunaMasjid.buktiDonasi.index', compact('donasiPending'));
    }

    // Memverifikasi donasi
    public function verify(Donasi $donasi)
    {
        $donasi->update(['status' => 'verified']);
        return redirect()->back()->with('success', 'Donasi berhasil diverifikasi.');
    }

    // Menolak dan menghapus donasi
    public function reject(Donasi $donasi)
    {
        // Hapus file gambar dari folder public
        $filePath = public_path('bukti_donasi/' . $donasi->file_bukti);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Hapus record dari database
        $donasi->delete();

        return redirect()->back()->with('success', 'Donasi telah ditolak dan dihapus.');
    }
}