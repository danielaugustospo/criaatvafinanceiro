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
        Schema::create('saidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codbarras', 191)->nullable();
            $table->string('descricaosaida', 191)->nullable();
            $table->unsignedBigInteger('idbenspatrimoniais');
            $table->boolean('excluidosaida')->default(false);
            $table->string('portador', 191);
            $table->string('ordemdeservico', 191)->nullable();
            $table->string('datapararetirada', 191)->nullable();
            $table->string('dataretirada', 191)->nullable();
            $table->string('datapararetorno', 191)->nullable();
            $table->string('ocorrencia', 191)->nullable();
            $table->timestamps();

            $table->foreign('idbenspatrimoniais')->references('id')->on('benspatrimoniais');
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
