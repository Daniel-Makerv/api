<?php

namespace App\Http\Controllers\Api\Centro;

use Illuminate\Http\Request;
use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Custom\Centro;
use App\Models\Centros;
use App\Models\Sala;
use Illuminate\Validation\ValidationException;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sala = Sala::query()
            ->where('id_centro', auth()->user()->centro->id)
            ->orderBy('created_at')
            ->get();

        return response()->json($sala);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $sala = Sala::create([
            'id_centro' => $user->centro->id,
            'nombre' => $request->nombre,
            'status' => '1'
        ]
    );
    return ApiHelpers::msgSuccessStore('Se ha registrado la sala correctamente');
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
        $sala = Sala::where('id', $request->id)->first();

        $sala->update([
            'nombre' => $request->nombre,
            'status' => $request->status,
          ]);
        
     return ApiHelpers::msgSuccessStore('Se actualizó la sala');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // $request->validate([
        //     'password' => ['required', 'string']
        // ]);

        // if (!ApiHelpers::checkPassword($request->password)) {
        //     throw ValidationException::withMessages([
        //         'password' => 'La contraseña es incorrecta'
        //     ]);
        // }
        // $sala = Sala::where('id', $id)->first();
        // if (!$sala) {
        //     return ApiHelpers::msgServerError('Ocurrió un error inesperado');
        // }
        
        Sala::where('id', $id)->delete();

        // $sala->delete();
        return ApiHelpers::msgSuccess('¡Se ha eliminado la sala!');
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

}
