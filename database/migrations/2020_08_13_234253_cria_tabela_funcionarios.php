<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaFuncionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nomeFuncionario');
            $table->string('cepFuncionario');
            $table->string('enderecoFuncionario');
            $table->string('bairroFuncionario');
            $table->string('cidadeFuncionario');
            $table->string('ufFuncionario');
            $table->string('celularFuncionario');
            $table->string('telresidenciaFuncionario');
            $table->string('contatoemergenciaFuncionario');
            $table->string('emailFuncionario');
            $table->string('redesocialFuncionario');
            $table->string('facebookFuncionario');
            $table->string('telegramFuncionario');
            $table->string('cpfFuncionario');
            $table->string('rgFuncionario');
            $table->string('orgaoRGFuncionario');
            $table->string('expedicaoRGFuncionario');
            $table->string('tituloFuncionario');
            $table->string('maeFuncionario');
            $table->string('paiFuncionario');
            $table->string('profissaoFuncionario');
            $table->string('cargoEmpresaFuncionario');
            $table->string('tipocontratoFuncionario');
            $table->string('grauescolaridadeFuncionario');
            $table->string('descformacaoFuncionario');
            $table->string('certficFuncionario');
            $table->string('uncertificadoraFuncionario');
            $table->string('anocertificacaoFuncionario');
            $table->string('contacorrenteFuncionario');
            $table->string('bancoFuncionario');
            $table->string('nrcontaFuncionario');
            $table->string('agenciaFuncionario');
            $table->string('nomefavorecidoFuncionario');
            $table->string('cpffavorecidoFuncionario');
            $table->string('contacorrentefavorecidoFuncionario');
            $table->string('bancofavorecidoFuncionario');
            $table->string('nrcontafavorecidoFuncionario');
            $table->string('agenciafavorecidoFuncionario');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['cpfFuncionario']);
            $table->unique(['cpfFuncionario']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
