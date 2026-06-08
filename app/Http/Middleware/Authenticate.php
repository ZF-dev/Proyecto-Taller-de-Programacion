<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware //aqui sobreescribimos el metodo redirectTo para que redirija a la ruta de login cuando el usuario no esta autenticado
{
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : '/IniciarSesion';
    }
}
