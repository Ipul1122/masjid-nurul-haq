<?php


namespace App\Http\Controllers\penggunaMasjid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TampilanPenggunaMasjid\HomeSection;

class homeController extends Controller
{
    public function index()
    {
        $homeSections = HomeSection::all();
        return view('index', compact('homeSections'));
    }
}