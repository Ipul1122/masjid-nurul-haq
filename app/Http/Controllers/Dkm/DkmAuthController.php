<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use App\Models\Dkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DkmAuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('dkm.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = Dkm::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // ✅ simpan user ke session
            session([
                'dkm_id' => $user->id,
                'dkm_username' => $user->username,
            ]);

            return redirect()->route('dkm.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah']);
    }

    /**
     * Halaman dashboard
     */
    public function dashboard()
    {
        if (!session()->has('dkm_id')) {
            return redirect()->route('dkm.login')
                ->withErrors(['login' => 'Silakan login terlebih dahulu']);
        }

        return view('dkm.dashboard');
    }

    /**
     * Proses logout
     */
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
