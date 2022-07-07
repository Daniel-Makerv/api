<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empresa')->nullable()->constrained('empresas', 'id');
            $table->foreignId('id_centro')->nullable()->constrained('centros', 'id');
            $table->foreignId('id_usuario')->constrained('usuarios', 'id');
            $table->foreignId('id_rol_personal')->constrained('roles_personal', 'id');
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->unique(['id_empresa', 'id_centro', 'id_usuario'], 'unique_personal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal');
    }
}
