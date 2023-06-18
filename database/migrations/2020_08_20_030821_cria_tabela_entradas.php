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
        Schema::create('entradas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codbarras', 191)->nullable(false);
            $table->string('descricaoentrada', 191)->nullable();
            $table->string('qtdeEntrada', 191)->default('0')->nullable(false);
            $table->unsignedBigInteger('idbenspatrimoniais')->nullable();
            $table->unsignedTinyInteger('valorunitarioentrada')->default(0)->nullable(false);
            $table->string('dtdevolucao', 191)->nullable();
            $table->string('quemdevolveu', 191)->nullable();
            $table->string('ocorrenciadevolucao', 191)->nullable();
            $table->unsignedTinyInteger('excluidoentrada')->default(0)->nullable(false);
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
