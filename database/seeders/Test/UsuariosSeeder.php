<?php

namespace Database\Seeders\Test;

use App\Models\Usuarios;
use Illuminate\Database\Seeder;

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

        Usuarios::insert([
            [
                'id'               => 1,
                'nombre'           => 'Benjamín',
                'apellido_paterno' => 'Olvera',
                'apellido_materno' => 'Rosales',
                'telefono'         => '7291455410',
                'email'            => 'benjaminolverarosales@gmail.com',
                'password'         => bcrypt('benjamin123'),
                'id_rol_sistema'   => 1,
            ],
            [ 
                #Administrador de empresa
                'id'               => 2,
                'nombre'           => 'Emanuel',
                'apellido_paterno' => 'González',
                'apellido_materno' => 'Esquivel',
                'telefono'         => '7222252553',
                'email'            => 'emanuel@humanit.mx',
                'password'         => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'id_rol_sistema'   => 2,
            ],
        ]);

        /* Usuarios::factory(50)->create(); */
    }
}
