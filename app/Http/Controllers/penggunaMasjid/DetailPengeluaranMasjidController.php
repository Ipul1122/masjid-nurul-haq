<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\KategoriPengeluaran;
use App\Models\Notifikasi;
use Carbon\Carbon;

class DetailPengeluaranMasjidController extends Controller
{
    public function index(Request $request)
    {
        $showAll = $request->has('all') && $request->all == 1;

        $tahunList = Pengeluaran::selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        if ($showAll) {
            $pengeluarans = Pengeluaran::with('kategori')
                ->orderBy('tanggal', 'desc')
                ->get();
            $totalpengeluaran = $pengeluarans->sum('total');

            $selectedBulan = null;
            $selectedTahun = null;
        } else {
            $selectedBulan = $request->input('bulan', Carbon::now()->month);
            $selectedTahun = $request->input('tahun', Carbon::now()->year);

            $pengeluarans = Pengeluaran::with('kategori')
                ->whereMonth('tanggal', $selectedBulan)
                ->whereYear('tanggal', $selectedTahun)
                ->orderBy('tanggal', 'desc')
                ->get();

            $totalpengeluaran = $pengeluarans->sum('total');
        }

        return view('penggunaMasjid.keuanganMasjid.detailPengeluaranMasjid', compact(
            'pengeluarans',
            'totalpengeluaran',
            'tahunList',
            'selectedBulan',
            'selectedTahun',
            'showAll'
        ));
    }
}
