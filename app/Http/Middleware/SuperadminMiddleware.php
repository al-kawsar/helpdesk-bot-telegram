<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperadminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role_id === "1") {
            return $next($request);
        }
        // Jika bukan superadmin, Anda bisa mengarahkan pengguna atau melakukan tindakan lainnya
    return redirect()->back()->with('warning_message','Anda tidak punya akses');
    }
}
