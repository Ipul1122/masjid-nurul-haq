<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\KategoriPengeluaran;
use App\Models\Notifikasi;
use Carbon\Carbon;

class PengeluaranController extends Controller
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

        $pengeluaran = Pengeluaran::create([
            'total' => $total,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
        ]);

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'create',
            'tabel' => 'pengeluaran',
            'keterangan' => "Menambahkan pengeluaran sebesar Rp " . number_format($total, 0, ',', '.') . " pada tanggal " . $request->tanggal,
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

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'update',
            'tabel' => 'pengeluaran',
            'keterangan' => "Memperbarui pengeluaran ID {$pengeluaran->id} menjadi Rp " . number_format($total, 0, ',', '.') . " pada tanggal " . $request->tanggal,
        ]);

        return redirect()->route('dkm.manajemenKeuangan.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $nominal = $pengeluaran->total;
        $tanggal = $pengeluaran->tanggal;
        $id = $pengeluaran->id;

        $pengeluaran->delete();

        // Catat notifikasi
        Notifikasi::create([
            'dkm_id' => session('dkm_id'),
            'aksi' => 'delete',
            'tabel' => 'pengeluaran',
            'keterangan' => "Menghapus pengeluaran ID {$id} sebesar Rp " . number_format($nominal, 0, ',', '.') . " pada tanggal {$tanggal}",
        ]);

        return redirect()->route('dkm.manajemenKeuangan.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids ? explode(',', $request->ids) : [];
        if (!empty($ids)) {
            $pengeluarans = Pengeluaran::whereIn('id', $ids)->get();

            foreach ($pengeluarans as $p) {
                Notifikasi::create([
                    'dkm_id' => session('dkm_id'),
                    'aksi' => 'delete',
                    'tabel' => 'pengeluaran',
                    'keterangan' => "Menghapus pengeluaran ID {$p->id} sebesar Rp " . number_format($p->total, 0, ',', '.') . " pada tanggal {$p->tanggal}",
                ]);
            }

            Pengeluaran::whereIn('id', $ids)->delete();
        }

        return redirect()->route('dkm.manajemenKeuangan.pengeluaran.index')
            ->with('success', 'Data terpilih berhasil dihapus.');
    }
}
