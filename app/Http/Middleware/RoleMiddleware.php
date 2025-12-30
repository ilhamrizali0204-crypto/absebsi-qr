<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Kalau belum login, lempar ke login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Kalau role user tidak termasuk di daftar yg diizinkan
        if (!in_array($user->role, $roles)) {
            // Bisa redirect ke halaman sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }

            if ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }

            // fallback
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
