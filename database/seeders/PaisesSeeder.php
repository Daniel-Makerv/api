<?php

namespace Database\Seeders;

use App\Models\Paises;
use Illuminate\Database\Seeder;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paises::truncate();

        Paises::insert([
            [ 'nombre' => 'México', 'codigo' => '+52' ],
        ]);
    }
}
