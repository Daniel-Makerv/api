<?php

namespace App\Http\Controllers\Api\Centro;

use Illuminate\Http\Request;
use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use App\Models\Atleta;
use App\Models\Personal;
use App\Models\Usuarios;
use Illuminate\Support\Str;
use App\Mail\Registro as RegistroMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Usuario as UsuariosRequest;


class AtletaController extends Controller
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
            ->whereIn('id_rol_personal', [8])
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuariosRequest\Store $request)
    {
        $user = auth()->user();
        $uuid = 'Cross';
        $registrar = Usuarios::create([
            'uuid'           =>   ApiHelpers::generarIdentifacador($uuid),
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'telefono'         => $request->telefono,
            'email'            => $request->email,
            'id_rol_sistema'   => '4',
            'password'         => bcrypt($password = Str::random(6)),
        ]);


        $asignarPersonal = Personal::create([
            'id_empresa'      => $user->empresa->id,
            'id_centro' => $user->centro->id,
            'id_usuario'      => $registrar->id,
            'id_rol_personal' => '8',
            'status' => '1'
        ]);

        $registrara = Atleta::create([
            'id_usuario'      => $registrar->id,
        ]);

        Mail::to($registrar->email)->send(new RegistroMail\AtletaByAdmin($registrar, $password, $uuid));
        if (Mail::failures()) {
            $registrar->delete();
            return ApiHelpers::msgServerError('Ocurrió un error inesperado #01');
        }

        return ApiHelpers::msgSuccessStore("El registro del atleta ha sido exitoso, en unos momentos
        llegarán las licencias de acceso al correo electrónico '{$registrar->email}'");
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
        $atleta = Usuarios::where('id', $request->id)->first();


        $atleta->update([
            'nombre'           => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'telefono'         => $request->telefono,
            'email'            => $request->email,
            'status'           => $request->status,
        ]);

        return ApiHelpers::msgSuccessStore('Se actualizó al atleta');
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

        Atleta::where('id_usuario', $id)->delete();
        Personal::where('id_usuario', $id)->delete();
        Usuarios::where('id', $id)->delete();

        return ApiHelpers::msgSuccess('Se ha eliminado correctamente');
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
    public function getAtletaSinCentro()
    {
        $verifyPersonal = Personal::query()
            ->where('status', [1])
            ->whereNull('id_empresa')
            ->whereNull('id_centro')
            ->whereIn('id_rol_personal', [8])
            ->get();

        $atleta = Usuarios::query()
            ->whereIn('id', $verifyPersonal->pluck('id_usuario'))
            ->get()
            ->append(['nombre_completo']);

        return response()->json($atleta);
    }

    /**
     * asigna el atleta a un centro deportivo
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function asignar(Request $request, $id)
    {
        $request->validate([
            'codigo_asignar' => ['required', 'string']
        ]);

        $usuario = Usuarios::where('id', $request->id)->first();
        $auth = auth()->user();

        $personal = Personal::query()
            ->where('id_usuario', $usuario->pluck('id'))
            ->first();
        $personal->update([
            'id_empresa' => $auth->empresa->id,
            'id_centro' => $auth->centro->id,
        ]);

        return ApiHelpers::msgSuccessStore('¡Se asigno correctamente el usuario!');
    }
    public function getStatsAtletas(){
        $relation = Personal::query()
            ->where('id_usuario', '!=', auth()->user()->id)
            ->where('id_centro', auth()->user()->centro->id)
            ->whereIn('id_rol_personal', [8])
            ->get();

        $personal = Usuarios::query()
            ->whereIn('id', $relation->pluck('id_usuario'))
            ->count();
        return response()->json($personal);
    }
}
