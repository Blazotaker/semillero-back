<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id_producto');
            $table->string('producto');
            $table->unsignedBigInteger('id_tipo_producto');
            $table->foreign('id_tipo_producto')->references('id_tipo_producto')->on('tipo_productos');
            $table->unsignedBigInteger('id_actividad')->nullable();
            $table->foreign('id_actividad')->references('id_actividad')->on('actividades');
            $table->unsignedBigInteger('id_proyecto')->nullable();
            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyectos');
            $table->unsignedBigInteger('id_soporte');
            $table->foreign('id_soporte')->references('id_soporte')->on('soportes');
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
        Schema::dropIfExists('productos');
    }
}
