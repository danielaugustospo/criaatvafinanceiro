<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AumentaObsPedidoCompra extends Migration
{
    public function up()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->string('observacoes_solicitante', 1000)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->string('observacoes_solicitante', 191)->nullable()->change();
        });
    }
}
