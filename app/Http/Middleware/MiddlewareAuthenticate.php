<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MiddlewareAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            // Si el usuario no está logueado, redirige a la ruta raíz y muestra el modal de inicio de sesión
            return redirect('/')
                ->with('openModal', 'login-modal');
        }

        return $next($request);
    }
}
