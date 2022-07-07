<?php

namespace App\Http\Controllers\Api\Centro;

use Illuminate\Http\Request;
use App\Models\Clases;
use App\Models\Personal;
use App\Models\DiasClases;
use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clase = Clases::query()
            ->where('id_centro', auth()->user()->centro->id)
            ->orderBy('created_at')
            ->get()
            ->append(['programa', 'coach','sala','dias_clases']);

        return response()->json($clase);
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
        $dias = $request->dias;

        $clase = Clases::create([
            'id_centro' => auth()->user()->centro->id,
            'id_programa' => $request->id_programa,
            'id_coach' => $request->id_coach,
            'id_sala' => $request->id_sala,
            'limite_reservas'  => $request->limite_reservas,
            'contar_reserva' => $request->contar_reserva,
            'hora_inicio'  => $request->hora_inicio,
            'hora_fin'  => $request->hora_fin,
            'restringir_disp'  => $request->restringir_disp,
            'status' => '1'
        ]);

        // guardando dias seleccionados
        if (is_array($dias)) {
            foreach ($dias as $key => $name) {
                $insert = [
                    'id_clase' => $clase->id,
                    'dia_semana' => $dias[$key],
                ];
                DiasClases::insert($insert);
            }
        }
        
        return ApiHelpers::msgSuccessStore('Se ha registrado la clase correctamente');
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
    public function destroy($id)
    {
        //
    }

    public function getStatsClases(){
        $clase = Clases::query()
            ->where('id_centro', auth()->user()->centro->id)
            ->orderBy('created_at')
            ->count();

        return response()->json($clase);
    }
}
