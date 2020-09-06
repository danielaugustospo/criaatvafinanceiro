<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVerba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verba', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('idFormaPagamento');
            $table->string('dataPagamento');
            $table->string('descricaoVerba');
            $table->string('dataEmissao');
            $table->string('valorVerba');
            $table->string('pagamentoVerba');
            $table->string('contaVerba');
            $table->string('registroVerba');
            $table->string('emissaoVerba');
            $table->string('nfVerba');
            $table->string('valorTotalVerba');
            $table->string('idOSVerba');

            $table->boolean('ativoVerba');
            $table->boolean('excluidoVerba');


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
        Schema::dropIfExists('verba');
    }
}
