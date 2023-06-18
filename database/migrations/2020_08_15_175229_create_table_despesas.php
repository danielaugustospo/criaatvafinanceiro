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
            $table->string('ehcompra', 191)->nullable();
            $table->integer('insereestoque')->nullable();
            $table->string('cheque', 191)->nullable();
            $table->string('conta', 191)->nullable();
            $table->string('quemcomprou', 191)->nullable();
            $table->string('dataDaCompra', 191)->nullable();
            $table->string('dataDoPagamento', 191)->nullable();
            $table->string('dataDoTrabalho', 191)->nullable();
            $table->string('descricaoDespesa', 191)->nullable();
            $table->string('despesaCodigoDespesas', 191)->nullable();
            $table->string('despesaFixa', 191)->nullable();
            $table->string('idBanco', 191)->nullable();
            $table->string('idDespesaPai', 191)->nullable();
            $table->string('idFormaPagamento', 191)->nullable();
            $table->string('idFornecedor', 191)->nullable();
            $table->string('idFuncionario', 191)->nullable();
            $table->string('idOS', 191)->nullable();
            $table->string('notaFiscal', 191)->nullable();
            $table->string('nRegistro', 191)->nullable();
            $table->string('pago', 191)->nullable();
            $table->string('precoReal', 191)->nullable();
            $table->string('reembolsado', 191)->nullable();
            $table->string('vale', 191)->nullable();
            $table->string('datavale', 191)->nullable();
            $table->string('vencimento', 191)->nullable();
            $table->string('idAlteracaoUsuario', 191)->nullable();
            $table->string('idAutor', 191)->nullable();
            $table->string('quantidade', 191)->nullable();
            $table->string('valorUnitario', 191)->nullable();
            $table->string('valorparcela', 191)->nullable();
            $table->string('ativoDespesa', 191)->default('1')->nullable(false);
            $table->string('excluidoDespesa', 191)->default('0')->nullable(false);
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
