<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\TampilanPenggunaMasjid\HomeSection;
use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\JadwalImam; 
use App\Models\VisiMisi;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan konten terbaru dari artikel dan kegiatan.
     */
    public function index()
    {
        // $homeSections = HomeSection::all();

        // Mengambil 6 artikel terbaru yang sudah di-publish sebagai "kandidat"
        $artikelMasjid = Artikel::where('status', 'published') 
            ->latest()
            ->get()
            ->map(function($item) {
                $item->type = 'artikel';
                return $item;
            });

        // Mengambil 6 kegiatan terbaru yang sudah di-publish sebagai "kandidat"
        $kegiatanMasjid = Kegiatan::where('status', 'published')
            ->latest()
            ->get()
            ->map(function($item) {
                $item->type = 'kegiatan';
                return $item;
            });

        // 1. Gabungkan DUA koleksi (total maks. 12 item).
        // 2. Urutkan berdasarkan tanggal pembuatan secara menurun.
        // 3. Ambil 6 item teratas dari hasil gabungan yang sudah terurut.
        $kontenTerbaru = collect()
            ->merge($artikelMasjid->take(3))
            ->merge($kegiatanMasjid->take(3))
            ->sortByDesc('created_at')
            ->values();

        // Artikel populer bulan ini (top 3 berdasarkan views)
        $artikelPopuler = Artikel::where('status', 'published')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->orderByDesc('views')
            ->take(3)
            ->get()
            ->map(function($item) {
                $item->type = 'artikel';
                return $item;
            });

        // Fallback: jika bulan ini belum ada artikel, ambil 3 artikel terpopuler secara keseluruhan
        if ($artikelPopuler->isEmpty()) {
            $artikelPopuler = Artikel::where('status', 'published')
                ->orderByDesc('views')
                ->take(3)
                ->get()
                ->map(function($item) {
                    $item->type = 'artikel';
                    return $item;
                });
        }

        // 3 Artikel terbaru untuk sidebar kanan
        $artikelTerbaru = Artikel::where('status', 'published')
            ->latest()
            ->take(3)
            ->get()
            ->map(function($item) {
                $item->type = 'artikel';
                return $item;
            });

        $jadwalImam = JadwalImam::latest()->get();

        $homeSections = HomeSection::all();

        $visiMisi = VisiMisi::first();

        // =============================================
        // 💰 Finance Overview Data for Homepage Chart
        // =============================================
        $tahunKeuangan = Carbon::now()->year;
        $bulanKeuangan = Carbon::now()->month;

        // Total bulan ini
        $totalPemasukkan = Pemasukkan::whereMonth('tanggal', $bulanKeuangan)
            ->whereYear('tanggal', $tahunKeuangan)
            ->sum('total');

        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulanKeuangan)
            ->whereYear('tanggal', $tahunKeuangan)
            ->sum('total');

        $saldoAkhir = $totalPemasukkan - $totalPengeluaran;

        // Data chart per bulan untuk tahun ini
        $pemasukkanPerMonth = Pemasukkan::selectRaw('MONTH(tanggal) as month, SUM(total) as total')
            ->whereYear('tanggal', $tahunKeuangan)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $pengeluaranPerMonth = Pengeluaran::selectRaw('MONTH(tanggal) as month, SUM(total) as total')
            ->whereYear('tanggal', $tahunKeuangan)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $keuanganLabels = [];
        $keuanganDataPemasukkan = [];
        $keuanganDataPengeluaran = [];
        $keuanganDataSaldo = [];
        $cumulative = 0;

        for ($m = 1; $m <= 12; $m++) {
            $keuanganLabels[] = Carbon::createFromDate($tahunKeuangan, $m, 1)->translatedFormat('M');
            $monthlyP = isset($pemasukkanPerMonth[$m]) ? (float) $pemasukkanPerMonth[$m] : 0;
            $monthlyE = isset($pengeluaranPerMonth[$m]) ? (float) $pengeluaranPerMonth[$m] : 0;
            $keuanganDataPemasukkan[] = $monthlyP;
            $keuanganDataPengeluaran[] = $monthlyE;
            $cumulative += ($monthlyP - $monthlyE);
            $keuanganDataSaldo[] = $cumulative;
        }

        // Top 3 Donatur terbesar berdasarkan nominal
        $topDonatur = Donasi::orderByDesc('nominal')
            ->take(3)
            ->get();

        // Top 3 Donatur bulan ini
        $topDonaturBulanIni = Donasi::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->orderByDesc('nominal')
            ->take(3)
            ->get();

        return view('index', compact(
            'kontenTerbaru', 'jadwalImam', 'homeSections', 'visiMisi', 
            'artikelPopuler', 'artikelTerbaru',
            'totalPemasukkan', 'totalPengeluaran', 'saldoAkhir',
            'keuanganLabels', 'keuanganDataPemasukkan', 'keuanganDataPengeluaran', 'keuanganDataSaldo',
            'tahunKeuangan', 'bulanKeuangan', 'topDonatur', 'topDonaturBulanIni'
        ));
    }
}
