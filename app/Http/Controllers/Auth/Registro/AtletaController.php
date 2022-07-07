<?php

namespace App\Http\Controllers\Auth\Registro;

use App\Helpers\ApiHelpers;
use App\Models\Usuarios;
use App\Models\Personal;
use App\Models\Atleta;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Usuario as UsuarioRequest;
use App\Mail\Registro as RegistroMail;
use Illuminate\Support\Facades\Mail;

class AtletaController extends Controller
{
    public function registrar(UsuarioRequest\Store $usuario)
    {
        
        $uuid = 'Cross';

        $registrar_atleta = Usuarios::create([
            'uuid'           =>   ApiHelpers::generarIdentifacador($uuid),
            'nombre'           => $usuario->nombre,
            'apellido_paterno' => $usuario->apellido_paterno,
            'apellido_materno' => $usuario->apellido_materno,
            'telefono'         => $usuario->telefono,
            'email'            => $usuario->email,
            'password'         => bcrypt($password = Str::random(6)),
            'id_rol_sistema'   => 4, #Usuario del sistema
        ]);

        $registrar_personal = Personal::create([
            'id_usuario' => $registrar_atleta->id,
            'id_rol_personal' => 8,
        ]);

        $datos_atleta = Atleta::create([
            'id_usuario'      => $registrar_atleta->id,
            'codigo_asignar' => ApiHelpers::getCodigoVerificacion($uuid),
        ]);

        Mail::to($registrar_atleta->email)->send(new RegistroMail\Atleta($registrar_atleta, $password, $uuid));
        if (Mail::failures()) {
            $registrar_atleta->delete();
            return ApiHelpers::msgServerError('Ocurrió un error inesperado #01');
        }
        
        return ApiHelpers::msgSuccessStore("El registro ha sido exitoso, en unos momentos
         te llegará mas información y las licencias de acceso a tu correo electrónico '{$registrar_atleta->email}'");
    }
}
