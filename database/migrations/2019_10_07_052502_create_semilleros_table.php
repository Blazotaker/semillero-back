<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemillerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semilleros', function (Blueprint $table) {
            $table->bigIncrements('id_semillero');
            $table->string('semillero',100);
            $table->string('objetivo',1000);
            $table->string('descripcion',1000);
            $table->unsignedBigInteger('id_grupo');
            $table->foreign('id_grupo')->references('id_grupo')->on('grupos');
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
        Schema::dropIfExists('semilleros');
    }
}
