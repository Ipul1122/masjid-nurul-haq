<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class NotifikasiController extends Controller
{
    public function index()
    {
         // Ambil semua log terbaru (bisa difilter sesuai kebutuhan)
        $activities = Activity::latest()->take(50)->get();

        return view('dkm.notifikasi.index', compact('activities'));
    }
}
