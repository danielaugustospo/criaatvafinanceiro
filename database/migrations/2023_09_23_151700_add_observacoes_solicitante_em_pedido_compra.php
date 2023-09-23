<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddObservacoesSolicitanteEmPedidoCompra extends Migration
{
    public function up()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->string('observacoes_solicitante', 191)->nullable();
        });
    }

    public function down()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->dropColumn('observacoes_solicitante');
        });
    }
}
