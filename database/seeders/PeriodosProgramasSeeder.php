<?php

namespace Database\Seeders;

use App\Models\PeriodosProgramas;
use Illuminate\Database\Seeder;

class PeriodosProgramasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PeriodosProgramas::truncate();

        PeriodosProgramas::insert([
            // [
            //     'id' => '1',
            //     'tipo' => 'Día',
            //     'status' => '1'
            //    ],
            //    [
            //     'id' => '2',
            //     'tipo' => 'Semana',
            //     'status' => '1'
            //    ],
            //    [
            //     'id' => '3',
            //     'tipo' => 'Día',
            //     'status' => '1'
            //    ],
        ]);
    }
}
