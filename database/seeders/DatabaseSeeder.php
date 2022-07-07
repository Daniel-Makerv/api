<?php

namespace Database\Seeders;

use App\Models\MetaCaracteristicasPlanes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call([
            PaisesSeeder::class,
            ProvinciasSeeder::class,
            CiudadesSeeder::class,
            RolesSistemaSeeder::class,
            UsuariosSeeder::class,
            RolesPersonalSeeder::class,
           EmpresasSeeder::class,
            CentrosSeeder::class,
            PersonalSeeder::class,
            ClasesSeeder::class,
            AsignacionClasesSeeder::class,
            HorarioClasesSeeder::class,
            PlanesSeeder::class,
            CaracteristicasSistemaSeeder::class,
            CaracteristicasPlanesSeeder::class,
            MetaCaracteristicasPlanesSeeder::class,
            AsignacionPlanesSeeder::class,
            TabsSeeder::class,
            TipoCentrosSeeder::class,
            DiasClasesSeeder::class,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
