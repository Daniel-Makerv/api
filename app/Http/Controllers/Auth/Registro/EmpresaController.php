<?php

namespace App\Http\Controllers\Auth\Registro;

use App\Helpers\ApiHelpers;
use App\Models\empresas;
use App\Models\Usuarios;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Empresa as EmpresaRequest;
use App\Http\Requests\Usuario as UsuarioRequest;
use App\Mail\Registro as RegistroMail;
use App\Models\Personal;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    public function paso1(EmpresaRequest\Store $empresa)
    {
        return response()->json('Ok', 200);
    }

    public function paso2(Request $request)
    {
        $validarEmpresa = Validator::make($empresa = $request->empresa, EmpresaRequest\Store::rules());
        if ($validarEmpresa->fails()) {
            return ApiHelpers::sendErrorsValidator($validarEmpresa->errors(), 'empresa');
        }

        $validarAdmin = Validator::make($admin = $request->admin, UsuarioRequest\Store::rules());
        if ($validarAdmin->fails()) {
            return ApiHelpers::sendErrorsValidator($validarAdmin->errors(), 'admin');
        }

        $registrar_empresa = Empresas::create([
            'nombre_fiscal'   => $empresa['nombre_fiscal'],
            'id_fiscal'       => $empresa['id_fiscal'],
            'email'           => $empresa['email'],
            'telefono'        => $empresa['telefono'],
            'id_ciudad'       => $empresa['id_ciudad'],
            'direccion_legal' => $empresa['direccion_legal'],
        ]);

        $uuid = 'Cross';
        
        $registrar_admin = Usuarios::create([
            'nombre'           => $admin['nombre'],
            'uuid'           =>   ApiHelpers::generarIdentifacador($uuid),
            'apellido_paterno' => $admin['apellido_paterno'],
            'apellido_materno' => $admin['apellido_materno'],
            'telefono'         => $admin['telefono'],
            'fecha_nacimiento' => $admin['fecha_nacimiento'],
            'sexo'         => $admin['sexo'],
            'email'            => $admin['email'],
            'password'         => bcrypt($password = Str::random(6)),
            'id_rol_sistema'   => 2 #Empresa
        ]);
        
        $asignar_admin = Personal::create([
            'id_empresa'      => $registrar_empresa->id,
            'id_usuario'      => $registrar_admin->id,
            'id_rol_personal' => 1 #Administrador
        ]);

        Mail::to($registrar_admin->email)->send(new RegistroMail\Empresa($registrar_empresa, $registrar_admin, $password));
        if (Mail::failures()) {
            $registrar_empresa->delete();
            $registrar_admin->delete();
            $asignar_admin->delete();
            return ApiHelpers::msgServerError('Ocurrió un error inesperado #01');
        }

        return ApiHelpers::msgSuccessStore("El registro ha sido exitoso, en unos momentos te llegarán las licencias de acceso a tu correo electrónico '{$registrar_admin->email}'");
    }
}
