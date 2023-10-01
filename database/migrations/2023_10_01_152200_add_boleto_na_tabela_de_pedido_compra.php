<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBoletoNaTabelaDePedidoCompra extends Migration
{
    public function up()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->string('ped_boleto', 191)->nullable();
        });
    }

    public function down()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->dropColumn('ped_boleto');
        });
    }
}
