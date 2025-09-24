<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::with('dkm')->latest()->get();
        return view('dkm.notifikasi.index', compact('notifikasis'));
    }
}
