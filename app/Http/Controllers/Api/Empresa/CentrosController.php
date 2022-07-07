<?php

namespace App\Http\Controllers\Api\Empresa;

use App\Models\Centros;
use App\Models\Personal;
use App\Models\Usuarios;
use Illuminate\Support\Str;
use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;
use App\Mail\Centro as CentroMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Centro as CentroRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class CentrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centros = Centros::query()
            ->where('id_empresa', auth()->user()->empresa->id)
            ->get()
            ->append(['admin', 'id_admin', 'direccion_completa', 'id_pais', 'id_provincia', 'provincia', 'ciudad']);
        return response()->json($centros);

        /// pruebas 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CentroRequest\Store $request)
    {
        $verificarLimite = ApiHelpers::canStoreCentro();
        if (!$verificarLimite) {
            return ApiHelpers::msgLimitError();
        }

        $id_admin = $request->id_admin;
        $usuarioEsperado = ApiHelpers::userExpected($id_admin /* Usuario */, 3 /* Centro */, 3 /* Administrador de centro */);
        if (!$usuarioEsperado) {
            return ApiHelpers::msgAuthorizationError('Selecciona un administrador de centro válido #01');
        }

        $auth = auth()->user();

        $administrador_centro = Usuarios::where('id', $id_admin)->first();
        if (!$administrador_centro) {
            return ApiHelpers::msgClientError('Ocurrió un error inesperado #02');
        }

        $personal = Personal::query()
            ->where('id_empresa', $auth->empresa->id)
            ->where('id_usuario', $id_admin)
            ->whereNull('id_centro')
            ->first();

        if (!$personal) {
            return ApiHelpers::msgClientError('No es posible utilizar al usuario indicado ya que ya es administrador de uno de tus centros #03');
        }
        //subir imagen de perfil
        $exploded = explode(',', $request->logo_image);
        $decoded = base64_decode($exploded[1]);

        if (str_contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }
        $fileName = auth()->id('id') . '-' . auth()->user()->nombre . '-' . Str::random() . '.' . $extension;
        $path = public_path('fotos_centros') . '/' . $fileName;
        file_put_contents($path, $decoded);

        $registrarCentro = Centros::create(
            [
                'id_empresa' => $auth->empresa->id,
                'nombre'     => $request->nombre,
                'email'      => $request->email,
                'telefono'   => $request->telefono,
                'id_ciudad'  => $request->id_ciudad,
                'direccion'  => $request->direccion,
                'id_tipo_centro' => $request->id_tipo_centro,
                'fb_page'  => $request->fb_page,
                'website'  => $request->website,
                'logo_image' => $fileName
            ]
        );

        $personal->update([
            'id_centro' => $registrarCentro->id
        ]);

        Mail::to($administrador_centro->email)->send(new CentroMail\AdministradorAsignado($auth, $administrador_centro, $registrarCentro));
        if (Mail::failures()) {
            $registrarCentro->delete();
            $personal->delete();
            return ApiHelpers::msgServerError('Ocurrió un error inesperado #04');
        }

        return ApiHelpers::msgSuccessStore('Se ha registrado el centro deportivo correctamente');
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
    public function update(Request $request, $id)
    {
        //
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

        $auth = auth()->user();

        $validarPertenencia = ApiHelpers::canUseCentro($id);
        if (!$validarPertenencia) {
            return ApiHelpers::msgAuthorizationError();
        }

        $centro = Centros::where('id', $id)->first();
        if (!$centro) {
            return ApiHelpers::msgServerError('Ocurrió un error inesperado #01');
        }

        $relacionAdminCentro = Personal::query()
            ->where('id_empresa', $auth->empresa->id)
            ->where('id_centro', $centro->id)
            ->where('id_rol_personal', 3) #Administrador de centro
            ->first();

        if ($relacionAdminCentro) {
            $relacionAdminCentro->update([
                'id_centro' => null
            ]);
        }

        $centro->delete();
        return ApiHelpers::msgSuccess('Se ha eliminado permanentemente el centro');
    }
}
