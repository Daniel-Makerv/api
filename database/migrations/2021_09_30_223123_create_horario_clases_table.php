<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_clases', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_programa')->constrained('asignacion_clases', 'id');
            // $table->foreignId('id_coach')->constrained('asignacion_clases', 'id');
            // $table->string('limite_reservas')->nullable();
            // $table->boolean('contar_reserva')->default(0)->nullable();

            // $table->string('fecha');
            // $table->string('hora_inicio');
            // $table->string('hora_fin');
            // $table->timestamp('created_at')->useCurrent();
            // $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // $table->unique(['id_asignacion_clase', 'fecha', 'hora_inicio', 'hora_fin'], 'unique_horario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_clases');
    }
}
