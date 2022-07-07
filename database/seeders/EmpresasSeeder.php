<?php

namespace Database\Seeders;

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
        Empresas::insert([
           [
            'id' => 1,
            'nombre_fiscal' => 'fitnest random',
            'id_fiscal' => 'XAXX0101010002',
            'email' => 'fitnest-random@gmail.com',        
            'telefono' => '7223491801',
            'id_ciudad' => '5',
            'direccion_legal' => 'de la rosa',
            'renovacion_automatica_plan' => '1',
            'status' => '1',
           ],
           [
            'id' => 2,
            'nombre_fiscal' => 'fitnest two',
            'id_fiscal' => 'XAXX0101010001',
            'email' => '@gmail.com',           
            'telefono' => '7223491802',
            'id_ciudad' => '15',
            'direccion_legal' => 'de la rosa',
            'renovacion_automatica_plan' => '1',
            'status' => '1',
           ],
           [
            'id' => 3,
            'nombre_fiscal' => 'fitnest tree',
            'id_fiscal' => 'XAXX0101010003',
            'email' => '@gmail.com',   
            'telefono' => '7223491803',
            'id_ciudad' => '8',
            'direccion_legal' => 'de la rosa',
            'renovacion_automatica_plan' => '1',
            'status' => '1',
           ]


        ]);
    }
}
