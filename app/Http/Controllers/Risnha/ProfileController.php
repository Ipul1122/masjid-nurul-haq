<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use App\Models\VisiMisiRisnha;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil data Visi Misi, jika tidak ada, buat objek baru
        $profile = VisiMisiRisnha::firstOrNew([]);
        return view('risnha.profile.index', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        // Gunakan updateOrCreate untuk membuat atau update baris pertama
        VisiMisiRisnha::updateOrCreate(
            ['id' => 1], // Selalu targetkan baris pertama
            [
                'visi' => $request->visi,
                'misi' => $request->misi,
            ]
        );

        return back()->with('success', 'Visi & Misi berhasil diperbarui.');
    }
}