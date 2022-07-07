<?php

namespace App\Http\Middleware\Custom;

use App\Helpers\ApiHelpers;
use Closure;
use Illuminate\Http\Request;

class Empresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = auth()->user();

        #Root
        if ($auth->id_rol_sistema == 1) {
            return $next($request);
        }

        if (!auth()->user()->empresa) {
            return ApiHelpers::msgAuthorizationError();
        }

        #Empresa
        if ($auth->id_rol_sistema == 2) {
            return $next($request);
        }

        return ApiHelpers::msgAuthorizationError();
    }
}
