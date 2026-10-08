<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Izinkan jika user adalah 'admin' atau 'staff'
        if (!$request->user() || !in_array($request->user()->role, ['admin', 'staff'])) {
            return response()->json([
                'message' => 'Akses ditolak. Fitur ini hanya untuk Admin atau Staff.'
            ], 403); // 403 Forbidden
        }

        return $next($request);
    }
}