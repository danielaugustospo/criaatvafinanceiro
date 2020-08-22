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
            $table->string('descricaoBensPatrimoniais');


            $table->unsignedBigInteger('idTipoBensPatrimoniais');
            $table->foreign('idTipoBensPatrimoniais')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->boolean('ativadoBensPatrimoniais');
            $table->boolean('excluidoBensPatrimoniais');

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
    }
}
