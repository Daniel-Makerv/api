<?php

namespace Database\Seeders;

use App\Models\Paises;
use App\Models\Provincias;
use Illuminate\Database\Seeder;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincias::truncate();

        if ($México = Paises::query()->where('nombre', 'México')->first()) {
            $México->provincias()->createMany([
                ['nombre' => 'Baja California'],
                ['nombre' => 'Ciudad de méxico'],
                ['nombre' => 'Estado de méxico'],
                ['nombre' => 'Nuevo León'],
                ['nombre' => 'Querétaro'],
            ]);
        }
    }
}
