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
            $table->string('cepFuncionario')->nullable();
            $table->string('enderecoFuncionario')->nullable();
            $table->string('bairroFuncionario')->nullable();
            $table->string('cidadeFuncionario')->nullable();
            $table->string('ufFuncionario')->nullable();
            $table->string('celularFuncionario')->nullable();
            $table->string('telresidenciaFuncionario')->nullable();
            $table->string('contatoemergenciaFuncionario')->nullable();
            $table->string('emailFuncionario')->nullable();
            $table->string('redesocialFuncionario')->nullable();
            $table->string('facebookFuncionario')->nullable();
            $table->string('telegramFuncionario')->nullable();
            $table->string('cpfFuncionario');
            $table->string('rgFuncionario')->nullable();
            $table->string('orgaoRGFuncionario')->nullable();
            $table->string('expedicaoRGFuncionario')->nullable();
            $table->string('tituloFuncionario')->nullable();
            $table->string('maeFuncionario')->nullable();
            $table->string('paiFuncionario')->nullable();
            $table->string('profissaoFuncionario')->nullable();
            $table->string('cargoEmpresaFuncionario')->nullable();
            $table->string('tipocontratoFuncionario')->nullable();
            $table->string('grauescolaridadeFuncionario')->nullable();
            $table->string('descformacaoFuncionario')->nullable();
            $table->string('certficFuncionario')->nullable();
            $table->string('uncertificadoraFuncionario')->nullable();
            $table->string('anocertificacaoFuncionario')->nullable();
            
            $table->string('contacorrenteFuncionario1')->nullable();
            $table->string('bancoFuncionario1')->nullable();
            $table->string('nrcontaFuncionario1')->nullable();
            $table->string('agenciaFuncionario1')->nullable();
            $table->string('chavePixFuncionario1')->nullable();

            $table->string('contacorrenteFuncionario2')->nullable();
            $table->string('bancoFuncionario2')->nullable();
            $table->string('nrcontaFuncionario2')->nullable();
            $table->string('agenciaFuncionario2')->nullable();
            $table->string('chavePixFuncionario2')->nullable();
            
            $table->string('nomefavorecidoFuncionario')->nullable();
            $table->string('cpffavorecidoFuncionario')->nullable();
            $table->string('contacorrentefavorecidoFuncionario')->nullable();
            $table->string('bancofavorecidoFuncionario')->nullable();
            $table->string('nrcontafavorecidoFuncionario')->nullable();
            $table->string('agenciafavorecidoFuncionario')->nullable();
            $table->string('fotoFuncionario')->nullable();

            $table->boolean('ativoFuncionario')->default('1');
            $table->boolean('excluidoFuncionario')->default('0');

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
