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
<<<<<<< HEAD
        if (auth()->user()->role === $role) {
            return $next($request);
        }
        $url = "/" . auth()->user()->role;
        return redirect($url)->with('error', "Anda tidak dapat mengakses halaman ini, karena role anda adalah " . auth()->user()->role);
=======
        $user = auth()->user();

        // 1. Pastikan user sudah login (fallback jika middleware auth gagal)
        if (!$user) {
            return redirect()->route('auth')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Periksa role dengan case-insensitive
        $userRole = strtolower($user->role);
        $requiredRole = strtolower($role);

        if ($userRole === $requiredRole) {
            return $next($request);
        }

        // 3. Redirect ke route sesuai role (jika ada)
        $routeName = $userRole; // Misal: role 'user' mengarah ke route('user')

        if (Route::has($routeName)) {
            return redirect()->route($routeName)->with(
                'error', 
                "Akses ditolak. Role Anda adalah: " . ucfirst($userRole)
            );
        }

        // 4. Fallback ke halaman landing page jika route tidak ditemukan
        return redirect('/')->with('error', 'Akses tidak valid untuk role Anda.');
>>>>>>> profile
    }
}