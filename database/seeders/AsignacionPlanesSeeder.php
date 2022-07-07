<?php

namespace Database\Seeders;

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

        AsignacionPlanes::insert([
            [
                'id' => '1',
                'id_empresa' => '1',
                'id_plan' => '4',
                'pago' => '400',
                'fecha_inicio' => now(),
                'fecha_fin' => now()->addDays(30),
            ],
            [
                'id' => '2',
                'id_empresa' => '2',
                'id_plan' => '4',
                'pago' => '400',
                'fecha_inicio' => now(),
                'fecha_fin' => now()->addDays(30),
            ],
            [
                'id' => '3',
                'id_empresa' => '3',
                'id_plan' => '4',
                'pago' => '400',
                'fecha_inicio' => now(),
                'fecha_fin' => now()->addDays(30),
            ]
        ]);
    }
}
