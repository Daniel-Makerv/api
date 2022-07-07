<?php

namespace Database\Seeders\Test;

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

        /*      
        Centros::create([
            'id'            => 1,
            'id_empresa'    => 1,
            'nombre'        => 'Ultron Gym',
            'email'         => 'contacto-ultrongym@deportivos.com',
            'telefono'      => '7291455410',
            'direccion'     => 'Manuel Sandoval Vallarta #4, Vértice',
            'ciudad'        => 'Toluca',
            'provincia'     => 'Estado de México',
            'pais'          => 'México',
            'website'       => null,
            'fb_page'       => null,
        ]); 
        */
    }
}
