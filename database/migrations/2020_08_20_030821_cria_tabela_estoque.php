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
        Schema::create('estoque', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codbarras', 191)->nullable(false);
            $table->string('nomematerial', 191)->nullable(false);
            $table->string('descricao', 191)->nullable();
            $table->unsignedBigInteger('idbenspatrimoniais')->nullable(false);
            $table->unsignedTinyInteger('ativadoestoque')->default(1)->nullable(false);
            $table->unsignedTinyInteger('excluidoestoque')->default(0)->nullable(false);
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
