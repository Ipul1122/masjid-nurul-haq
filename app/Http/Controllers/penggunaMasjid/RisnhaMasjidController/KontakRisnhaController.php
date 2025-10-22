<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KontakRisnhaController extends Controller
{
    /**
     * Menampilkan halaman statis kontak Risnha.
     */
    public function index()
    {
        // Langsung tampilkan view, karena logikanya ada di JavaScript
        return view('penggunaMasjid.risnhaMasjid.kontakRisnha');
    }
}