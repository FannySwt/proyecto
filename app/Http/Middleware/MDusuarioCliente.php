<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class MDusuarioCliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {    
            $user = Auth::User();
            if($user->tipo_usuario == 'cliente')
                return $next($request);
            else if ($user->tipo_usuario == 'admin')
                return redirect('/admin');
            else if ($user->tipo_usuario == 'secretaria')
                return redirect('/secretaria');
        }
        return redirect('/');
    }
}
