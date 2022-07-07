<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Ciudades;
use App\Models\Paises;
use App\Models\Provincias;
use Illuminate\Http\Request;

class LocationCascadeController extends Controller
{
    public function paises()
    {
        $paises = Paises::query()
            ->where('status', 1)
            ->orderBy('nombre', 'ASC')
            ->get();

        return response()->json($paises);
    }

    public function provincias($id_pais)
    {
        $pais = Paises::query()
            ->where('id', $id_pais)
            ->where('status', 1)
            ->first();

        if (!$pais) {
            return response()->json();
        }

        $provincias = Provincias::query()
            ->where('id_pais', $pais->id)
            ->where('status', 1)
            ->orderBy('nombre', 'ASC')
            ->get();

        return response()->json($provincias);
    }

    public function ciudades($id_provincia)
    {
        $provincia = Provincias::query()
            ->where('id', $id_provincia)
            ->where('status', 1)
            ->orderBy('nombre', 'ASC')
            ->first();

        if (!$provincia) {
            return response()->json();
        }

        $ciudades = Ciudades::query()
            ->where('id_provincia', $provincia->id)
            ->where('status', 1)
            ->orderBy('nombre', 'ASC')
            ->get();

        return response()->json($ciudades);
    }
}
