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
            $table->bigincrements('id');

            $table->string('ped_os')->nullable();
            $table->string('ped_data')->nullable();
            $table->string('ped_nomecomprador')->nullable();
            $table->string('ped_usrsolicitante')->nullable();
            $table->string('ped_fornecedor')->nullable();
            $table->string('ped_descprod')->nullable();
            $table->string('ped_valortotal')->nullable();
            // $table->string('ped_cartaodecredito')->nullable();
            $table->string('ped_formapag')->nullable();
            $table->string('ped_pix')->nullable();
            $table->string('ped_banco')->nullable();
            $table->string('ped_conta')->nullable();
            $table->string('ped_agenciaconta')->nullable();
            $table->string('ped_cpfcnpj')->nullable();
            $table->string('ped_numcartao')->nullable();
            $table->string('ped_vzscartao')->nullable();
            $table->string('ped_periodofaturado')->nullable();
            $table->string('ped_reembolsado')->nullable();
            $table->string('ped_precounit')->nullable();
            $table->string('ped_qtd')->nullable();
            $table->string('ped_observacao')->nullable();
            $table->string('ped_notafiscal')->nullable();
            $table->string('ped_aprovado')->nullable();
            $table->string('ped_contaaprovada')->nullable();
            $table->string('ped_exigaprov')->nullable();
            $table->string('ped_excluidopedido')->nullable();
            $table->string('ped_novanotificacao')->nullable();

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
