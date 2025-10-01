<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Pemasukkan;
use Illuminate\Http\Request;
use App\Models\KategoriPemasukkan;
use Carbon\Carbon;

class PemasukkanController extends Controller
{
    public function index(Request $request)
    {
        $showAll = $request->has('all') && $request->all == 1;

        // Ambil daftar tahun yang ada
        $tahunList = Pemasukkan::selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Ambil daftar bulan yang ada (group per bulan+tahun agar akurat)
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

        return view('dkm.manajemenKeuangan.pemasukkan.index', compact(
            'pemasukkans',
            'totalPemasukkan',
            'tahunList',
            'bulanList',
            'selectedBulan',
            'selectedTahun',
            'showAll'
        ));
    }


    public function create()
    {
        $kategori = KategoriPemasukkan::all();
        return view('dkm.manajemenKeuangan.pemasukkan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_pemasukkans,id',
        ]);

        $total = preg_replace('/[^0-9]/', '', $request->total);

        Pemasukkan::create([
            'total' => $total,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('dkm.manajemenKeuangan.pemasukkan.index')
            ->with('success', 'Data pemasukkan berhasil ditambahkan.');
    }

    public function edit(Pemasukkan $pemasukkan)
    {
        $kategori = KategoriPemasukkan::all();
        return view('dkm.manajemenKeuangan.pemasukkan.edit', compact('pemasukkan','kategori'));
    }

    public function update(Request $request, Pemasukkan $pemasukkan)
    {
        $request->validate([
            'total' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_pemasukkans,id',
        ]);

        $total = preg_replace('/[^0-9]/', '', $request->total);

        $pemasukkan->update([
            'total' => $total,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('dkm.manajemenKeuangan.pemasukkan.index')
            ->with('success', 'Data pemasukkan berhasil diperbarui.');
    }

    public function destroy(Pemasukkan $pemasukkan)
    {
        $pemasukkan->delete();

        return redirect()->route('dkm.manajemenKeuangan.pemasukkan.index')
            ->with('success', 'Data pemasukkan berhasil dihapus.');
    }

    // Bulk delete (hapus beberapa sekaligus)
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids ? explode(',', $request->ids) : [];
        if (!empty($ids)) {
            Pemasukkan::whereIn('id', $ids)->delete();
        }

        return redirect()->route('dkm.manajemenKeuangan.pemasukkan.index')
            ->with('success', 'Data terpilih berhasil dihapus.');
    }
}
