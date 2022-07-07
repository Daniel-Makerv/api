<?php

namespace App\Http\Controllers\Api\Plan;

use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LimiteController extends Controller
{
    /**
     * Retorna el limite de centros
     */
    public function centros()
    {
        return response()->json(ApiHelpers::getLimiteCentros());
    }

    /**
     * Retorna el limite de auxiliares administradores de empresa
     */
    public function aux_admin_empresa()
    {
        $limite = ApiHelpers::getLimiteAuxAdminEmpresa();
        if ($limite == null) {
            $limite = 0;
        }
        return response()->json($limite);
    }
}
