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
            $table->string('descricaoDespesa');
            $table->string('despesaCodigoDespesas');
            $table->string('idFornecedor');
            $table->string('precoReal');
            $table->string('atuacao');
            $table->string('precoCliente');
            $table->string('pago');
            $table->string('quempagou');
            $table->string('idFormaPagamento');
            $table->string('conta');
            $table->string('nRegistro');
            $table->string('valorEstornado');
            $table->string('data');
            $table->string('totalPrecoReal');
            $table->string('totalPrecoCliente');
            $table->string('lucro');

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
