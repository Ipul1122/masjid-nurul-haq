<?php

namespace App\Http\Controllers\PenggunaMasjid; // Pastikan namespace-nya benar

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi; 
use Midtrans\Config;
use Midtrans\Snap;

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
        $donasis = Donasi::latest()->get();
        
        return view('penggunaMasjid.donasi.hasilDonasi', compact('donasis'));
    }

    public function prosesDonasi(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nominal' => 'required|numeric|min:10000',
            'nama' => 'nullable|string',
        ]);

        // 2. Simpan data donasi ke database dengan status 'pending' (Opsional tapi disarankan)
        $orderId = 'DONASI-' . uniqid(); 
        
        // $donasi = Donasi::create([...]); // Silakan aktifkan jika tabel donasi sudah siap

        // 3. Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 4. Buat Parameter untuk dikirim ke Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $request->nominal,
            ),
            'customer_details' => array(
                'first_name' => $request->nama ?? 'Hamba Allah',
            ),
        );

        // 5. Dapatkan Snap Token
        $snapToken = Snap::getSnapToken($params);

        // 6. Return ke view pembayaran dengan membawa $snapToken
        return view('penggunaMasjid.donasi.bayar', compact('snapToken', 'request'));
    }
}