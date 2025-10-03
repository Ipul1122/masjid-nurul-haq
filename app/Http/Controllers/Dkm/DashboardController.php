<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Artikel;
use App\Models\JadwalImam;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // statistik umum
        $jumlahKegiatan = Kegiatan::count();
        $jumlahArtikel  = Artikel::count();
        $jumlahJadwalImam = JadwalImam::count();

        // current month & year (fallback)
        $currentMonth = Carbon::now()->month;
        $currentYear  = Carbon::now()->year;

        // ambil filter dari query string jika ada (GET bulan & tahun)
        $bulan = (int) request()->get('bulan', $currentMonth);
        $tahun = (int) request()->get('tahun', $currentYear);

        // totals untuk kartu berdasarkan bulan & tahun yang dipilih
        $totalPemasukkan = Pemasukkan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total');

        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total');

        $saldoAkhir = $totalPemasukkan - $totalPengeluaran;

        /**
         * Siapkan data chart untuk seluruh bulan di tahun $tahun
         * Optimasi: ambil totals per month sekali untuk masing-masing model.
         */
        $pemasukkanPerMonth = Pemasukkan::selectRaw('MONTH(tanggal) as month, SUM(total) as total')
            ->whereYear('tanggal', $tahun)
            ->groupBy('month')
            ->pluck('total', 'month') // -> [month => total, ...]
            ->toArray();

        $pengeluaranPerMonth = Pengeluaran::selectRaw('MONTH(tanggal) as month, SUM(total) as total')
            ->whereYear('tanggal', $tahun)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $labels = [];
        $dataPemasukkan = [];
        $dataPengeluaran = [];
        $dataSaldo = [];

        // kita hitung saldo kumulatif year-to-date (saldo akhir tiap bulan)
        $cumulative = 0;

        for ($m = 1; $m <= 12; $m++) {
            // label bulan (terjemahan sesuai locale Carbon)
            $labels[] = Carbon::createFromDate($tahun, $m, 1)->translatedFormat('F');

            $monthlyPemasukkan = isset($pemasukkanPerMonth[$m]) ? (float) $pemasukkanPerMonth[$m] : 0;
            $monthlyPengeluaran = isset($pengeluaranPerMonth[$m]) ? (float) $pengeluaranPerMonth[$m] : 0;

            $dataPemasukkan[] = $monthlyPemasukkan;
            $dataPengeluaran[] = $monthlyPengeluaran;

            // saldo kumulatif sampai bulan ini
            $cumulative += ($monthlyPemasukkan - $monthlyPengeluaran);
            $dataSaldo[] = $cumulative;
        }

        return view('dkm.dashboard', compact(
            'jumlahKegiatan',
            'jumlahArtikel',
            'jumlahJadwalImam',
            'totalPemasukkan',
            'totalPengeluaran',
            'saldoAkhir',
            'bulan',
            'tahun',
            'labels',
            'dataPemasukkan',
            'dataPengeluaran',
            'dataSaldo'
        ));
    }
}
