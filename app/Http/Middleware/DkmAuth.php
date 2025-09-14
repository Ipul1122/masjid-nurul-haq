<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DkmAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('dkm_id')) {
            return redirect()->route('dkm.login')->withErrors(['login' => 'Silakan login terlebih dahulu']);
        }

        return $next($request);
    }
}
