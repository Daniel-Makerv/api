<?php

namespace Database\Seeders\Test;

use App\Models\AsignacionPlanes;
use Illuminate\Database\Seeder;

class AsignacionPlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AsignacionPlanes::truncate();
         
        /*  
        AsignacionPlanes::create([
            'id_empresa'   => 1,
            'id_plan'      => 4,
            'pago'         => 400,
            'fecha_inicio' => now(),
            'fecha_fin'    => now()->addDays(30),
        ]); */
    }
}
