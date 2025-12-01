<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureDisplayUser
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login memakai guard default (web)
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Pastikan role = display
        if (Auth::user()->role !== 'display') {
            abort(403, 'Akses hanya untuk Display.');
        }

        return $next($request);
    }
}
