<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        return view('dkm.kategori.index');
    }
}
