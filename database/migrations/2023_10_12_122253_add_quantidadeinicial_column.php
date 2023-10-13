<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantidadeinicialColumn extends Migration
{
    public function up()
    {
        Schema::table('estoque', function (Blueprint $table) {
            $table->string('quantidadeinicial', 191)->nullable()->after('nomematerial');
            $table->string('quantidade', 191)->nullable()->after('quantidadeinicial');
        });
    }

    public function down()
    {
        Schema::table('estoque', function (Blueprint $table) {
            $table->dropColumn('quantidadeinicial');
            $table->dropColumn('quantidade');
        });
    }
}
