<?php

namespace App\Http\Controllers\Api\Empresa;

use App\Models\Planes;
use App\Models\Personal;
use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;
use App\Models\AsignacionPlanes;
use App\Http\Controllers\Controller;

class PlanesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planes = AsignacionPlanes::query()
                                  ->where('id_empresa', auth()->user()->empresa->id)
                                  ->orderBy('created_at')
                                  ->get();

        return response()->json($planes);
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
        //
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

    public function buy(Request $request)
    {
        $plan = Planes::query()
            ->where('id', $request->id_plan)
            ->first();

        if (!$plan) {
            return ApiHelpers::msgClientError('Ocurrió un error #01');
        }

        $usuario = $request->user();
        $personal = Personal::query()
            ->where('id_usuario', $usuario->id)
            ->first();

        if (!$personal) {
            return ApiHelpers::msgClientError('Ocurrió un error #02');
        }

        if ($usuario->empresa->plan_vigente) {
            return ApiHelpers::msgClientError('No se puede continuar ya que actualmente existe un plan vigente');
        }

        $plan = AsignacionPlanes::create([
            'id_empresa'   => $personal->id_empresa,
            'id_plan'      => $plan->id,
            'pago'         => $plan->precio,
            'fecha_inicio' => now(),
            'fecha_fin'    => now()->addDays(30),
        ]);

        return ApiHelpers::msgSuccessStore("El plan se ha adquirido correctamente, ahora puedes continuar y disfrutar de los servicios");
    }
}
