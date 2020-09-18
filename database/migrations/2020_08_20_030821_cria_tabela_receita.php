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


            $table->string('idformapagamentoreceita');
            $table->string('datapagamentoreceita');
            $table->string('dataemissaoreceita');
            $table->string('valorreceita');
            $table->string('pagoreceita');
            $table->string('contareceita');
            $table->string('registroreceita');
            $table->string('emissaoreceita');
            $table->string('nfreceita');
            $table->string('idosreceita');


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
