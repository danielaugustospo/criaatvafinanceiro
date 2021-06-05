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
        //
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->bigincrements('id');

            $table->string('nomeFornecedor')->nullable();
            $table->string('razaosocialFornecedor');
            $table->string('siteFornecedor')->nullable();
            $table->string('contatoFornecedor')->nullable();
            $table->string('cepFornecedor')->nullable();
            $table->string('enderecoFornecedor')->nullable();
            $table->string('bairroFornecedor')->nullable();
            $table->string('cidadeFornecedor')->nullable();
            $table->string('estadoFornecedor')->nullable();
            $table->string('telefone1Fornecedor')->nullable();
            $table->string('telefone2Fornecedor')->nullable();
            $table->string('cnpjFornecedor')->nullable();
            $table->string('inscEstadualFornecedor')->nullable();
            $table->string('inscMunicipalFornecedor')->nullable();
            $table->string('cpfFornecedor')->nullable();
            $table->string('identidadeFornecedor')->nullable();
            $table->string('emailFornecedor')->nullable();
            $table->string('dataContratoFornecedor')->nullable();


            $table->string('contacorrenteFornecedor1')->nullable();
            $table->string('bancoFornecedor1')->nullable();
            $table->string('nrcontaFornecedor1')->nullable();
            $table->string('agenciaFornecedor1')->nullable();
            $table->string('chavePixFornecedor1')->nullable();

            $table->string('contacorrenteFornecedor2')->nullable();
            $table->string('bancoFornecedor2')->nullable();
            $table->string('nrcontaFornecedor2')->nullable();
            $table->string('agenciaFornecedor2')->nullable();
            $table->string('chavePixFornecedor2')->nullable();

            $table->string('contacorrenteFornecedor3')->nullable();
            $table->string('bancoFornecedor3')->nullable();
            $table->string('nrcontaFornecedor3')->nullable();
            $table->string('agenciaFornecedor3')->nullable();
            $table->string('chavePixFornecedor3')->nullable();


            $table->boolean('ativoFornecedor')->default('1');
            $table->boolean('excluidoFornecedor')->default('0');

            $table->unsignedBigInteger('bancoFornecedor')->nullable();
            // $table->foreign('bancoFornecedor')
            // ->references('id')
            // ->on('banco')
            // ->onDelete('cascade');

            // $table->string('bancoFornecedor');


            // $table->timestamp('created_at')->nullable(); //Data Criação


            $table->timestamps();
            $table->softDeletes();

            // $table->index(['cpfFornecedor']);
            // $table->unique(['id']);
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
