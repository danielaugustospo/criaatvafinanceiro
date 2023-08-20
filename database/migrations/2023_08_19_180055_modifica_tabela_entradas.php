<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificaTabelaEntradas extends Migration
{
    public function up()
    {
        Schema::dropIfExists('entradas');
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->string('descricaoentrada', 191)->nullable();
            $table->unsignedBigInteger('id_estoque')->nullable();
            $table->string('quantidade_entrada', 191)->default('0');
            $table->unsignedTinyInteger('valorunitarioentrada')->default('0');
            $table->string('dtdevolucao', 191)->nullable();
            $table->string('quemdevolveu', 191)->nullable();
            $table->string('ocorrenciadevolucao', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_estoque')->references('id')->on('estoque');
        });
    }

    public function down()
    {
        Schema::dropIfExists('entradas');
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
}
