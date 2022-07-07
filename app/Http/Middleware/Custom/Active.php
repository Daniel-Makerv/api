<?php

namespace App\Http\Middleware\Custom;

use App\Helpers\ApiHelpers;
use Closure;
use Illuminate\Http\Request;

class Active
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
        if (!ApiHelpers::checkUserStatus($auth)) {
            auth()->logout();
            return ApiHelpers::msgAuthorizationError('Ahora mismo no es posible acceder con esta cuenta');
        }
        return $next($request);
    }
}
