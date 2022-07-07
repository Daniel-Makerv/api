<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_clases', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_programa')->constrained('programas', 'id');
            // $table->foreignId('id_coach')->constrained('personal', 'id');
            // $table->string('limite_reservas')->nullable();
            // $table->boolean('contar_reserva')->default(0)->nullable();
            // $table->string('hora_inicio');
            // $table->string('hora_fin');
            // // $table->foreignId('id_sala')->constrained('asignacion_clases', 'id');
            // $table->boolean('restringir_disp')->default(0)->nullable();
            // $table->boolean('dias_semana')->default(0)->nullable();
            // $table->timestamp('created_at')->useCurrent();
            // $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_clases');
    }
}
