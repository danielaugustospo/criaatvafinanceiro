<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaBensPatrimoniais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benspatrimoniais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomeBensPatrimoniais', 191)->nullable(false);
            $table->string('descricaoBensPatrimoniais', 191)->nullable();
            $table->bigInteger('idTipoBensPatrimoniais')->unsigned()->nullable(false);
            $table->bigInteger('qtdestoqueminimo')->unsigned()->default(0);
            $table->tinyInteger('ativadobenspatrimoniais')->nullable(false)->default(1);
            $table->tinyInteger('excluidobenspatrimoniais')->nullable(false)->default(0);
            $table->tinyInteger('statusbenspatrimoniais')->nullable(false)->default(1);
            $table->string('unidademedida', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('benspatrimoniais');

    }
}
