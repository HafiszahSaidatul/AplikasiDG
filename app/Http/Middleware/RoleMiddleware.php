<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {

        // Memeriksa apakah pengguna sedang autentikasi
        if (Auth::check()) {
            // Mendapatkan role dari pengguna yang sedang login
            $userRole = Auth::user()->role; // Anda harus menyesuaikan ini dengan nama field role di model User
            // Memeriksa apakah role pengguna termasuk dalam roles yang diizinkan
            if (in_array($userRole, $roles)) {
                return $next($request); // Lanjutkan ke route jika role sesuai
            }
        }

        // Jika role pengguna tidak sesuai, Anda dapat mengarahkan atau memberikan respons yang sesuai
        return abort(403, 'Unauthorized'); // Misalnya, kembalikan response 403 Forbidden
    }
}
