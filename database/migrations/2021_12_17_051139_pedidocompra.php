<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pedidocompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidocompra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ped_os', 191)->nullable();
            $table->string('ped_data', 191)->nullable();
            $table->string('ped_nomecomprador', 191)->nullable();
            $table->string('ped_usrsolicitante', 191)->nullable();
            $table->string('ped_fornecedor', 191)->nullable();
            $table->string('ped_descprod', 191)->nullable();
            $table->string('ped_valortotal', 191)->nullable();
            $table->string('ped_formapag', 191)->nullable();
            $table->string('ped_pix', 191)->nullable();
            $table->string('ped_banco', 191)->nullable();
            $table->string('ped_conta', 191)->nullable();
            $table->string('ped_agenciaconta', 191)->nullable();
            $table->string('ped_cpfcnpj', 191)->nullable();
            $table->string('ped_numcartao', 191)->nullable();
            $table->string('ped_vzscartao', 191)->nullable();
            $table->string('ped_periodofaturado', 191)->nullable();
            $table->string('ped_reembolsado', 191)->nullable();
            $table->string('ped_precounit', 191)->nullable();
            $table->string('ped_qtd', 191)->nullable();
            $table->string('ped_observacao', 191)->nullable();
            $table->string('ped_notafiscal', 191)->nullable();
            $table->string('ped_aprovado', 191)->nullable();
            $table->string('ped_contaaprovada', 191)->nullable();
            $table->string('ped_exigaprov', 191)->nullable();
            $table->string('ped_excluidopedido', 191)->nullable();
            $table->string('ped_novanotificacao', 191)->nullable();
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
        Schema::dropIfExists('pedidocompra');
    }
}
