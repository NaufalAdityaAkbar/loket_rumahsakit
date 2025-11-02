<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect()->route('petugas.login');
        }

        $user = Auth::user();
        
        if ($role === 'petugas' && !$user->isPetugas()) {
            return redirect()->route('queue.patient')
                ->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}