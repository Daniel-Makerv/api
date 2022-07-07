<?php

namespace Database\Seeders;

use App\Models\RolesSistema;
use Illuminate\Database\Seeder;

class RolesSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolesSistema::truncate();
        
        RolesSistema::insert([
            [
                'id'     => 1,
                'nombre' => 'Root'
            ],
            [
                'id'     => 2,
                'nombre' => 'Empresa'
            ],
            [
                'id'     => 3,
                'nombre' => 'Centro'
            ],
            [
                'id'     => 4,
                'nombre' => 'Usuario'
            ]
        ]);
    }
}
