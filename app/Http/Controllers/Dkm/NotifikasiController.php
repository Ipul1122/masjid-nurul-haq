<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::with('dkm')->latest()->get();
        return view('dkm.notifikasi.index', compact('notifikasis'));
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

    public function autoDeleteOld()
    {
        $deleted = Notifikasi::where('created_at', '<', now()->subMinutes(5))->delete();

        return response()->json([
            'status' => 'success',
            'deleted' => $deleted
        ]);
    }

}
