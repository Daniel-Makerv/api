<?php

namespace App\Http\Controllers\Api\Centro;
use Illuminate\Http\Request;
use App\Models\Programas;
use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programa = Programas::query()
        ->where('id_centro', auth()->user()->centro->id)
        ->orderBy('created_at')
        ->get();

    return response()->json($programa);
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
    public function store(Request $request)
    {
        $auth = auth()->user();
        
        $programa = Programas::create([
            'nombre' => $request->nombre,
            'id_centro' => $auth->centro->id,
            'permitir_mas_reserva'  => $request->permitir_mas_reserva,
            'cancelar_fuera_plazo' => $request->cancelar_fuera_plazo,
            'reservar_desde'  => $request->reservar_desde,
            'opcion_reservar_desde'  => $request->opcion_reservar_desde,
            'periodo_reservar_desde' => $request->periodo_reservar_desde,
            'reservar_hasta'  => $request->reservar_hasta,
            'opcion_reservar_hasta'  => $request->opcion_reservar_hasta,
            'periodo_reservar_hasta' => $request->periodo_reservar_hasta,
            'opcion_cancelar_reserva'  => $request->opcion_cancelar_reserva,
            'cancelar_reserva' => $request->cancelar_reserva,
            'periodo_cancelar_reserva' => $request->periodo_cancelar_reserva,
            'color' => $request->color,
            'status' => '1'
        ]
    );
    return ApiHelpers::msgSuccessStore('Se ha registrado el programa correctamente');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $programa->update([
        'nombre' => $request->nombre,
        'permitir_mas_reserva'  => $request->permitir_mas_reserva,
        'cancelar_fuera_plazo' => $request->cancelar_fuera_plazo,
        'reservar_desde'  => $request->reservar_desde,
        'opcion_reservar_desde'  => $request->opcion_reservar_desde,
        'reservar_hasta'  => $request->reservar_hasta,
        'opcion_reservar_hasta'  => $request->opcion_reservar_hasta,
        'opcion_cancelar_reserva'  => $request->opcion_cancelar_reserva,
        'cancelar_reserva' => $request->cancelar_reserva,
        'color'  => $request->color,
        'status' => $request->status
      ]);
      return ApiHelpers::msgSuccessStore('Se ha registrado el programa correctamente');
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
        $programa = Programas::where('id', $id)->first();
        if (!$programa) {
            return ApiHelpers::msgServerError('Ocurrió un error inesperado #01');
        }

        $programa->delete();
        return ApiHelpers::msgSuccess('¡Se ha eliminado el programa!');
    }
}
