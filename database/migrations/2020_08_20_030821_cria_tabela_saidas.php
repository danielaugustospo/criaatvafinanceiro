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

            $table->string('nomesaida');
            $table->string('descricaosaida');


            $table->unsignedBigInteger('idbenspatrimoniais');
            $table->foreign('idbenspatrimoniais')
            ->references('id')
            ->on('bens_patrimoniais')
            ->onDelete('cascade');

            $table->boolean('ativadosaida');
            $table->boolean('excluidosaida');

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
    }
}
