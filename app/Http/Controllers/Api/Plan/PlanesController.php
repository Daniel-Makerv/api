<?php

namespace App\Http\Controllers\Api\Plan;

use App\Models\Planes;
use App\Http\Controllers\Controller;

class PlanesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $planes = Planes::all();
        return response()->json($planes);
    }
}
