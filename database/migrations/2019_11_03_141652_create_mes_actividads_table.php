<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mes_actividades', function (Blueprint $table) {
            $table->bigIncrements('id_mes_actividad');
            $table->unsignedBigInteger('id_actividad');
            $table->foreign('id_actividad')->references('id_actividad')->on('actividades');
            $table->unsignedBigInteger('id_mes');
            $table->foreign('id_mes')->references('id_mes')->on('meses');
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
        Schema::dropIfExists('mes_actividads');
    }
}
