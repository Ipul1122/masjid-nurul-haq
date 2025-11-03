<?php

namespace App\Http\Controllers\PenggunaMasjid;

use App\Http\Controllers\Controller;
use App\Models\StrukturDkm; // Pastikan Model di-import
use Illuminate\Http\Request;

class StrukturDkmController extends Controller
{
    /**
     * Menampilkan halaman struktur DKM untuk publik.
     */
    public function index()
    {
        // Ambil semua data struktur DKM, urutkan berdasarkan yang terbaru
        $strukturDkms = StrukturDkm::orderBy('created_at', 'asc')->get();

        // Kirim data ke view
        return view('penggunaMasjid.profile.strukturDkm', compact('strukturDkms'));
    }
}