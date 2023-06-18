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
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomeCliente', 191)->nullable();
            $table->string('razaosocialCliente', 191)->nullable(false);
            $table->string('siteCliente', 191)->nullable();
            $table->string('contatoCliente', 191)->nullable();
            $table->string('cepCliente', 191)->nullable();
            $table->string('enderecoCliente', 191)->nullable();
            $table->string('bairroCliente', 191)->nullable();
            $table->string('cidadeCliente', 191)->nullable();
            $table->string('estadoCliente', 191)->nullable();
            $table->string('telefone1Cliente', 191)->nullable();
            $table->string('telefone2Cliente', 191)->nullable();
            $table->string('cnpjCliente', 191)->nullable();
            $table->string('inscEstadualCliente', 191)->nullable();
            $table->string('cpfCliente', 191)->nullable();
            $table->string('identidadeCliente', 191)->nullable();
            $table->string('emailCliente', 191)->nullable();
            $table->string('dataCadastroCliente', 191)->nullable();
            $table->string('contacorrenteCliente1', 191)->nullable();
            $table->string('bancoCliente1', 191)->nullable();
            $table->string('nrcontaCliente1', 191)->nullable();
            $table->string('agenciaCliente1', 191)->nullable();
            $table->string('chavePixCliente1', 191)->nullable();
            $table->string('contacorrenteCliente2', 191)->nullable();
            $table->string('bancoCliente2', 191)->nullable();
            $table->string('nrcontaCliente2', 191)->nullable();
            $table->string('agenciaCliente2', 191)->nullable();
            $table->string('chavePixCliente2', 191)->nullable();
            $table->string('contacorrenteCliente3', 191)->nullable();
            $table->string('bancoCliente3', 191)->nullable();
            $table->string('nrcontaCliente3', 191)->nullable();
            $table->string('agenciaCliente3', 191)->nullable();
            $table->string('chavePixCliente3', 191)->nullable();
            $table->bigInteger('bancoFavorecidoCliente')->unsigned()->nullable();
            $table->string('nomefavorecidoCliente', 191)->nullable();
            $table->string('cpffavorecidoCliente', 191)->nullable();
            $table->string('contacorrentefavorecidoCliente', 191)->nullable();
            $table->string('agenciafavorecidoCliente', 191)->nullable();
            $table->tinyInteger('ativoCliente')->nullable(false)->default(1);
            $table->tinyInteger('excluidoCliente')->nullable(false)->default(0);
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
        Schema::dropIfExists('clientes');

    }
}


