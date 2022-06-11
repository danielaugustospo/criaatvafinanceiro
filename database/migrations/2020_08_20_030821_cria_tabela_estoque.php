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
        Schema::create('estoque', function (Blueprint $table) {
            $table->bigincrements('id');

            $table->string('codbarras');
            $table->string('nomematerial');
            $table->string('descricao')->nullable();

            $table->unsignedBigInteger('idbenspatrimoniais');

            $table->boolean('ativadoestoque')->default('1');
            $table->boolean('excluidoestoque')->default('0');

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
        Schema::dropIfExists('estoque');

    }
}
