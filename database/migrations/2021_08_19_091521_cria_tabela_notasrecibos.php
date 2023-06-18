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
        Schema::create('notasrecibos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dtemissao', 191)->nullable(false);
            $table->string('nfrecibo', 191)->nullable();
            $table->string('idOS', 191)->nullable();
            $table->string('valorNfRecibo', 191)->nullable();
            $table->string('idaliquota', 191)->nullable();
            $table->string('tipoaliquota', 191)->nullable();
            $table->string('valorimposto', 191)->nullable();
            $table->string('dtRecebimento', 191)->nullable();
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
