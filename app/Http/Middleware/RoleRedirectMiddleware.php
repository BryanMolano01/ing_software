<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return $next($request);
        }
        $rol = auth()->user()->rol->rol;
        

        if($rol==='administrador'){
            return redirect()->route('administrador.dashboard');
        }elseif($rol==='panadero'){
            return redirect()->route('panadero.dashboard');
        }

        return $next($request);
    }
}
