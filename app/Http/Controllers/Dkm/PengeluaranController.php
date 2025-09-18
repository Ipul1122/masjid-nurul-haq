<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\KategoriPengeluaran;
use Carbon\Carbon;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        // Jika user minta tampil semua ?all=1
        $showAll = $request->has('all') && $request->all == 1;

        // Ambil daftar tahun yang ada di DB (dipakai di dropdown)
        $tahunList = Pengeluaran::selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        if ($showAll) {
            // Tampilkan semua data
            $pengeluarans = Pengeluaran::with('kategori')
                ->orderBy('tanggal', 'desc')
                ->get();
            $totalpengeluaran = $pengeluarans->sum('total');

            $selectedBulan = null;
            $selectedTahun = null;
        } else {
            // Default: gunakan bulan & tahun sekarang jika user tidak memilih
            $selectedBulan = $request->input('bulan', Carbon::now()->month);
            $selectedTahun = $request->input('tahun', Carbon::now()->year);

            // Filter berdasarkan bulan & tahun terpilih (default = bulan & tahun sekarang)
            $pengeluarans = Pengeluaran::with('kategori')
                ->whereMonth('tanggal', $selectedBulan)
                ->whereYear('tanggal', $selectedTahun)
                ->orderBy('tanggal', 'desc')
                ->get();

            $totalpengeluaran = $pengeluarans->sum('total');
        }

        return view('dkm.manajemenKeuangan.pengeluaran.index', compact(
            'pengeluarans',
            'totalpengeluaran',
            'tahunList',
            'selectedBulan',
            'selectedTahun',
            'showAll'
        ));
    }

    public function create()
    {
        $kategori = KategoriPengeluaran::all();
        return view('dkm.manajemenKeuangan.pengeluaran.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_pengeluarans,id',
        ]);

        $total = preg_replace('/[^0-9]/', '', $request->total);

        Pengeluaran::create([
            'total' => $total,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('dkm.manajemenKeuangan.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        $kategori = KategoriPengeluaran::all();
        return view('dkm.manajemenKeuangan.pengeluaran.edit', compact('pengeluaran','kategori'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'total' => 'required|string',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori_pengeluarans,id',
        ]);

        $total = preg_replace('/[^0-9]/', '', $request->total);

        $pengeluaran->update([
            'total' => $total,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('dkm.manajemenKeuangan.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()->route('dkm.manajemenKeuangan.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil dihapus.');
    }

    // Bulk delete (hapus beberapa sekaligus)
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids ? explode(',', $request->ids) : [];
        if (!empty($ids)) {
            Pengeluaran::whereIn('id', $ids)->delete();
        }

        return redirect()->route('dkm.manajemenKeuangan.pengeluaran.index')
            ->with('success', 'Data terpilih berhasil dihapus.');
    }
}
