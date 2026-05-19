<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectToCorrectPanel
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user) {
            return $next($request);
        }

        $path = $request->path();

        // Admin trying to access /painel (not login) → redirect to /admin
        if ($user->role === 'admin' && str_starts_with($path, 'painel') && ! str_contains($path, 'login') && ! str_contains($path, 'logout')) {
            return redirect('/admin');
        }

        // Empreendedor trying to access /admin (not login) → redirect to /painel
        if ($user->role === 'empreendedor' && str_starts_with($path, 'admin') && ! str_contains($path, 'login') && ! str_contains($path, 'logout')) {
            return redirect('/painel');
        }

        return $next($request);
    }
}
