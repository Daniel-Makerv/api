<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Centros;

class CentroController extends Controller
{
    public function updateContacto(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email', 'indisposable'],
            'telefono' => ['required', 'regex:/^[1-9]{1}[0-9]{9}$/'],
            'website'  => ['nullable', 'active_url'],
            'fb_page'  => ['nullable', 'regex:/^(?:https?:\/\/)?(?:www\.)?(mbasic.facebook|m\.facebook|facebook|fb)\.(com|me)\/(?:(?:\w\.)*#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)/', 'active_url']
        ]);

        Centros::where('id', auth()->user()->centro->id)->update([
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'website'  => $request->website,
            'fb_page'  => $request->fb_page
        ]);

        return ApiHelpers::msgSuccessStore('Se actualizó la información');
    }
}
