<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leitos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->string('o2');
            $table->string('tipo_leito');
            $table->longText('infos')->nullable();
            $table->unsignedBigInteger('id_upa');
            $table->foreign('id_upa')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leitos');
    }
}
