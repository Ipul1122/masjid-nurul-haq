<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        return view('dkm.notifikasi.index');
    }
}
