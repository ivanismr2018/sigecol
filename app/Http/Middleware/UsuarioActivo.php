<?php

namespace App\Http\Middleware;

use Closure,Auth;
use Illuminate\Http\Request;

class UsuarioActivo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $estado = (is_null(Auth::user()->estado)) ? 0 : Auth::user()->estado ;
        if ($estado==0) {
            Auth::logout();
            return redirect(route('login'))
                    ->with('mensaje', 'Usuario Bloqueado')
                    ->with('icono', 'error');
        }else{
            return $next($request);
        }
    }
}
