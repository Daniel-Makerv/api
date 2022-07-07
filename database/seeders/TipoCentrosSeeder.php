<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoCentros;


class TipoCentrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoCentros::truncate();
        TipoCentros::insert([
           [
            'id' => '1',
            'tipo_centro' => 'cross'.' afiliado',
            'status' => '1'
           ],
           [
            'id' => '2',
           'tipo_centro' => 'cross no'.' afiliado',
            'status' => '1'
           ],
           [
            'id' => '3',
         'tipo_centro' => 'centro de'.' fitness',
            'status' => '1'
           ],
           
        ]);
        
    }
}
