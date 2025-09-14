<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyDkmPin
{
    public function handle(Request $request, Closure $next)
    {
        // Jika belum verifikasi PIN, arahkan ke halaman verifikasi
        if (!session('dkm_pin_verified')) {
            return redirect()->route('dkm.verifyPinForm');
        }

        return $next($request);
    }
}
