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
        $expiryTime = session('expiry_time');

        // [PENGAMANAN BARU]: Jika waktu 20 menit sudah lewat, bersihkan antrean!
        if ($expiryTime && (now()->timestamp * 1000) > $expiryTime) {
            session()->forget(['pending_donasi_token', 'data_donasi_sementara', 'expiry_time']);
        }

        // Ambil token (akan bernilai null jika baru saja dihapus di atas)
        $pendingToken = session('pending_donasi_token');
        
        return view('penggunaMasjid.donasi.index', compact('pendingToken'));
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
        if (session()->has('data_donasi_sementara')) {
            $dataDonasi = session('data_donasi_sementara');
            
            Donasi::create([
                'nama_donatur' => !empty($dataDonasi['nama']) ? $dataDonasi['nama'] : 'Hamba Allah',
                'nominal' => $dataDonasi['nominal'],
                'pesan' => !empty($dataDonasi['pesan']) ? $dataDonasi['pesan'] : 'Jazakumullah Khairan Katsiran',
            ]);
            
        }

        // Hapus semua session terkait donasi saat sukses
        session()->forget(['pending_donasi_token', 'data_donasi_sementara', 'expiry_time']);

        $donasis = Donasi::latest()->get();
        return view('penggunaMasjid.donasi.hasilDonasi', compact('donasis'));
    }

  public function prosesDonasi(Request $request)
    {
        if (session()->has('pending_donasi_token')) {
            return redirect()->route('penggunaMasjid.donasi.index')->with('info', 'Harap selesaikan atau batalkan transaksi Anda sebelumnya terlebih dahulu.');
        }

        $request->validate([
            'nominal' => 'required|numeric|min:10000',
            'nama' => 'nullable|string',
            'pesan' => 'nullable|string',
        ]);

        $orderId = 'DONASI-' . uniqid();

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $request->nominal,
            ),
            'customer_details' => array(
                'first_name' => $request->nama ?? 'Hamba Allah',
            ),
            'custom_expiry' => array(
                'start_time' => date("Y-m-d H:i:s O"),
                'unit' => 'minute', 
                'duration'  => 20 // UBAH KE 20 MENIT
            )
        );

        $snapToken = Snap::getSnapToken($params);

        // Buat waktu kedaluwarsa persis 20 menit dari sekarang (dalam format timestamp milidetik untuk JavaScript)
        $expiryTime = now()->addMinutes(20)->timestamp * 1000;

        session([
            'pending_donasi_token' => $snapToken,
            'expiry_time' => $expiryTime, 
            'data_donasi_sementara' => [
                'nama' => $request->nama,
                'nominal' => $request->nominal,
                'pesan' => $request->pesan,
            ]
        ]);

        return view('penggunaMasjid.donasi.bayar', [
            'snapToken' => $snapToken,
            'nominal' => $request->nominal,
            'nama' => $request->nama,
            'expiryTime' => $expiryTime
        ]);
    }

    public function resumeDonasi()
    {
        $snapToken = session('pending_donasi_token');
        $dataDonasi = session('data_donasi_sementara');
        $expiryTime = session('expiry_time');

        // Jika waktu di server sudah melebihi expiry_time, otomatis batalkan
        if ($expiryTime && (now()->timestamp * 1000) > $expiryTime) {
            session()->forget(['pending_donasi_token', 'data_donasi_sementara', 'expiry_time']);
            return redirect()->route('donasi.index')->with('info', 'Waktu pembayaran telah habis. Transaksi dibatalkan otomatis.');
        }

        if (!$snapToken || !$dataDonasi) {
            return redirect()->route('penggunaMasjid.donasi.index');
        }

        return view('penggunaMasjid.donasi.bayar', [
            'snapToken' => $snapToken,
            'nominal' => $dataDonasi['nominal'],
            'nama' => $dataDonasi['nama'],
            'expiryTime' => $expiryTime
        ]);
    }

        public function batalDonasi()
    {
        // Hapus semua session saat user klik batal atau waktu habis
        session()->forget(['pending_donasi_token', 'data_donasi_sementara', 'expiry_time']);
        return redirect()->route('penggunaMasjid.donasi.index')->with('info', 'Transaksi dibatalkan. Silakan buat donasi baru.');
    }
}