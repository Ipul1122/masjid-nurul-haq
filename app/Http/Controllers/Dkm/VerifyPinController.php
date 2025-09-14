<?php

namespace App\Http\Controllers\Dkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyPinController extends Controller
{
    public function showVerifyForm()
    {
        return view('auth.verify-pin');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'pin' => 'required|digits:6',
        ]);

        // default PIN
        $defaultPin = '123456';

        if ($request->pin === $defaultPin) {
            session(['dkm_pin_verified' => true]);
            return redirect()->route('dkm.managePengguna.index');
        }

        return back()->withErrors(['pin' => 'Kode PIN salah!']);
    }
}
