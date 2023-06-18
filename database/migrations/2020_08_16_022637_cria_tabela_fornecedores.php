<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaFornecedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomeFornecedor', 191)->nullable();
            $table->string('razaosocialFornecedor', 191)->nullable(false);
            $table->string('dadoslegado', 191)->nullable();
            $table->string('siteFornecedor', 191)->nullable();
            $table->string('contatoFornecedor', 191)->nullable();
            $table->string('cepFornecedor', 191)->nullable();
            $table->string('enderecoFornecedor', 191)->nullable();
            $table->string('bairroFornecedor', 191)->nullable();
            $table->string('cidadeFornecedor', 191)->nullable();
            $table->string('estadoFornecedor', 191)->nullable();
            $table->string('telefone1Fornecedor', 191)->nullable();
            $table->string('telefone2Fornecedor', 191)->nullable();
            $table->string('cnpjFornecedor', 191)->nullable();
            $table->string('inscEstadualFornecedor', 191)->nullable();
            $table->string('inscMunicipalFornecedor', 191)->nullable();
            $table->string('cpfFornecedor', 191)->nullable();
            $table->string('identidadeFornecedor', 191)->nullable();
            $table->string('emailFornecedor', 191)->nullable();
            $table->string('dataContratoFornecedor', 191)->nullable();
            $table->string('contacorrenteFornecedor1', 191)->nullable();
            $table->string('bancoFornecedor1', 191)->nullable();
            $table->string('nrcontaFornecedor1', 191)->nullable();
            $table->string('agenciaFornecedor1', 191)->nullable();
            $table->string('chavePixFornecedor1', 191)->nullable();
            $table->string('contacorrenteFornecedor2', 191)->nullable();
            $table->string('bancoFornecedor2', 191)->nullable();
            $table->string('nrcontaFornecedor2', 191)->nullable();
            $table->string('agenciaFornecedor2', 191)->nullable();
            $table->string('chavePixFornecedor2', 191)->nullable();
            $table->string('contacorrenteFornecedor3', 191)->nullable();
            $table->string('bancoFornecedor3', 191)->nullable();
            $table->string('nrcontaFornecedor3', 191)->nullable();
            $table->string('agenciaFornecedor3', 191)->nullable();
            $table->string('chavePixFornecedor3', 191)->nullable();
            $table->tinyInteger('ativoFornecedor')->nullable(false)->default(1);
            $table->tinyInteger('excluidoFornecedor')->nullable(false)->default(0);
            $table->bigInteger('bancoFornecedor')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('fornecedores');

    }
}
