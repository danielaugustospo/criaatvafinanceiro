<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDadosFinalizacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->string('ped_usr_aprovador', 5)->nullable();
            $table->dateTime('ped_dt_aprovacao')->nullable();
            $table->string('ped_usr_finalizador', 5)->nullable();
            $table->dateTime('ped_dt_finalizacao')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pedidocompra', function (Blueprint $table) {
            $table->dropColumn('ped_usr_aprovador');
            $table->dropColumn('ped_dt_aprovacao');
            $table->dropColumn('ped_usr_finalizador');
            $table->dropColumn('ped_dt_finalizacao');
        });
    }

}
