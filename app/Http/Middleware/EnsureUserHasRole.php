<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!auth()->check()){
            return redirect('login');
        }
        $rolUsuario = auth()->user()->rol->rol;

        if(!in_array($rolUsuario, $roles)){
            abort(403, 'Acceso no autorizado');
        }
        

        return $next($request);
    }
}
