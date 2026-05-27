<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
             // Redirigir al inicio con un mensaje de error o lanzar un error 403 (No autorizado)
             abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
