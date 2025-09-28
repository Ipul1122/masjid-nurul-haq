<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Ambil notifikasi yang belum expired (5 menit)
        $notifikasis = Notifikasi::with('dkm')
            ->where('created_at', '>=', now()->subMinutes(5))
            ->latest()
            ->get();

        $notifCount = $notifikasis->count();

        return view('dkm.notifikasi.index', compact('notifikasis', 'notifCount'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            Notifikasi::whereIn('id', $ids)->delete();
            return redirect()->route('dkm.notifikasi.index')->with('success', 'Notifikasi terpilih berhasil dihapus.');
        }

        return redirect()->route('dkm.notifikasi.index')->with('error', 'Tidak ada notifikasi yang dipilih.');
    }

    /**
     * Hapus notifikasi yang lebih tua dari 5 menit.
     * KEMBALIKAN array deleted_ids dan count saat ini agar client bisa sinkron DOM & badge.
     */
    public function autoDeleteOld()
    {
        // IDs yang akan dihapus
        $toDelete = Notifikasi::where('created_at', '<', now()->subMinutes(5))->pluck('id')->toArray();

        $deleted = 0;
        if (!empty($toDelete)) {
            $deleted = Notifikasi::whereIn('id', $toDelete)->delete();
        }

        // hitung notifikasi yang masih valid
        $count = Notifikasi::where('created_at', '>=', now()->subMinutes(5))->count();

        return response()->json([
            'status' => 'success',
            'deleted' => $deleted,
            'deleted_ids' => $toDelete,
            'count' => $count,
        ]);
    }

    /**
     * Kembalikan jumlah notifikasi yang belum expired (untuk badge)
     */
    public function count()
    {
        $count = Notifikasi::where('created_at', '>=', now()->subMinutes(5))->count();

        return response()->json([
            'count' => $count,
        ]);
    }
}
