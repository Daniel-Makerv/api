<?php

namespace Database\Seeders;

use App\Models\Planes;
use Illuminate\Database\Seeder;

class PlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Planes::truncate();

        Planes::insert([
            [   
                'id'          => 1,
                'imagen'      => 'basico.jpg',
                'nombre'      => 'Básico',
                'uuid'        => 'plan-basico',
                'descripcion' => 'Diseñado para centros deportivos que recién incursan, pero que creen en su potencial de crecimiento',
                'precio'      => 100,
                'calificacion'=> 3
            ],
            [
                'id'          => 2,
                'imagen'      => 'gold.jpg',
                'nombre'      => 'Gold',
                'uuid'        => 'plan-gold',
                'descripcion' => 'Diseñado para centros deportivos que ya están en curso y desean obtener un mejor rendimiento',
                'precio'      => 200,
                'calificacion'=> 3.5
            ],
            [
                'id'          => 3,
                'imagen'      => 'platino.jpg',
                'nombre'      => 'Platino',
                'uuid'        => 'plan-platino',
                'descripcion' => 'Diseñado para centros deportivos ya experimentados y preparados para el siguiente nivel',
                'precio'      => 300,
                'calificacion'=> 4
            ],
            [
                'id'          => 4,
                'imagen'      => 'ultra.jpg',
                'nombre'      => 'Ultra',
                'uuid'        => 'plan-ultra',
                'descripcion' => 'Diseñado para centros deportivos que quieren obtener todo el potencial de Ultra Cross.',
                'precio'      => 400,
                'calificacion'=> 5
            ],
        ]);
    }
}
