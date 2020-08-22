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

            $table->string('nomeCliente');
            $table->string('razaosocialCliente');
            $table->string('siteCliente');
            $table->string('contatoCliente');
            $table->string('cepCliente');
            $table->string('enderecoCliente');
            $table->string('bairroCliente');
            $table->string('cidadeCliente');
            $table->string('estadoCliente');
            $table->string('telefone1Cliente');
            $table->string('telefone2Cliente');
            $table->string('cnpjCliente');
            $table->string('inscEstadualCliente');
            $table->string('cpfCliente');
            $table->string('identidadeCliente');
            $table->string('emailCliente');
            $table->string('dataCadastroCliente');


            $table->unsignedBigInteger('bancoCliente');
            $table->foreign('bancoCliente')
            ->references('id')
            ->on('banco')
            ->onDelete('cascade');

            // $table->string('bancoFuncionario');
            $table->string('nrcontaCliente');
            $table->string('agenciaCliente');


            $table->unsignedBigInteger('bancoFavorecidoCliente');
            $table->foreign('bancoFavorecidoCliente')
            ->references('id')
            ->on('banco')
            ->onDelete('cascade');

            $table->string('nomefavorecidoCliente');
            $table->string('cpffavorecidoCliente');
            $table->string('contacorrentefavorecidoCliente');

            $table->string('agenciafavorecidoCliente');

            $table->boolean('ativoCliente');
            $table->boolean('excluidoCliente');

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
