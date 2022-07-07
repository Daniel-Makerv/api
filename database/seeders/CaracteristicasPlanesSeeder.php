<?php

namespace Database\Seeders;

use App\Models\CaracteristicasPlanes;
use Illuminate\Database\Seeder;

class CaracteristicasPlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CaracteristicasPlanes::truncate();

        //Básico
        $id_plan = 1;
        CaracteristicasPlanes::insert([
            [
                'id'                => 101,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 2,
            ],
            [
                'id'                => 102,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 4,
            ],
            [
                'id'                => 103,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 5,
            ],
            [
                'id'                => 104,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 6,
            ],
            [
                'id'                => 105,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 7,
            ]
        ]);

        //Gold
        $id_plan = 2;
        CaracteristicasPlanes::insert([
            [
                'id'                => 201,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 1,
            ],
            [
                'id'                => 202,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 2,
            ],
            [
                'id'                => 203,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 3,
            ],
            [
                'id'                => 204,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 4,
            ],
            [
                'id'                => 205,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 5,
            ],
            [
                'id'                => 206,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 6,
            ],
            [
                'id'                => 207,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 7,
            ],
        ]);

        //Platino
        $id_plan = 3;
        CaracteristicasPlanes::insert([
            [
                'id'                => 301,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 1,
            ],
            [
                'id'                => 302,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 2,
            ],
            [
                'id'                => 303,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 3,
            ],
            [
                'id'                => 304,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 4,
            ],
            [
                'id'                => 305,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 5,
            ],
            [
                'id'                => 306,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 6,
            ],
            [
                'id'                => 307,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 7,
            ],
            [
                'id'                => 308,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 8,
            ],
            [
                'id'                => 309,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 9,
            ],
        ]);

        //Ultra
        $id_plan = 4;
        CaracteristicasPlanes::insert([
            [
                'id'                => 401,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 1,
            ],
            [
                'id'                => 402,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 2,
            ],
            [
                'id'                => 403,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 3,
            ],
            [
                'id'                => 404,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 4,
            ],
            [
                'id'                => 405,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 5,
            ],
            [
                'id'                => 406,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 6,
            ],
            [
                'id'                => 407,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 7,
            ],
            [
                'id'                => 408,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 8,
            ],
            [
                'id'                => 409,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 9,
            ],
            [
                'id'                => 410,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 10,
            ],
            [
                'id'                => 411,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 11,
            ],
            [
                'id'                => 412,
                'id_plan'           => $id_plan,
                'id_caracteristica' => 12,
            ],
        ]);
    }
}
