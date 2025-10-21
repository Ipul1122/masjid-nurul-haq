<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiDanMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::first();
        $dataExists = $visiMisi ? true : false;

        return view('penggunaMasjid.profile.visiMisiMasjid', compact('visiMisi', 'dataExists'));
    }
}