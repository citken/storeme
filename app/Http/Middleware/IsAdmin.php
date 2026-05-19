<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah user sudah login dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        abort(403, 'Akses Ditolak. Area khusus Admin K-Host.');
    }
}