<?php

namespace Database\Seeders;

use App\Models\Tabs;
use Illuminate\Database\Seeder;

class TabsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tabs::truncate();

        #Empresa [Administrador]
        Tabs::insert([
            [
                'id_rol_personal' => 1,
                'icon'            => null,
                'label'           => 'Planes',
                'route'           => 'empresa.planes',
                'visible'         => 0
            ],
            [
                'id_rol_personal' => 1,
                'icon'            => 'cog',
                'label'           => 'Configuración',
                'route'           => 'empresa.configuracion',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 1,
                'icon'            => 'badge-account-horizontal',
                'label'           => 'Personal',
                'route'           => 'empresa.personal',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 1,
                'icon'            => 'domain',
                'label'           => 'Centros',
                'route'           => 'empresa.centros',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 1,
                'icon'            => 'currency-usd',
                'label'           => 'Pagos',
                'route'           => 'empresa.pagos',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 1,
                'icon'            => 'certificate',
                'label'           => 'Facturación',
                'route'           => 'empresa.facturacion',
                'visible'         => 1
            ],
        ]);

        #Empresa [Auxiliar Administrador]
        Tabs::insert([
            [
                'id_rol_personal' => 2,
                'icon'            => null,
                'label'           => 'Planes',
                'route'           => 'empresa.planes',
                'visible'         => 0
            ],
            [
                'id_rol_personal' => 2,
                'icon'            => 'cog',
                'label'           => 'Configuración',
                'route'           => 'empresa.configuracion',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 2,
                'icon'            => 'badge-account-horizontal',
                'label'           => 'Personal',
                'route'           => 'empresa.personal',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 2,
                'icon'            => 'domain',
                'label'           => 'Centros',
                'route'           => 'empresa.centros',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 2,
                'icon'            => 'currency-usd',
                'label'           => 'Pagos',
                'route'           => 'empresa.pagos',
                'visible'         => 1
            ],
        ]);

        #Centro [Administrador]
        Tabs::insert([
            [
                'id_rol_personal' => 3,
                'icon'            => 'cog',
                'label'           => 'Configuración',
                'route'           => 'centro.configuracion',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 3,
                'icon'            => 'badge-account-horizontal',
                'label'           => 'Personal',
                'route'           => 'centro.personal',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 3,
                'icon'            => 'account-group-outline',
                'label'           => 'Atletas',
                'route'           => 'centro.atletas',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 3,
                'icon'            => 'account-box-multiple-outline',
                'label'           => 'Salas',
                'route'           => 'centro.salas',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 3,
                'icon'            => 'domain',
                'label'           => 'Programas',
                'route'           => 'centro.programas',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 3,
                'icon'            => 'notebook-outline',
                'label'           => 'Clases',
                'route'           => 'centro.clases',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 3,
                'icon'            => 'ticket',
                'label'           => 'Reservas',
                'route'           => 'centro.reservas',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 3,
                'icon'            => 'calendar-month',
                'label'           => 'Calendario',
                'route'           => 'centro.calendario',
                'visible'         => 1
            ],
            //Rutas para el usuario atleta
            [
                'id_rol_personal' => 8,
                'icon'            => 'calendar-month',
                'label'           => 'Centros',
                'route'           => 'atleta.calendario',
                'visible'         => 1
            ],
            [
                'id_rol_personal' => 8,
                'icon'            => 'calendar-das',
                'label'           => 'Usuario',
                'route'           => 'atleta.calendarios',
                'visible'         => 1
            ],
          



        ]);
    }
}
