<?php

namespace Database\Seeders\Test;

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
        Personal::truncate();

        #Empresas: 100
        Personal::insert([
            [
                #Administrador de empresa
                'id_empresa'      => 1,
                'id_usuario'      => 2,
                'id_rol_personal' => 1,
            ]
        ]);
    }
}
