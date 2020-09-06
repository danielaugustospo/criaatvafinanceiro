<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrdemdeServico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordemdeservico', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nomeFormaPagamento');
            $table->string('idClienteOrdemdeServico');
            $table->string('dataVendaOrdemdeServico');
            $table->string('valorTotalOrdemdeServico');
            $table->string('valorProjetoOrdemdeServico');
            $table->string('valorOrdemdeServico');
            $table->string('dataOrdemdeServico');
            $table->string('clienteOrdemdeServico');
            $table->string('eventoOrdemdeServico');
            $table->string('servicoOrdemdeServico');
            $table->string('obsOrdemdeServico');
            $table->string('dataCriacaoOrdemdeServico');
            $table->string('dataExclusaoOrdemdeServico');

            $table->boolean('ativoOrdemdeServico');
            $table->boolean('excluidoOrdemdeServico');


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
        Schema::dropIfExists('ordemdeservico');
    }
}
