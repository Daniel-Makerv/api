<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaCaracteristicasPlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_caracteristicas_planes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_caracteristica_plan')->constrained('caracteristicas_planes', 'id');
            $table->string('key');
            $table->string('value')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->unique(['id_caracteristica_plan', 'key'], 'meta_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_caracteristicas_planes');
    }
}
