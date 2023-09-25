<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSaidaNaTabelaDeEntradas extends Migration
{
    public function up()
    {
        Schema::table('entradas', function (Blueprint $table) {
            $table->string('id_saida', 191)->nullable();
        });
    }

    public function down()
    {
        Schema::table('entradas', function (Blueprint $table) {
            $table->dropColumn('id_saida');
        });
    }
}
