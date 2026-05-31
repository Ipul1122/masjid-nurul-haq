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
        $lastDonasi = null;
        if (session()->has('last_donation_id')) {
            $lastDonasi = Donasi::find(session('last_donation_id'));
        }
        return view('penggunaMasjid.donasi.kirimBukti', compact('lastDonasi'));
    }

    /**
     * Menyimpan data bukti donasi yang dikirim dari form.
     */
    public function storeBukti(Request $request)
    {
        if (session()->has('last_donation_id')) {
            $request->validate([
                'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            ]);

            $donasi = Donasi::findOrFail(session('last_donation_id'));
            
            $file = $request->file('bukti_transfer');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti_donasi'), $fileName);

            $donasi->update([
                'file_bukti' => $fileName,
                'status' => 'pending'
            ]);

            session()->forget('last_donation_id');

            return redirect()->route('penggunaMasjid.donasi.index')->with('success', 'Terima kasih, bukti transfer Anda akan segera kami verifikasi.');
        }

        $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:1000',
            'pesan' => 'nullable|string',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $file = $request->file('bukti_transfer');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('bukti_donasi'), $fileName);

        // Simpan informasi ke database
        Donasi::create([
            'nama_donatur' => $request->nama_donatur,
            'nominal' => $request->nominal,
            'pesan' => $request->pesan,
            'file_bukti' => $fileName,
            'status' => 'pending', // Status awal adalah pending
        ]);
        
        // Arahkan redirect ke nama route yang benar
        return redirect()->route('penggunaMasjid.donasi.index')->with('success', 'Terima kasih, bukti transfer Anda akan segera kami verifikasi.');
    }

    /**
     * Menampilkan donasi yang sudah terverifikasi.
     */
    public function hasilDonasi(Request $request)
    {
        $currentMonth = \Carbon\Carbon::now()->month;
        $currentYear  = \Carbon\Carbon::now()->year;

        // Ambil filter dari request
        $month = $request->get('month', $currentMonth);
        $year = $request->get('year', $currentYear);

        $query = Donasi::where('status', 'verified')->latest();

        if ($month && $month !== 'all') {
            $query->whereMonth('created_at', $month);
        }
        if ($year && $year !== 'all') {
            $query->whereYear('created_at', $year);
        }

        $donasis = $query->paginate(10)->withQueryString();

        // Daftar tahun untuk filter
        $availableYears = Donasi::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        if (empty($availableYears)) {
            $availableYears = [$currentYear];
        }

        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        return view('penggunaMasjid.donasi.hasilDonasi', compact('donasis', 'month', 'year', 'availableYears', 'months'));
    }

    /**
     * Memproses penyelesaian transaksi sukses Midtrans.
     */
    public function paymentSuccess()
    {
        if (session()->has('data_donasi_sementara')) {
            $dataDonasi = session('data_donasi_sementara');
            
            $donasi = Donasi::create([
                'nama_donatur' => !empty($dataDonasi['nama']) ? $dataDonasi['nama'] : 'Hamba Allah',
                'nominal' => $dataDonasi['nominal'],
                'pesan' => !empty($dataDonasi['pesan']) ? $dataDonasi['pesan'] : 'Jazakumullah Khairan Katsiran',
                'status' => 'pending',
            ]);

            session(['last_donation_id' => $donasi->id]);
        }

        // Hapus semua session terkait donasi saat sukses
        session()->forget(['pending_donasi_token', 'data_donasi_sementara', 'expiry_time']);

        return redirect()->route('penggunaMasjid.donasi.kirimBukti')->with('success', 'Pembayaran berhasil dilakukan!');
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
            return redirect()->route('penggunaMasjid.donasi.index')->with('info', 'Waktu pembayaran telah habis. Transaksi dibatalkan otomatis.');
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

    public function finishFlow(Request $request)
    {
        session()->forget('last_donation_id');
        
        if ($request->get('to') === 'beranda') {
            return redirect()->route('index');
        }
        
        return redirect()->route('penggunaMasjid.donasi.index');
    }
}