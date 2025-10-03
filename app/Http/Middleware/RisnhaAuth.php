<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RisnhaAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('risnha_id')) {
            return redirect()->route('risnha.login')->withErrors(['login' => 'Silakan login terlebih dahulu']);
        }

        return $next($request);
    }
}
