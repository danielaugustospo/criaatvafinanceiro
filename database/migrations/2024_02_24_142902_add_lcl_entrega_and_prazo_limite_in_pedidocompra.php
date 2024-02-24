<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLclEntregaAndPrazoLimiteInPedidocompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->string('local_entrega', 191)->nullable();
            $table->string('prazo_entrega_limite', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->dropColumn('local_entrega');
            $table->dropColumn('prazo_entrega_limite');
        });
    }
}
