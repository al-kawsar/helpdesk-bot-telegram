<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckFirstTimeLogin
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna telah diotentikasi
        if (Auth::check()) {
            // Periksa nilai kolom password_change
            $user = Auth::user();
            if (!$user->password_change) {
                // Redirect ke halaman ganti kata sandi jika password_change bernilai true
                $url = '/admin/'. $user->email;
                return redirect()->intended($url);
            }
        }

        return $next($request);
    }
}