<?php

namespace Database\Seeders;

use App\Models\Centros;
use Illuminate\Database\Seeder;

class CentrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Centros::truncate();

        Centros::insert([
            [
                'id' => '1',
                'id_empresa' => '1',
                'nombre' => 'centro fitness',
                'email' => 'centro@gmail.com',
                'telefono' => '7223186743', 
                'id_ciudad' => '1',
                'direccion' => 'miguel hidalgo',
                'id_tipo_centro' => '2',
                'website' => 'http://centro.com.mx',
                'fb_page' => 'http://facebook/centro-fitness.com.mx',
                'status' => '1'

            ],
            [
                'id' => '2',
                'id_empresa' => '1',
                'nombre' => 'fitness',
                'email' => 'fitness@gmail.com',
                'telefono' => '7223198501', 
                'id_ciudad' => '1',
                'direccion' => 'sanantonio',
                'id_tipo_centro' => '1',
                'website' => 'http://fitness.com.mx',
                'fb_page' => 'http://facebook/fitness.com.mx',
                'status' => '1'

            ],
            //para el usuario 2
            [
                'id' => '3',
                'id_empresa' => '2',
                'nombre' => 'cross fit',
                'email' => 'centro@gmail.com',
                'telefono' => '7233198101', 
                'id_ciudad' => '1',
                'direccion' => 'miguel hidalgo',
                'id_tipo_centro' => '1',
                'website' => 'http://centro.com.mx',
                'fb_page' => 'http://facebook/cross-fitness.com.mx',
                'status' => '1'

            ],
            [
                'id' => '4',
                'id_empresa' => '2',
                'nombre' => 'albergue fit',
                'email' => 'albergue@gmail.com',
                'telefono' => '7123194509', 
                'id_ciudad' => '1',
                'direccion' => 'av. la luz',
                'id_tipo_centro' => '2',
                'website' => 'http://albergue.com.mx',
                'fb_page' => 'http://facebook/albergue.com.mx',
                'status' => '1'

            ],
             //para el usuario 3
            [
                'id' => '5',
                'id_empresa' => '3',
                'nombre' => 'supra frayer',
                'email' => 'supra@gmail.com',
                'telefono' => '7223457401', 
                'id_ciudad' => '3',
                'direccion' => 'matamoros',
                'id_tipo_centro' => '2',
                'website' => 'http://supra.com.mx',
                'fb_page' => 'http://facebook/supra-frayer.com.mx',
                'status' => '1'

            ],
            [
                'id' => '6',
                'id_empresa' => '3',
                'nombre' => 'malecon fit',
                'email' => 'malecon@gmail.com',
                'telefono' => '7243198402', 
                'id_ciudad' => '6',
                'direccion' => 'miguel hidalgo',
                'id_tipo_centro' => '1',
                'website' => 'http://malecon.com.mx',
                'fb_page' => 'http://facebook/malecon-fitness.com.mx',
                'status' => '1'

            ],
          

        ]);
    }
}
