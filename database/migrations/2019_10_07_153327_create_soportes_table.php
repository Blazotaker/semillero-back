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
            $table->string('soporte');
            $table->string('vinculo');
            $table->integer('id_institucional')->nullable();
            $table->integer('id_actividad')->nullable();
            $table->integer('id_proyecto')->nullable();
            $table->integer('id_proyecto_grado')->nullable();
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
