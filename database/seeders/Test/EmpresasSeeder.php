<?php

namespace Database\Seeders\Test;

use App\Models\Empresas;
use Illuminate\Database\Seeder;

class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresas::truncate();

        Empresas::create([
            'id'              => 1,
            'nombre_fiscal'   => 'Deportivos SA',
            'id_fiscal'       => 'DES29172398',
            'email'           => 'contacto@deportivosa.com',
            'telefono'        => '7291455410',
            'direccion_legal' => 'Centenario #4, San Pedro Totoltepec',
            'ciudad'          => 'Toluca',
            'provincia'       => 'Estado de México',
            'pais'            => 'México'
        ]);
    }
}
