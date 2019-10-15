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
            $table->string('semillero');
            $table->string('objetivo');
            $table->string('descripcion');
            $table->integer('id_grupo');
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
