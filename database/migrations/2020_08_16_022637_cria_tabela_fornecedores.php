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

            $table->string('nomeFornecedor');
            $table->string('razaosocialFornecedor');
            $table->string('siteFornecedor');
            $table->string('contatoFornecedor');
            $table->string('cepFornecedor');
            $table->string('enderecoFornecedor');
            $table->string('bairroFornecedor');
            $table->string('cidadeFornecedor');
            $table->string('estadoFornecedor');
            $table->string('telefone1Fornecedor');
            $table->string('telefone2Fornecedor');
            $table->string('cnpjFornecedor');
            $table->string('inscEstadualFornecedor');
            $table->string('cpfFornecedor');
            $table->string('identidadeFornecedor');
            $table->string('emailFornecedor');
            $table->string('dataCadastroFornecedor');


            $table->unsignedBigInteger('bancoFornecedor');
            $table->foreign('bancoFornecedor')
            ->references('id')
            ->on('banco')
            ->onDelete('cascade');

            // $table->string('bancoFuncionario');
            $table->string('nrcontaFornecedor');
            $table->string('agenciaFornecedor');


            $table->unsignedBigInteger('bancoFavorecidoFornecedor');
            $table->foreign('bancoFavorecidoFornecedor')
            ->references('id')
            ->on('banco')
            ->onDelete('cascade');

            $table->string('nomefavorecidoFornecedor');
            $table->string('cpffavorecidoFornecedor');
            $table->string('contacorrentefavorecidoFornecedor');

            $table->string('agenciafavorecidoFornecedor');

            $table->boolean('ativoFornecedor');
            $table->boolean('excluidoFornecedor');

            // $table->timestamp('created_at')->nullable(); //Data Criação


            $table->timestamps();
            $table->softDeletes();

            // $table->index(['cpfFuncionario']);
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
    }
}
