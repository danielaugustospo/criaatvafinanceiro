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
            $table->string('idClienteOrdemdeServico', 191)->nullable(false);
            $table->timestamp('dataVendaOrdemdeServico')->nullable();
            $table->string('valorProjetoOrdemdeServico', 191)->default('0.0')->nullable(false);
            $table->string('valorOrdemdeServico', 191)->default('0.0')->nullable(false);
            $table->string('dataOrdemdeServico', 191)->nullable();
            $table->string('fatorR', 191)->nullable();
            $table->string('eventoOrdemdeServico', 191)->nullable(false);
            $table->string('servicoOrdemdeServico', 191)->nullable();
            $table->string('obsOrdemdeServico', 191)->nullable();
            $table->string('dataCriacaoOrdemdeServico', 191)->nullable();
            $table->string('dataExclusaoOrdemdeServico', 191)->nullable();
            $table->tinyInteger('ativoOrdemdeServico')->default(1)->nullable(false);
            $table->tinyInteger('excluidoOrdemdeServico')->default(0)->nullable(false);
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
