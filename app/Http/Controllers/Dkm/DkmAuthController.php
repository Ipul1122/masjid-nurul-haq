<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dkm;
use Illuminate\Support\Facades\Hash;

class DkmAuthController extends Controller
{
    public function showLogin()
    {
        return view('dkm.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $dkm = Dkm::where('username', $request->username)->first();

        if ($dkm && Hash::check($request->password, $dkm->password)) {
            // Simpan session manual
            $request->session()->put('dkm_id', $dkm->id);
            $request->session()->put('dkm_username', $dkm->username);

            return redirect()->route('dkm.dashboard');
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    public function dashboard()
    {
        if (!session()->has('dkm_id')) {
            return redirect()->route('dkm.login');
        }
        return view('dkm.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['dkm_id', 'dkm_username']);
        return redirect()->route('dkm.login');
    }
}
