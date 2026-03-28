<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIps = env('GUEST_BOOK_ALLOWED_IPS');

        if (!$allowedIps) {
            return $next($request);
        }

        $allowedIpsArray = array_map('trim', explode(',', $allowedIps));

        if (!in_array($request->ip(), $allowedIpsArray)) {
            abort(403, 'Akses ditolak: IP Anda (' . $request->ip() . ') tidak terdaftar.');
        }

        return $next($request);
    }
}
