<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutOnPanelSwitch
{
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        $user = $request->user();

        // Always clear intended URL on login pages to prevent cross-panel redirects
        // e.g. user visits /painel (stores intended=/painel), then goes to /admin/login
        // without this, after login Filament would redirect to /painel instead of /admin
        if ($path === 'admin/login' || $path === 'painel/login') {
            $request->session()->forget('url.intended');
        }

        if (! $user) {
            return $next($request);
        }

        // Admin accessing /painel → log out so they can log in as empreendedor
        if ($user->role === 'admin' && str_starts_with($path, 'painel')) {
            Auth::logout();
        }

        // Empreendedor accessing /admin → log out so they can log in as admin
        if ($user->role === 'empreendedor' && str_starts_with($path, 'admin')) {
            Auth::logout();
        }

        return $next($request);
    }
}
