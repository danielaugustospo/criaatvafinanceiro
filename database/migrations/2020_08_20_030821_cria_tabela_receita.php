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
        //
        Schema::create('receita', function (Blueprint $table) {
            $table->bigincrements('id');

            $table->string('idosreceita')->nullable();
            $table->string('idclientereceita')->nullable();
            $table->string('idformapagamentoreceita');
            $table->string('datapagamentoreceita');
            $table->string('dataemissaoreceita')->nullable();
            $table->string('valorreceita');
            $table->string('pagoreceita');
            $table->string('contareceita');
            $table->string('descricaoreceita')->nullable();
            $table->string('registroreceita')->nullable();
            // $table->string('emissaoreceita');
            $table->string('nfreceita')->nullable();
            $table->string('ativoreceita')->default('1');
            $table->string('excluidoreceita')->default('0');


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
