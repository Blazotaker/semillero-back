<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes', function (Blueprint $table) {
            $table->bigIncrements('id_integrante');
            $table->integer('id_usuario');
            $table->unsignedBigInteger('id_semillero');
            $table->foreign('id_semillero')->references('id_semillero')->on('semilleros');
            $table->unsignedBigInteger('id_periodo');
            $table->foreign('id_periodo')->references('id_periodo')->on('periodos');
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
        Schema::dropIfExists('integrantes');
    }
}
