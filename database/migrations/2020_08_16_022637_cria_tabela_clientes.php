<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigincrements('id');

            $table->string('nomeCliente')->nullable();
            $table->string('razaosocialCliente');
            $table->string('siteCliente')->nullable();
            $table->string('contatoCliente')->nullable();
            $table->string('cepCliente')->nullable();
            $table->string('enderecoCliente')->nullable();
            $table->string('bairroCliente')->nullable();
            $table->string('cidadeCliente')->nullable();
            $table->string('estadoCliente')->nullable();
            $table->string('telefone1Cliente')->nullable();
            $table->string('telefone2Cliente')->nullable();
            $table->string('cnpjCliente')->nullable();
            $table->string('inscEstadualCliente')->nullable();
            $table->string('cpfCliente')->nullable();
            $table->string('identidadeCliente')->nullable();
            $table->string('emailCliente')->nullable();
            $table->string('dataCadastroCliente')->nullable();

            $table->string('contacorrenteCliente1')->nullable();
            $table->string('bancoCliente1')->nullable();
            $table->string('nrcontaCliente1')->nullable();
            $table->string('agenciaCliente1')->nullable();
            $table->string('chavePixCliente1')->nullable();

            $table->string('contacorrenteCliente2')->nullable();
            $table->string('bancoCliente2')->nullable();
            $table->string('nrcontaCliente2')->nullable();
            $table->string('agenciaCliente2')->nullable();
            $table->string('chavePixCliente2')->nullable();

            $table->string('contacorrenteCliente3')->nullable();
            $table->string('bancoCliente3')->nullable();
            $table->string('nrcontaCliente3')->nullable();
            $table->string('agenciaCliente3')->nullable();
            $table->string('chavePixCliente3')->nullable();

            $table->unsignedBigInteger('bancoFavorecidoCliente')->nullable();
            // $table->foreign('bancoFavorecidoCliente')
            // ->references('id')
            // ->on('banco')
            // ->onDelete('cascade');

            $table->string('nomefavorecidoCliente')->nullable();
            $table->string('cpffavorecidoCliente')->nullable();
            $table->string('contacorrentefavorecidoCliente')->nullable();

            $table->string('agenciafavorecidoCliente')->nullable();

            $table->boolean('ativoCliente')->default('1');
            $table->boolean('excluidoCliente')->default('0');

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
        Schema::dropIfExists('clientes');

    }
}
