<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use App\Models\Empresas;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{

    public function updateContacto(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email', 'indisposable'],
            'telefono' => ['required', 'regex:/^[1-9]{1}[0-9]{9}$/'],
        ]);

        Empresas::where('id', auth()->user()->empresa->id)->update([
            'email'    => $request->email,
            'telefono' => $request->telefono
        ]);

        return ApiHelpers::msgSuccessStore('Se actualizó la información');
    }

    public function renovacionAutomaticaPlan()
    {
        Empresas::where('id', auth()->user()->empresa->id)->update([
            'renovacion_automatica_plan' => !$this->empresa->renovacion_automatica_plan
        ]);

        return ApiHelpers::msgSuccessStore('Cambió el estado de renovación automática');
    }
}
