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
            $table->string('nomeFuncionario', 191)->nullable(false);
            $table->string('cepFuncionario', 191)->nullable();
            $table->string('enderecoFuncionario', 191)->nullable();
            $table->string('bairroFuncionario', 191)->nullable();
            $table->string('cidadeFuncionario', 191)->nullable();
            $table->string('ufFuncionario', 191)->nullable();
            $table->string('celularFuncionario', 191)->nullable();
            $table->string('telresidenciaFuncionario', 191)->nullable();
            $table->string('contatoemergenciaFuncionario', 191)->nullable();
            $table->string('emailFuncionario', 191)->nullable();
            $table->string('redesocialFuncionario', 191)->nullable();
            $table->string('facebookFuncionario', 191)->nullable();
            $table->string('telegramFuncionario', 191)->nullable();
            $table->string('cpfFuncionario', 191)->nullable();
            $table->string('rgFuncionario', 191)->nullable();
            $table->string('orgaoRGFuncionario', 191)->nullable();
            $table->string('expedicaoRGFuncionario', 191)->nullable();
            $table->string('tituloFuncionario', 191)->nullable();
            $table->string('maeFuncionario', 191)->nullable();
            $table->string('paiFuncionario', 191)->nullable();
            $table->string('profissaoFuncionario', 191)->nullable();
            $table->string('cargoEmpresaFuncionario', 191)->nullable();
            $table->string('tipocontratoFuncionario', 191)->nullable();
            $table->string('grauescolaridadeFuncionario', 191)->nullable();
            $table->string('descformacaoFuncionario', 191)->nullable();
            $table->string('certficFuncionario', 191)->nullable();
            $table->string('uncertificadoraFuncionario', 191)->nullable();
            $table->string('anocertificacaoFuncionario', 191)->nullable();
            $table->string('contacorrenteFuncionario1', 191)->nullable();
            $table->string('bancoFuncionario1', 191)->nullable();
            $table->string('nrcontaFuncionario1', 191)->nullable();
            $table->string('agenciaFuncionario1', 191)->nullable();
            $table->string('chavePixFuncionario1', 191)->nullable();
            $table->string('contacorrenteFuncionario2', 191)->nullable();
            $table->string('bancoFuncionario2', 191)->nullable();
            $table->string('nrcontaFuncionario2', 191)->nullable();
            $table->string('agenciaFuncionario2', 191)->nullable();
            $table->string('chavePixFuncionario2', 191)->nullable();
            $table->string('nomefavorecidoFuncionario', 191)->nullable();
            $table->string('cpffavorecidoFuncionario', 191)->nullable();
            $table->string('contacorrentefavorecidoFuncionario', 191)->nullable();
            $table->string('bancofavorecidoFuncionario', 191)->nullable();
            $table->string('nrcontafavorecidoFuncionario', 191)->nullable();
            $table->string('agenciafavorecidoFuncionario', 191)->nullable();
            $table->string('fotoFuncionario', 191)->nullable();
            $table->tinyInteger('ativoFuncionario')->default(1);
            $table->tinyInteger('excluidoFuncionario')->default(0);
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
        Schema::dropIfExists('funcionarios');
    }
}
