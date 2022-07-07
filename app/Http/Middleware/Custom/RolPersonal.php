<?php

namespace App\Http\Middleware\Custom;

use App\Helpers\ApiHelpers;
use Closure;
use Illuminate\Http\Request;

class RolPersonal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles_personal_permitidos = '')
    {
        $auth = auth()->user();
        if(!in_array($auth->rol_personal->id, explode('|', $roles_personal_permitidos))){
            return ApiHelpers::msgAuthorizationError();
        }
        return $next($request);
    }
}
