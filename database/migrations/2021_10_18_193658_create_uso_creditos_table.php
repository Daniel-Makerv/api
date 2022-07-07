<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsoCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uso_creditos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_creditos')->constrained('creditos', 'id');
            $table->bigInteger('cantidad');
            $table->timestamp('fecha_operacion')->useCurrent();
            $table->enum('operacion', [1,2]);
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
        Schema::dropIfExists('uso_creditos');
    }
}
