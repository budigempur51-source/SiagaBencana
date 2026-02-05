<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login DAN role-nya adalah admin
        // Karena sudah dicasting di Model, $request->user()->role adalah instance Enum
        if ($request->user() && $request->user()->role !== UserRole::ADMIN) {
            // Jika bukan admin, tendang ke halaman home
            return redirect('/');
        }

        // Jika dia admin, izinkan akses
        return $next($request);
    }
}