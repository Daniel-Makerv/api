<?php

namespace Database\Seeders;

use App\Models\AsignacionClases;
use Illuminate\Database\Seeder;

class AsignacionClasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AsignacionClases::truncate();
    }
}
