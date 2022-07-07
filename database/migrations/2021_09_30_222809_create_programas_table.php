<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->foreignId('id_centro')->constrained('centros','id');
            $table->boolean('permitir_mas_reserva')->nullable()->default(0);
            $table->boolean('cancelar_fuera_plazo')->nullable()->default(0);
            $table->string('reservar_desde')->nullable();
            $table->string('opcion_reservar_desde')->nullable();
            $table->string('periodo_reservar_desde')->nullable();
            $table->string('reservar_hasta')->nullable();
            $table->string('opcion_reservar_hasta')->nullable();
            $table->string('periodo_reservar_hasta')->nullable();
            $table->string('cancelar_reserva')->nullable();
            $table->string('opcion_cancelar_reserva')->nullable();
            $table->string('periodo_cancelar_reserva')->nullable();
            $table->string('color')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programas');
    }
}
