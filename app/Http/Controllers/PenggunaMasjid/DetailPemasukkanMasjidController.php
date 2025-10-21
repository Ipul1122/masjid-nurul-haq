<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\Pemasukkan;
use Illuminate\Http\Request;
use App\Models\KategoriPemasukkan;
// use App\Models\Notifikasi;
use Carbon\Carbon;

class DetailPemasukkanMasjidController extends Controller
{
    public function index(Request $request)
    {
        $showAll = $request->has('all') && $request->all == 1;

        $tahunList = Pemasukkan::selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $bulanList = Pemasukkan::selectRaw('MONTH(tanggal) as bulan, YEAR(tanggal) as tahun')
            ->distinct()
            ->get();

        if ($showAll) {
            $pemasukkans = Pemasukkan::with('kategori')
                ->orderBy('tanggal', 'desc')
                ->get();
            $totalPemasukkan = $pemasukkans->sum('total');

            $selectedBulan = null;
            $selectedTahun = null;
        } else {
            $selectedBulan = $request->input('bulan', Carbon::now()->month);
            $selectedTahun = $request->input('tahun', Carbon::now()->year);

            $pemasukkans = Pemasukkan::with('kategori')
                ->whereMonth('tanggal', $selectedBulan)
                ->whereYear('tanggal', $selectedTahun)
                ->orderBy('tanggal', 'desc')
                ->get();

            $totalPemasukkan = $pemasukkans->sum('total');
        }

        return view('penggunaMasjid.keuanganMasjid.detailPemasukkanMasjid', compact(
            'pemasukkans',
            'totalPemasukkan',
            'tahunList',
            'bulanList',
            'selectedBulan',
            'selectedTahun',
            'showAll'
        ));
    }
}
