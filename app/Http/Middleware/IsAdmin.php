<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !in_array($request->user()->role, ['admin', 'staff'])) {
            abort(403, 'Akses ditolak. Fitur ini hanya untuk Admin atau Staff.');
        }

        return $next($request);
    }
}
