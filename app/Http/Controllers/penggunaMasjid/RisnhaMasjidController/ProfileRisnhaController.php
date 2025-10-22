<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasiRisnha; // Tambahkan ini
use App\Models\VisiMisiRisnha;
use Illuminate\Http\Request;

class ProfileRisnhaController extends Controller
{
    public function index()
    {
        $profile = VisiMisiRisnha::first();
        if (!$profile) {
            $profile = new VisiMisiRisnha(['visi' => 'Visi belum diatur.', 'misi' => 'Misi belum diatur.']);
        }

        // UBAH INI: Ambil semua data organisasi
        $organisasis = StrukturOrganisasiRisnha::all(); 

        return view('penggunaMasjid.risnhaMasjid.profileRisnha', compact('profile', 'organisasis')); // Kirim 'organisasis' (plural)
    }
}