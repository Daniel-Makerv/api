<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_centro')->constrained('centros', 'id')->nullable();
            $table->foreignId('id_programa')->constrained('programas', 'id')->nullable();
            $table->foreignId('id_coach')->constrained('personal', 'id')->nullable();
            $table->foreignId('id_sala')->constrained('salas', 'id')->nullable();
            $table->string('limite_reservas')->nullable();
            $table->boolean('contar_reserva')->default(0)->nullable();
            $table->string('hora_inicio')->nullable();
            $table->string('hora_fin')->nullable();
            $table->boolean('restringir_disp')->default(0)->nullable();
            $table->boolean('status')->default(0)->nullable();
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
        Schema::dropIfExists('clases');
    }
}
