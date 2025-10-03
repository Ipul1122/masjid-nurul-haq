<?php

namespace App\Http\Controllers\Risnha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Risnha;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('risnha.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = Risnha::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['risnha_id' => $user->id]);
            return redirect()->route('risnha.dashboard');
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    public function dashboard()
    {
        if (!session()->has('risnha_id')) {
            return redirect()->route('risnha.login');
        }
        return view('risnha.dashboard');
    }

    public function logout()
    {
        session()->forget('risnha_id');
        return redirect()->route('risnha.login');
    }
}
