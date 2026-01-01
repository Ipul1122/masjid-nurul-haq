<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\LaporanMuhasabahAnggota;
use App\Models\MuhasabahGroup;
use App\Models\MuhasabahAnggota;
use Illuminate\Http\Request;

class LaporanMuhasabahController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Data Filter
        $groups = MuhasabahGroup::all();
        
        $anggotas = $request->group_id 
                    ? MuhasabahAnggota::where('group_id', $request->group_id)->get() 
                    : MuhasabahAnggota::all();

        // 2. Query Utama
        $query = LaporanMuhasabahAnggota::select('tanggal', 'anggota_id')
                    ->distinct()
                    ->with(['anggota.group']);

        // --- FILTERING ---
        if ($request->filled('group_id')) {
            $query->whereHas('anggota', function($q) use ($request) {
                $q->where('group_id', $request->group_id);
            });
        }

        if ($request->filled('anggota_id')) {
            $query->where('anggota_id', $request->anggota_id);
        }

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_akhir]);
        }

        // 3. Eksekusi Pagination (SET KE 10)
        // withQueryString() penting agar saat pindah halaman, filter tidak hilang
        $laporans = $query->orderBy('tanggal', 'desc')
                          ->orderBy('anggota_id', 'asc')
                          ->paginate(2) 
                          ->withQueryString();

        // 4. Ambil Detail Jawaban
        foreach ($laporans as $laporan) {
            $laporan->detail_jawaban = LaporanMuhasabahAnggota::with('soal')
                ->where('tanggal', $laporan->tanggal)
                ->where('anggota_id', $laporan->anggota_id)
                ->get();
        }

        return view('dkm.muhasabah.laporanMuhasabah.index', compact('laporans', 'groups', 'anggotas'));
    }
}