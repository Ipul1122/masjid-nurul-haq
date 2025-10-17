<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KontakMasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Langsung menampilkan view statis, tidak ada data dari database
        return view('penggunaMasjid.kontakMasjid.index');
    }
}