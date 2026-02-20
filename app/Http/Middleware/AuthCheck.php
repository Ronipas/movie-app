<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheck
{
    public function handle($request, Closure $next)
    {
        // Cek session 'user'
        if (!$request->session()->has('user')) {
            return redirect('/login')->with('error', 'Silahkan Login terlebih dahulu');
        }

        return $next($request);
    }
}
