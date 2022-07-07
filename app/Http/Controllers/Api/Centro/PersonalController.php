<?php

namespace App\Http\Controllers\Api\Centro;

use Illuminate\Http\Request;
use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use App\Models\Personal;
use App\Models\PersonalCentro;
use App\Models\Usuarios;
use Illuminate\Support\Str;
use App\Rules as CustomRule;
use App\Models\RolesPersonal;
use App\Mail\Centro as CentroMail;
use Illuminate\Support\Facades\Storage;
use App\Mail\Empresa as EmpresaMail;
use Illuminate\Support\Facades\Mail;
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
            ->where('id_centro', auth()->user()->centro->id)
            ->whereIn('id_rol_personal', [3, 4, 5, 6, 7])
            ->get();

        $personal = Usuarios::query()
            ->whereIn('id', $relation->pluck('id_usuario'))
            ->get()
            ->append(['nombre_completo', 'rol_personal', 'centro']);

        return response()->json($personal);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            if (!ApiHelpers::canStoreCentro()) {
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
            'nombre'           => $request->nombre,
            'uuid'           =>   ApiHelpers::generarIdentifacador($uuid),
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'telefono'         => $request->telefono,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'email'            => $request->email,
            'password'         => bcrypt($password = Str::random(8)),
            'id_rol_sistema'   => $rolPersonal->id_rol_sistema
        ]);

        $asignarPersonal = Personal::create([
            'id_empresa'      => $user->empresa->id,
            'id_centro' => $user->centro->id,
            'id_usuario'      => $registrar->id,
            'id_rol_personal' => $rolPersonal->id,
            'status' => '1'
        ]);

        switch ($rolPersonal->id) {
            case 2:
                Mail::to($registrar->email)->send(new EmpresaMail\AuxiliarAdministrador($user, $user->empresa, $registrar, $password));
                break;

            case 3:
                Mail::to($registrar->email)->send(new CentroMail\AdministradorAyudante($user, $user->centro, $registrar, $password));
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'email'            => $request->email,
            'status'           => $request->status,
        ]);

        if ($personal->id_rol_sistema == 3 /* Centro */ and $personal->rol_personal->id == 3 /* Administrador de centro */) {
            $validar_centro = Validator::make($request->all(), [
                'id_centro' => ['required', 'integer', new CustomRule\MiCentro]
            ]);

            if (!$validar_centro->fails() and !$personal->centro->id) {
                PersonalCentro::where('id_usuario', $personal->id)->update([
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

    public function roles()
    {
        $roles_personal = RolesPersonal::query()
            ->whereIn('id_rol_sistema', [3])
            ->get();

        return response()->json($roles_personal);
    }

    public function getCoachs()
    {
        $relation = Personal::query()
            ->where('id_usuario', '!=', auth()->user()->id)
            ->where('id_centro', auth()->user()->centro->id)
            ->whereIn('id_rol_personal', [7])
            ->get();

        $personal = Usuarios::query()
            ->whereIn('id', $relation->pluck('id_usuario'))
            ->get()
            ->append(['nombre_completo', 'rol_personal', 'centro']);

        return response()->json($personal);
    }
    public function getStatsPersonal(){
        $relation = Personal::query()
            ->where('id_usuario', '!=', auth()->user()->id)
            ->where('id_centro', auth()->user()->centro->id)
            ->whereIn('id_rol_personal', [3, 4, 5, 6, 7])
            ->get();

        $personal = Usuarios::query()
            ->whereIn('id', $relation->pluck('id_usuario'))
            ->count();
        return response()->json($personal);
    }
}
