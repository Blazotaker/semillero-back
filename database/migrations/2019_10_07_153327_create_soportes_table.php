<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soportes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('soporte',50);
            $table->string('vinculo',255);
            $table->unsignedBigInteger('id_institucional')->nullable();
            $table->foreign('id_institucional')->references('id_institucional')->on('institucionales');
            $table->unsignedBigInteger('id_actividad')->nullable();
            $table->foreign('id_actividad')->references('id_actividad')->on('actividades');
            $table->unsignedBigInteger('id_proyecto')->nullable();
            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyectos');
            $table->unsignedBigInteger('id_proyecto_grado')->nullable();
            $table->foreign('id_proyecto_grado')->references('id_proyecto_grado')->on('proyecto_grados');
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
        Schema::dropIfExists('soportes');
    }
}
