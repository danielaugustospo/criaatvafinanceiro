<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('entradas', function (Blueprint $table) {
            $table->bigincrements('id');

            $table->string('descricaoentrada');
            $table->string('qtdeEntrada');


            $table->unsignedBigInteger('idbenspatrimoniais');
            $table->foreign('idbenspatrimoniais')
            ->references('id')
            ->on('benspatrimoniais')
            ->onDelete('cascade');

            $table->boolean('valorunitarioentrada');

            $table->boolean('ativoentrada');
            $table->boolean('excluidoentrada');

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
        //
        Schema::dropIfExists('entradas');

    }
}
