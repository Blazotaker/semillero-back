<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_grados', function (Blueprint $table) {
            $table->bigIncrements('id_proyecto_grado');
            $table->string('proyecto_grado',100);
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
        Schema::dropIfExists('proyecto_grados');
    }
}
