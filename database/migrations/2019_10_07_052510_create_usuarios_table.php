<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->string('id_usuario')->primary();
            $table->string('documento');
            $table->string('nombre_usuario');
            $table->string('apellido_usuario');
            $table->string('telefono');
            $table->integer('id_tipo_usuario');
            $table->integer('id_rol');
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
        Schema::dropIfExists('usuarios');
    }
}
