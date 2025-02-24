<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = auth()->user();

        // 1. Pastikan user sudah login (fallback jika middleware auth gagal)
        if (!$user) {
            return redirect()->route('auth')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Periksa role dengan case-insensitive
        $userRole = strtolower($user->role);
        $requiredRole = strtolower($role);

        // 3. Batasi admin hanya bisa mengakses halaman admin
        if ($userRole === 'admin' && $requiredRole !== 'admin') {
            return redirect()->route('admin')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // 4. Batasi user hanya bisa mengakses halaman sesuai rolenya
        if ($userRole !== 'admin' && $userRole !== $requiredRole) {
            return redirect()->route($userRole)->with(
                'error', 
                "Akses ditolak. Role Anda adalah: " . ucfirst($userRole)
            );
        }

        return $next($request);
    }
}
