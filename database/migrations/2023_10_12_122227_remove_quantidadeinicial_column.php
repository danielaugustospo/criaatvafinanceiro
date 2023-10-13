<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveQuantidadeinicialColumn extends Migration
{
    public function up()
    {
        Schema::table('estoque', function (Blueprint $table) {
            $table->dropColumn('quantidadeinicial');
            $table->dropColumn('quantidade');
        });
    }

    public function down()
    {
        Schema::table('estoque', function (Blueprint $table) {
            $table->string('quantidadeinicial', 191)->nullable();
            $table->string('quantidade', 191)->nullable();
        });
    }
}
