<?php

namespace Database\Seeders;

use App\Models\RolesPersonal;
use Illuminate\Database\Seeder;

class RolesPersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolesPersonal::truncate();

        RolesPersonal::insert([
            [
                'id'             => 1,
                'nombre'         => 'Administrador de empresa',
                'id_rol_sistema' => 2
            ],
            [
                'id'             => 2,
                'nombre'         => 'Auxiliar administrador de empresa',
                'id_rol_sistema' => 2
            ],
            [
                'id'             => 3,
                'nombre'         => 'Administrador de centro',
                'id_rol_sistema' => 3
            ],
            [
                'id'             => 4,
                'nombre'         => 'Auxiliar administrador de centro',
                'id_rol_sistema' => 3
            ],
            [
                'id'             => 5,
                'nombre'         => 'Staff Administrativo',
                'id_rol_sistema' => 3
            ],
            [
                'id'             => 6,
                'nombre'         => 'Staff operativo',
                'id_rol_sistema' => 3
            ],
            [
                'id'             => 7,
                'nombre'         => 'Coach',
                'id_rol_sistema' => 3
            ],
            [
                'id'             => 8,
                'nombre'         => 'Atleta',
                'id_rol_sistema' => 4
            ]
        ]);
    }
}
