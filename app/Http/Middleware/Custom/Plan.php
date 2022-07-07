<?php

namespace App\Http\Middleware\Custom;

use Closure;
use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;

class Plan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $id_plan_requerido = 0)
    {
        $auth = auth()->user();
        switch ($auth->id_rol_sistema) {
            case 1: #Root
                return $next($request);
                break;

            default:
                if ($auth->empresa->plan_vigente == null) {
                    return ApiHelpers::msgPlanError();
                }

                if ($id_plan_requerido != 0 and $auth->empresa->plan_vigente->id != $id_plan_requerido) {
                    return ApiHelpers::msgPlanError();
                }

                return $next($request);
                break;
        }
    }
}
