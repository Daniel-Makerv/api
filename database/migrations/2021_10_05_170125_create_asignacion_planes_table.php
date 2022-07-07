<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionPlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_planes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empresa')->constrained('empresas', 'id');
            $table->foreignId('id_plan')->constrained('planes', 'id');
            $table->float('pago', 9, 2);
            $table->timestamp('fecha_inicio')->useCurrent();
            $table->timestamp('fecha_fin');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_planes');
    }
}
