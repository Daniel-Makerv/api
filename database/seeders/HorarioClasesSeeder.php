<?php

namespace Database\Seeders;

use App\Models\HorarioClases;
use Illuminate\Database\Seeder;

class HorarioClasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HorarioClases::truncate();
    }
}
