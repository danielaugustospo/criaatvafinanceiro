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

            $table->string('codbarras');
            $table->string('descricaoentrada')->nullable();
            $table->string('qtdeEntrada')->default('0');
            
            $table->unsignedBigInteger('idbenspatrimoniais')->nullable();
            
            $table->boolean('valorunitarioentrada')->default('0');
            
            $table->string('dtdevolucao')->nullable();
            $table->string('quemdevolveu')->nullable();
            $table->string('ocorrenciadevolucao')->nullable();

            $table->boolean('excluidoentrada')->default('0');

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
