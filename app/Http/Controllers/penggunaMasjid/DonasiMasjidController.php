<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonasiMasjidController extends Controller
{
    public function index()
    {
        return view('penggunaMasjid.donasi.index    ');
    }
}