<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user tidak login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Cek jika user bukan super_admin
        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses sebagai super admin.');
        }

        return $next($request);
    }
}