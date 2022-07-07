<?php

namespace Database\Seeders;

use App\Models\Usuarios;
use Illuminate\Database\Seeder;
use App\Helpers\ApiHelpers;
class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuarios::truncate();
        $uuid = 'identifier';
        Usuarios::insert([
            [
                'id'               => 1,
                'uuid'             => '397020',
                'nombre'           => 'daniel',
                'apellido_paterno' => 'rivera',
                'apellido_materno' => 'de la cruz',
                'telefono'         => '7223491801',
                'email'            => 'al221811690@gmail.com',
                'sexo'             => 'M',
                'password'         => bcrypt('@daniel'),
                'id_rol_sistema'   => 2,
            ],
            [
                'id'               => 2,
                'uuid'            => '521520',
                'nombre'           => 'arturo',
                'apellido_paterno' => 'alvarez',
                'apellido_materno' => 'rayon',
                'telefono'         => '7221982876',
                'sexo'             => 'M',
                'email'            => 'al221811722@gmail.com',
                'password'         => bcrypt('@arturo'),
                'id_rol_sistema'   => 2,
            ],
            [
                'id'               => 3,
                'uuid'           => '957814',
                'nombre'           => 'azucena',
                'apellido_paterno' => 'ortigoza',
                'apellido_materno' => 'gonzalez',
                'sexo'              => 'F',
                'telefono'         => '7221982924',
                'email'            => 'al221810625@gmail.com',
                'password'         => bcrypt('@azucena'),
                'id_rol_sistema'   => 2,
            ],
            [
                'id'               => 11,
                'uuid'             => '324020',
                'nombre'           => 'admin',
                'apellido_paterno' => 'admin',
                'apellido_materno' => 'admin',
                'telefono'         => '7224251651',
                'email'            => 'al222010638@gmail.com',
                'sexo'             => 'M',
                'password'         => bcrypt('@12345'),
                'id_rol_sistema'   => 2,
            ],
            // usuarios para el administrador daniel
            [
                'id'               => 4,
                'uuid'            => '123563',
                'nombre'           => 'Angelo',
                'apellido_paterno' => 'Rosales',
                'apellido_materno' => 'Gomez',
                'telefono'         => '728198324',
                'sexo'              => 'NB',
                'email'            => 'angelo1823@gmail.com',
                'password'         => bcrypt('@angelo'),
                'id_rol_sistema'   => 3,
            ],
            [
                'id'               => 5,
                'uuid'             => '139751',
                'nombre'           => 'Ruben',
                'apellido_paterno' => 'Roman',
                'apellido_materno' => 'Romano',
                'telefono'         => '7323832486',
                'email'            => 'rubene1823@gmail.com',
                'sexo'              => 'NB',
                'password'         => bcrypt('@ruben'),
                'id_rol_sistema'   => 3,
            ],
            [
                'id'               => 10,
                'uuid'             => '204194',
                'nombre'           => 'Marcos',
                'apellido_paterno' => 'Sanbueza',
                'apellido_materno' => 'Romano',
                'telefono'         => '7323832126',
                'email'            => 'marco321@gmail.com',
                'sexo'              => 'M',
                'password'         => bcrypt('@marco'),
                'id_rol_sistema'   => 3,
            ],

            // usuarios para el administrador arturo

            [
                'id'               => 6,
                'uuid'             => '315684',
                'nombre'           => 'Emiliano',
                'apellido_paterno' => 'Chavez',
                'apellido_materno' => 'Jimenez',
                'telefono'         => '727648324',
                'email'            => 'emilianodc@gmail.com',
                'sexo'              => 'F',
                'password'         => bcrypt('@emiliano'),
                'id_rol_sistema'   => 3,
            ],
            [
                'id'               => 7,
                'uuid'              => '315735',
                'nombre'           => 'Ruben',
                'apellido_paterno' => 'Roman',
                'apellido_materno' => 'Romano',
                'telefono'         => '7323832486',
                'email'            => 'Roman32@gmail.com',
                'sexo'              => 'M',
                'password'         => bcrypt('@ruben'),
                'id_rol_sistema'   => 3,
            ],

            // usuarios para el administrador azucena

            [
                'id'               => 8,
                'uuid'            => '135724',
                'nombre'           => 'Raul',
                'apellido_paterno' => 'Alonso',
                'apellido_materno' => 'Jimenez',
                'telefono'         => '737648314',
                'email'            => 'alonso12@gmail.com',
                'sexo'              => 'M',
                'password'         => bcrypt('@alonso'),
                'id_rol_sistema'   => 3,
            ],
            [
                'id'               => 9,
                'uuid'             => '436835',
                'nombre'           => 'Pedro',
                'apellido_paterno' => 'Ramirez',
                'apellido_materno' => 'Luan',
                'telefono'         => '7322732486',
                'email'            => 'pedro93@gmail.com',
                'sexo'              => 'M',
                'password'         => bcrypt('@pedro'),
                'id_rol_sistema'   => 3,
            ]



        ]);
    }
}
