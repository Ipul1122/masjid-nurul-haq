<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class ManajemenKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();

        $inputBulan = $request->input('bulan');
        $inputTahun = $request->input('tahun');


        $bulanUntukQuery = $request->has('bulan') ? $inputBulan : $now->month;
        $tahunUntukQuery = $request->has('tahun') ? $inputTahun : $now->year;
        
        $selectedBulan = !empty($inputBulan) ? $inputBulan : $now->month;
        $selectedTahun = !empty($inputTahun) ? $inputTahun : $now->year;

        $queryPemasukkan = Pemasukkan::query();
        if ($bulanUntukQuery) {
            $queryPemasukkan->whereMonth('tanggal', $bulanUntukQuery);
        }
        if ($tahunUntukQuery) {
            $queryPemasukkan->whereYear('tanggal', $tahunUntukQuery);
        }
        $totalPemasukkan = $queryPemasukkan->sum('total');

        $queryPengeluaran = Pengeluaran::query();
        if ($bulanUntukQuery) {
            $queryPengeluaran->whereMonth('tanggal', $bulanUntukQuery);
        }
        if ($tahunUntukQuery) {
            $queryPengeluaran->whereYear('tanggal', $tahunUntukQuery);
        }
        $totalPengeluaran = $queryPengeluaran->sum('total');

        $saldoAkhir = $totalPemasukkan - $totalPengeluaran;

        $tahunPemasukkan = Pemasukkan::selectRaw('YEAR(tanggal) as tahun')->distinct()->pluck('tahun');
        $tahunPengeluaran = Pengeluaran::selectRaw('YEAR(tanggal) as tahun')->distinct()->pluck('tahun');
        $tahunList = $tahunPemasukkan->merge($tahunPengeluaran)->unique()->sortDesc();

        return view('dkm.manajemenKeuangan.index', [
            'totalPemasukkan' => $totalPemasukkan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldoAkhir' => $saldoAkhir,
            'selectedBulan' => $selectedBulan, 
            'selectedTahun' => $selectedTahun, 
            'inputBulan' => $inputBulan, 
            'tahunList' => $tahunList,
            'tampilkanNamaBulan' => !empty($bulanUntukQuery) 
        ]);
    }
}