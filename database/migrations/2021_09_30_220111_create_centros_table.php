<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empresa')->constrained('empresas', 'id')->nullable();
            $table->string('nombre')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('telefono')->nullable();
            $table->foreignId('id_ciudad')->constrained('ciudades', 'id')->nullable();
            $table->string('direccion')->nullable();
            $table->foreignId('id_tipo_centro')->constrained('tipo_centros', 'id')->nullable();
            $table->string('website')->nullable();
            //$table->foreignId('id_zona_horaria')->constrained('zona_horaria', 'id');
            $table->string('fb_page')->nullable();
            $table->string('logo_image')->nullable();
            $table->boolean('status')->default(1)->nullable();
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
        Schema::dropIfExists('centros');
    }
}
