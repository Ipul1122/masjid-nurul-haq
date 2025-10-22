<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\Sejarah; // Pastikan model Sejarah di-import
use Illuminate\Http\Request;

class SejarahMasjidController extends Controller
{

    public function index()
    {
        $sejarahs = Sejarah::all()->sortByDesc(function ($sejarah) {
            // Regex ini akan mengekstrak angka 4 digit pertama (tahun) dari judul
            preg_match('/(\d{4})/', $sejarah->judul, $matches);
            
          
            return (int) ($matches[1] ?? 0);
        });
        
        return view('penggunaMasjid.profile.sejarahMasjid', compact('sejarahs'));
    }
}