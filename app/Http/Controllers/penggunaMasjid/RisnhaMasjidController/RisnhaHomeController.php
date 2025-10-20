<?php

namespace App\Http\Controllers\PenggunaMasjid\RisnhaMasjidController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RisnhaHomeController extends Controller
{
    public function index (){
        return view('penggunaMasjid.risnhaMasjid.index');
    }
}
