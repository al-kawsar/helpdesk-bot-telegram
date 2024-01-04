<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && auth()->user()->password_changed) {
            return $next($request);
        } elseif (Auth::check() && !auth()->user()->password_changed) {
            return redirect("/admin/profile")->with(
                [
                    'warning_message'=> 'Anda Wajib Mengganti Password!',
                    'title' => 'Peringatan',
                    'password' => 'anda wajib mengganti password!',
                    'in-valid' => true
                ]);
        }
        return redirect()->route('login')->with('failed_message', 'Silakan login terlebih dahulu!');
    }
}
