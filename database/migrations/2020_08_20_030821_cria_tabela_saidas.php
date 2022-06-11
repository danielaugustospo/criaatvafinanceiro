<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaSaidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('saidas', function (Blueprint $table) {
            $table->bigincrements('id');

            // $table->string('nomesaida');
            $table->string('codbarras');
            $table->string('descricaosaida')->nullable();


            $table->unsignedBigInteger('idbenspatrimoniais');

            $table->boolean('excluidosaida')->default('0');

            $table->string('portador');
            $table->string('ordemdeservico')->nullable();
            $table->string('datapararetirada')->nullable();
            $table->string('dataretirada')->nullable();
            $table->string('datapararetorno')->nullable();
            $table->string('ocorrencia')->nullable();

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
        Schema::dropIfExists('saidas');

    }
}
