<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek jika user tidak terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek role user
        $user = Auth::user();
        
        if ($user->role != $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}