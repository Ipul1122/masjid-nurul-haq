<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Dkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DkmAuthController extends Controller
{
    // 👉 ini method yang hilang
    public function showLoginForm()
    {
        return view('dkm.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = Dkm::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['dkm_id' => $user->id, 'dkm_username' => $user->username]);
            return redirect()->route('dkm.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah']);
    }

    public function dashboard()
    {
        if (!session('dkm_id')) {
            return redirect()->route('dkm.login');
        }
        return view('dkm.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
        'dkm_id',
        'dkm_username',
        'dkm_pin_verified', 
    ]);

        return redirect()->route('dkm.login');
    }
}
