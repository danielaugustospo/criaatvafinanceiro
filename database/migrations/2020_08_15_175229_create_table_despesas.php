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

            $table->string('idCodigoDespesas');
            $table->string('idOS');
            $table->string('idDespesaPai');
            $table->string('descricaoDespesa');
            $table->string('despesaCodigoDespesas');
            $table->string('idFornecedor');
            $table->string('precoReal');
            $table->string('valorEstornado');
            $table->string('atuacao');
            $table->string('pago');
            $table->string('quempagou');
            $table->string('idFormaPagamento');
            $table->string('conta');
            $table->string('nRegistro');
            $table->string('vencimento');
            $table->string('totalPrecoReal');
            $table->string('totalPrecoCliente');
            
            
            $table->string('notaFiscal');
            $table->string('despesaFixa');

            //campos
            $table->string('cheque');
            $table->string('idBanco');




            $table->string('ativoDespesa');
            $table->string('excluidoDespesa');


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
