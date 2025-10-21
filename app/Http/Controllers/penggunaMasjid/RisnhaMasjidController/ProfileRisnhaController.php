<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use App\Models\VisiMisiRisnha;
use Illuminate\Http\Request;

class ProfileRisnhaController extends Controller
{
    public function index()
    {
        $profile = VisiMisiRisnha::first();
        if (!$profile) {
            // Jika data belum diisi oleh admin, tampilkan pesan default
            $profile = new VisiMisiRisnha([
                'visi' => 'Visi belum diatur.',
                'misi' => 'Misi belum diatur.',
            ]);
        }
        return view('penggunaMasjid.risnhaMasjid.profileRisnha', compact('profile'));
    }
}