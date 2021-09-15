<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaNotasrecibos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notasrecibos', function (Blueprint $table) {
            $table->bigincrements('id');


            $table->string('dtemissao');
            $table->string('nfrecibo')->nullable();
            $table->string('idOS')->nullable();
            $table->string('valorNfRecibo')->nullable();
            $table->string('idaliquota')->nullable();
            $table->string('tipoaliquota')->nullable();
            $table->string('valorimposto')->nullable();
            $table->string('dtRecebimento')->nullable();

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
        Schema::dropIfExists('notasrecibos');

    }
}
