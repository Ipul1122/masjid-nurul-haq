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
        $jumlahKegiatan = Kegiatan::count();
        $jumlahArtikel  = Artikel::count();
        $jumlahJadwalImam = JadwalImam::count();
        

        // ambil bulan & tahun saat ini
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        // hitung total bulan ini
        $totalPemasukkan = Pemasukkan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total');

        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('total');

        $saldoAkhir = $totalPemasukkan - $totalPengeluaran;

        return view('dkm.dashboard', compact(
            'jumlahKegiatan',
            'jumlahArtikel',
            'jumlahJadwalImam',
            'totalPemasukkan',
            'totalPengeluaran',
            'saldoAkhir',
            'bulan',
            'tahun'
        ));
    }
}
