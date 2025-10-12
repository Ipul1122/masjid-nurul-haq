<?php

namespace App\Http\Controllers\penggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TampilanHomeSection;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 2. Ambil semua data dari model, urutkan berdasarkan kolom 'order'
        $homeSections = TampilanHomeSection::orderBy('order', 'asc')->get();

        // 3. Kirim data ke view menggunakan 'compact'
        return view('index', compact('homeSections'));
    }
}