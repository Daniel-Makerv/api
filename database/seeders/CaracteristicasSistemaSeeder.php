<?php

namespace Database\Seeders;

use App\Models\CaracteristicasSistema;
use Illuminate\Database\Seeder;

class CaracteristicasSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CaracteristicasSistema::truncate();

        CaracteristicasSistema::insert([
            [
                'id'     => 1,
                'nombre' => 'Auxiliares administradores de empresa',
                'uuid'   => 'serv-aux-admin-empresa',
            ],
            [
                'id'     => 2,
                'nombre' => 'Centros',
                'uuid'   => 'serv-centros'
            ],
            [
                'id'     => 3,
                'nombre' => 'Auxiliares administradores por centro',
                'uuid'   => 'serv-aux-admin-centro',
            ],
            [
                'id'     => 4,
                'nombre' => 'Clientes por centro',
                'uuid'   => 'serv-clientes-centro',
            ],
            [
                'id'     => 5,
                'nombre' => 'Clases y reservas',
                'uuid'   => 'serv-clases-reservas',
            ],
            [
                'id'     => 6,
                'nombre' => 'App Móvil',
                'uuid'   => 'serv-app-movil',
            ],
            [
                'id'     => 7,
                'nombre' => 'Administración de Workouts',
                'uuid'   => 'serv-admin-workout',
            ],
            [
                'id'     => 8,
                'nombre' => 'Inteligencia del negocio',
                'uuid'   => 'serv-intel-negocio',
            ],
            [
                'id'     => 9,
                'nombre' => 'Automatización de procesos',
                'uuid'   => 'serv-auto-procesos',
            ],
            [
                'id'     => 10,
                'nombre' => 'Venta de productos',
                'uuid'   => 'serv-venta-productos',
            ],
            [
                'id'     => 11,
                'nombre' => 'Servicio de nutriología',
                'uuid'   => 'serv-nutriologia',
            ],
            [
                'id'     => 12,
                'nombre' => 'Servicio de fisioterapia',
                'uuid'   => 'serv-fisioterapia',
            ],
        ]);
    }
}
