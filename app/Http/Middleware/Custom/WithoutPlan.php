<?php

namespace App\Http\Middleware\Custom;

use Closure;
use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;

class WithoutPlan
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
        if ($auth->empresa->plan_vigente != null) {
            return ApiHelpers::msgAuthorizationError();
        }   
        return $next($request);
    }
}
