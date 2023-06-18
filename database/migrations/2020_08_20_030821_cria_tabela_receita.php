<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaReceita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receita', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idosreceita', 191)->nullable();
            $table->string('idclientereceita', 191)->nullable();
            $table->string('idformapagamentoreceita', 191)->nullable();
            $table->string('datapagamentoreceita', 191)->nullable();
            $table->string('dataemissaoreceita', 191)->nullable();
            $table->string('valorreceita', 191)->nullable();
            $table->string('pagoreceita', 191)->nullable();
            $table->string('contareceita', 191)->nullable();
            $table->string('descricaoreceita', 191)->nullable();
            $table->string('registroreceita', 191)->nullable();
            $table->string('nfreceita', 191)->nullable();
            $table->string('ativoreceita', 191)->default('1');
            $table->string('excluidoreceita', 191)->default('0');
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
        Schema::dropIfExists('receita');

    }
}
