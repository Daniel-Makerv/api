<?php

namespace Database\Seeders;

use App\Models\Personal;
use Illuminate\Database\Seeder;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Personal::insert([
           
            [
                'id' => 1,
                'id_empresa' => '1',
                'id_centro' => '1',
                'id_usuario' => '1',
                'id_rol_personal'  => '1',
                'status'            => '1',
            ],
            [
                'id' => 2,
                'id_empresa' => '2',
                'id_centro' => '2',
                'id_usuario' => '2',
                'id_rol_personal'  => '1',
                'status'            => '1',
            ],
            [
                'id' => 3,
                'id_empresa' => '3',
                'id_centro' => '3',
                'id_usuario' => '3',
                'id_rol_personal'  => '1',
                'status'            => '1',
            ],
            [
                'id' => 11,
                'id_empresa' => '1',
                'id_centro' => '1',
                'id_usuario' => '11',
                'id_rol_personal'  => '1',
                'status'            => '1',
            ],
             // usuario daniel
            [
                'id' => 4,
                'id_empresa' => '1',
                'id_centro' => '1',
                'id_usuario' => '4',
                'id_rol_personal'  => '3',
                'status'            => '1',
            ],
            [
                'id' => 5,
                'id_empresa' => '1',
                'id_centro' => '2',
                'id_usuario' => '5',
                'id_rol_personal'  => '3',
                'status'            => '1',
            ],
            [
                'id' => 10,
                'id_empresa' => '1',
                'id_centro' => null,
                'id_usuario' => '10',
                'id_rol_personal'  => '3',
                'status'            => '1',
            ],

            // usuario arturo
            [
                'id' => 6,
                'id_empresa' => '2',
                'id_centro' => '3',
                'id_usuario' => '6',
                'id_rol_personal'  => '3',
                'status'            => '1',
            ],
            [
                'id' => 7,
                'id_empresa' => '2',
                'id_centro' => '4',
                'id_usuario' => '7',
                'id_rol_personal'  => '3',
                'status'            => '1',
            ],

            // usuario azucena
            [
                'id' => 8,
                'id_empresa' => '3',
                'id_centro' => '5',
                'id_usuario' => '8',
                'id_rol_personal'  => '3',
                'status'            => '1',
            ],
            [
                'id' => 9,
                'id_empresa' => '3',
                'id_centro' => '6',
                'id_usuario' => '9',
                'id_rol_personal'  => '3',
                'status'            => '1',
            ],
        ]);
    }
}
