<?php

namespace Database\Seeders;

use App\Models\MetaCaracteristicasPlanes;
use Illuminate\Database\Seeder;

class MetaCaracteristicasPlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MetaCaracteristicasPlanes::truncate();

        //Básico
        MetaCaracteristicasPlanes::insert([
            [
                'id_caracteristica_plan' => 101,
                'key'                    => 'Limite',
                'value'                  => '1',
            ],
            [
                'id_caracteristica_plan' => 102,
                'key'                    => 'Limite',
                'value'                  => '60',
            ],

        ]);

        //Gold
        MetaCaracteristicasPlanes::insert([
            [
                'id_caracteristica_plan' => 201,
                'key'                    => 'Limite',
                'value'                  => '1',
            ],
            [
                'id_caracteristica_plan' => 202,
                'key'                    => 'Limite',
                'value'                  => '3',
            ],
            [
                'id_caracteristica_plan' => 203,
                'key'                    => 'Limite',
                'value'                  => '2',
            ],
            [
                'id_caracteristica_plan' => 204,
                'key'                    => 'Limite',
                'value'                  => '80',
            ],
        ]);

        //Platino
        MetaCaracteristicasPlanes::insert([
            [
                'id_caracteristica_plan' => 301,
                'key'                    => 'Limite',
                'value'                  => '3',
            ],
            [
                'id_caracteristica_plan' => 302,
                'key'                    => 'Limite',
                'value'                  => '5',
            ],
            [
                'id_caracteristica_plan' => 303,
                'key'                    => 'Limite',
                'value'                  => '3',
            ],
            [
                'id_caracteristica_plan' => 304,
                'key'                    => 'Limite',
                'value'                  => '160',
            ],
        ]);

        //Ultra
        MetaCaracteristicasPlanes::insert([
            [
                'id_caracteristica_plan' => 401,
                'key'                    => 'Limite',
                'value'                  => '6',
            ],
            [
                'id_caracteristica_plan' => 402,
                'key'                    => 'Limite',
                'value'                  => '8',
            ],
            [
                'id_caracteristica_plan' => 403,
                'key'                    => 'Limite',
                'value'                  => '6',
            ],
            [
                'id_caracteristica_plan' => 404,
                'key'                    => 'Limite',
                'value'                  => '320',
            ],
        ]);
    }
}
