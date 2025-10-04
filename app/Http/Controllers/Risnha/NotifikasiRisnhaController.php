<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\NotifikasiRisnha;
use Illuminate\Http\Request;

class NotifikasiRisnhaController extends Controller
{
    public function index()
    {
        // Ambil semua notifikasi 5 menit terakhir
        if (session()->has('dkm_id') || session()->get('is_admin') === true) {
            $notifikasi = NotifikasiRisnha::with('risnha')
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif (session()->has('risnha_id')) {
            $notifikasi = NotifikasiRisnha::with('risnha')
                ->where('risnha_id', session('risnha_id'))
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $notifikasi = collect();
        }

        $notifCount = $notifikasi->count();
        return view('risnha.notifikasiRisnha.index', compact('notifikasi', 'notifCount'));
    }

    public function destroySelected(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            NotifikasiRisnha::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Notifikasi terpilih berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Tidak ada notifikasi yang dipilih.');
    }

    public function destroyAll()
    {
        NotifikasiRisnha::truncate();
        return redirect()->back()->with('success', 'Semua notifikasi berhasil dihapus.');
    }

    // 🔹 Auto delete notifikasi >5 menit dari DB & kembalikan data untuk sinkron view
    public function autoDeleteOld()
    {
        $now = now();
        $expired = NotifikasiRisnha::where('created_at', '<', $now->subMinutes(5))->pluck('id')->toArray();

        if (!empty($expired)) {
            NotifikasiRisnha::whereIn('id', $expired)->delete();
        }

        // Ambil notifikasi valid
        $notifikasi = NotifikasiRisnha::with('risnha')
            ->orderBy('created_at', 'desc')
            ->get();

        $count = $notifikasi->count();

        return response()->json([
            'status' => 'success',
            'deleted_ids' => $expired,
            'notifikasi' => $notifikasi,
            'count' => $count,
        ]);
    }

    public function count()
    {
        $count = NotifikasiRisnha::where('created_at', '>=', now()->subMinutes(5))->count();
        return response()->json(['count' => $count]);
    }
}
