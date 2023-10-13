<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColQtdInicialEmEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estoque', function (Blueprint $table) {
            $table->string('quantidadeinicial', 191)->nullable();
        });
    }

    public function down()
    {
        Schema::table('estoque', function (Blueprint $table) {
            $table->dropColumn('quantidadeinicial');
        });
    }
}
