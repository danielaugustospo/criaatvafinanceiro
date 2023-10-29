<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPagoObservacaoRevisaoColumn extends Migration
{
    public function up()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->string('ped_pago', 191)->nullable()->after('ped_aprovado');
            $table->string('ped_observacao_revisao', 191)->nullable()->after('ped_observacao');
        });
    }

    public function down()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->dropColumn('ped_pago');
            $table->dropColumn('ped_observacao_revisao');
        });
    }
}
