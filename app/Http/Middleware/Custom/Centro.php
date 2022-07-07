<?php

namespace App\Http\Middleware\Custom;

use Closure;
use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;

class Centro
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

        switch ($auth->id_rol_sistema) {
            case 2: #Empresa
                return $next($request);
                break;
            case 3: #Centro
                if (!$auth->centro->id) {
                    auth()->logout();
                    return ApiHelpers::msgAuthorizationError('Actualmente no tienes un centro asignado');
                }

                return $next($request);
                break;
        }

        return ApiHelpers::msgAuthorizationError();
    }
}
