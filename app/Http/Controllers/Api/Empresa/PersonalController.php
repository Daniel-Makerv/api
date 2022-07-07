<?php

namespace App\Http\Controllers\Api\Empresa;

use App\Models\Personal;
use App\Models\Usuarios;
use App\Helpers\ApiHelpers;
use Illuminate\Support\Str;
use App\Rules as CustomRule;
use App\Models\RolesPersonal;
use App\Mail\Centro as CentroMail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Mail\Empresa as EmpresaMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Usuario as UsuariosRequest;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relation = Personal::query()
        ->where('id_usuario', '!=', auth()->user()->id)
        ->where('id_empresa', auth()->user()->empresa->id)
        ->whereIn('id_rol_personal', [2, 3])
        ->get();

    $personal = Usuarios::query()
        ->whereIn('id', $relation->pluck('id_usuario'))
        ->get()
        ->append(['nombre_completo', 'rol_personal', 'centro']);

    return response()->json($personal);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuariosRequest\Store $request)
    {
        if ($request->id_rol_personal == 2) {
            if (!ApiHelpers::canStoreAuxAdminEmpresa()) {
                return ApiHelpers::msgLimitError();
            }
        }

        $validarRolPersonal = ApiHelpers::canUseRolPersonal($request->id_rol_personal);
        if (!$validarRolPersonal) {
            return ApiHelpers::msgAuthorizationError('Selecciona un rol válido');
        }

        $user = auth()->user();

        $rolPersonal = RolesPersonal::where('id', $request->id_rol_personal)->first();
        if (!$rolPersonal) {
            return ApiHelpers::msgServerError('Ocurrió un error inesperado #01');
        }

        $uuid = 'Cross';
        $registrar = Usuarios::create([
            'uuid'           =>   ApiHelpers::generarIdentifacador($uuid),
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'telefono'         => $request->telefono,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'email'            => $request->email,
            'password'         => bcrypt($password = Str::random(8)),
            'id_rol_sistema'   => $rolPersonal->id_rol_sistema, 

        ]);     
        
        $asignarPersonal = Personal::create([
            'id_empresa'      => $user->empresa->id,
            'id_usuario'      => $registrar->id,
            'id_rol_personal' => $rolPersonal->id
        ]);

        switch ($rolPersonal->id) {
            case 2:
                Mail::to($registrar->email)->send(new EmpresaMail\AuxiliarAdministrador($user, $user->empresa, $registrar, $password));
                break;

            case 3:
                Mail::to($registrar->email)->send(new CentroMail\Administrador($user, $registrar, $password));
                break;
        }

        if (Mail::failures()) {
            $asignarPersonal->delete();
            $registrar->delete();
            return ApiHelpers::msgServerError('Ocurrió un error inesperado #02');
        }

        return ApiHelpers::msgSuccessStore('Se ha registrado al personal');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuariosRequest\Update $request, $id)
    {
        if (!ApiHelpers::canUsePersonal($request->id)) {
            return ApiHelpers::msgAuthorizationError();
        }

        $personal = Usuarios::where('id', $request->id)->first();
        
        $personal->update([
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'telefono'         => $request->telefono,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'email'            => $request->email,
            'status'           => $request->status,
            'avatar' =>$request->avatar, 
        ]);
 
        if ($personal->id_rol_sistema == 3 /* Centro */ and $personal->rol_personal->id == 3 /* Administrador de centro */) {
            $validar_centro = Validator::make($request->all(), [
                'id_centro' => ['required', 'integer', new CustomRule\MiCentro]
            ]);

            if (!$validar_centro->fails() and !$personal->centro->id) {
                Personal::where('id_usuario', $personal->id)->update([
                    'id_centro' => $request->id_centro
                ]);
            }
        }

        return ApiHelpers::msgSuccessStore('Se actualizó al personal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'string']
        ]);

        if (!ApiHelpers::checkPassword($request->password)) {
            throw ValidationException::withMessages([
                'password' => 'La contraseña es incorrecta'
            ]);
        }

        if (!ApiHelpers::canUsePersonal($id)) {
            return ApiHelpers::msgAuthorizationError();
        }

        Personal::where('id_usuario', $id)->delete();
        Usuarios::where('id', $id)->delete();

        return ApiHelpers::msgSuccess('Se ha revocado el acceso');
    }

    /**
     * Administradores de centro
     */
    public function centrosIndex()
    {
        $relation = Personal::query()
            ->where('id_usuario', '!=', auth()->user()->id)
            ->where('id_empresa', auth()->user()->empresa->id)
            ->whereIn('id_rol_personal', [3]) #Administrador de centro
            ->whereNull('id_centro')
            ->get();

        $administradores = Usuarios::query()
            ->whereIn('id', $relation->pluck('id_usuario'))
            ->get()
            ->append(['nombre_completo', 'centro']);

        return response()->json($administradores);
    }

    /**
     * Roles de personal
     */
    public function roles()
    {
        $auth = auth()->user();
        switch ($auth->rol_personal->id) {
            case 1: #Administrador de empresa
                switch (auth()->user()->empresa->plan_vigente->id_plan) {
                    case 1:
                        $roles = [3]; #Administrador de centro
                        break;

                    default:
                        $roles = [2, 3]; #Auxiliar Administrador de empresa y Administrador de centro
                        break;
                }
                break;

            case 2: #Auxiliar administrador de empresa
                $roles = [3]; #Administrador de centro
                break;

            default:
                $roles = [];
                break;
        }

        $roles_personal = RolesPersonal::query()
            ->whereIn('id', $roles)
            ->get();

        return response()->json($roles_personal);
    }
}
