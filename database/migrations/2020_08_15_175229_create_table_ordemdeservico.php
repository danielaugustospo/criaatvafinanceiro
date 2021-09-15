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

            // $table->string('nomeFormaPagamento');
            $table->string('idClienteOrdemdeServico');
            $table->timestamp('dataVendaOrdemdeServico')->nullable();
            $table->string('valorProjetoOrdemdeServico')->default('0.0');
            $table->string('valorOrdemdeServico')->default('0.0');
            $table->string('dataOrdemdeServico')->nullable();
            $table->string('fatorR')->nullable();
            $table->string('eventoOrdemdeServico');
            $table->string('servicoOrdemdeServico')->nullable();
            $table->string('obsOrdemdeServico')->nullable();
            $table->string('dataCriacaoOrdemdeServico')->nullable();
            $table->string('dataExclusaoOrdemdeServico')->nullable();

            $table->boolean('ativoOrdemdeServico')->default('1');
            $table->boolean('excluidoOrdemdeServico')->default('0');


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
