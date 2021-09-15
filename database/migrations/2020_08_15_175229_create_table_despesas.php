<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDespesas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->string('ehcompra')->nullable();
            $table->string('cheque')->nullable();
            $table->string('conta')->nullable();
            $table->string('quemcomprou')->nullable();
            $table->string('dataDaCompra')->nullable();
            $table->string('dataDoPagamento')->nullable();
            $table->string('dataDoTrabalho')->nullable();
            $table->string('descricaoDespesa')->nullable();
            $table->string('despesaCodigoDespesas')->nullable();
            $table->string('despesaFixa')->nullable();
            $table->string('idBanco')->nullable();
            $table->string('idDespesaPai')->nullable();
            $table->string('idFormaPagamento')->nullable();
            $table->string('idFornecedor')->nullable();
            $table->string('idFuncionario')->nullable();
            $table->string('idOS')->nullable();
            $table->string('notaFiscal')->nullable();
            $table->string('nRegistro')->nullable();
            $table->string('pago')->nullable();
            $table->string('precoReal')->nullable();
            $table->string('reembolsado')->nullable();
            $table->string('totalPrecoCliente')->nullable();
            $table->string('totalPrecoReal')->nullable();
            $table->string('vencimento')->nullable();
            $table->string('idAlteracaoUsuario')->nullable();
            $table->string('idAutor')->nullable();
            $table->string('quantidade')->nullable();
            $table->string('valorUnitario')->nullable();
            $table->string('valorparcela')->nullable();
            $table->string('ativoDespesa')->default('1');
            $table->string('excluidoDespesa')->default('0');
            

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
        Schema::dropIfExists('despesas');
    }
}
