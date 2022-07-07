<?php

namespace Database\Seeders;

use App\Models\Clases;
use Illuminate\Database\Seeder;

class ClasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clases::truncate();
    }
}
