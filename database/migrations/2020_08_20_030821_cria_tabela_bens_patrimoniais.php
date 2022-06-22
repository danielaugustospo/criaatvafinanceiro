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
        //
        Schema::create('benspatrimoniais', function (Blueprint $table) {
            $table->bigincrements('id');

            $table->string('nomeBensPatrimoniais');
            $table->string('descricaoBensPatrimoniais')->nullable();


            $table->unsignedBigInteger('idTipoBensPatrimoniais');

            $table->unsignedBigInteger('qtdestoqueminimo')->default('0');
            $table->boolean('ativadobenspatrimoniais')->default('1');
            $table->boolean('excluidobenspatrimoniais')->default('0');

            $table->boolean('statusbenspatrimoniais')->default('1');

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
