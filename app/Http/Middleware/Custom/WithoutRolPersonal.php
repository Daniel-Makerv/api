<?php

namespace App\Http\Middleware\Custom;

use Closure;
use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;

class WithoutRolPersonal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles_personal_no_permitidos = '')
    {
        $auth = auth()->user();
        if (in_array($auth->rol_personal->id, explode('|', $roles_personal_no_permitidos))) {
            return ApiHelpers::msgAuthorizationError();
        }
        return $next($request);
    }
}
