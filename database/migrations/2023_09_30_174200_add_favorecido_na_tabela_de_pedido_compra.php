<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFavorecidoNaTabelaDePedidoCompra extends Migration
{
    public function up()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->string('ped_favorecido', 191)->nullable();
        });
    }

    public function down()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->dropColumn('ped_favorecido');
        });
    }
}
