<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('estoques', function (Blueprint $table) {
            $table->bigincrements('id');

            $table->string('nomeestoque');
            $table->string('descricaoestoque');


            $table->unsignedBigInteger('idbenspatrimoniais');
            $table->foreign('idbenspatrimoniais')
            ->references('id')
            ->on('bens_patrimoniais')
            ->onDelete('cascade');

            $table->boolean('ativadoestoque');
            $table->boolean('excluidoestoque');

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
        Schema::dropIfExists('estoques');

    }
}
