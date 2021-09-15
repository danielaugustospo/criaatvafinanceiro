<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaAliquotamensal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('aliquotamensal', function (Blueprint $table) {
            $table->bigincrements('id');


            $table->string('idconta');
            $table->string('mes')->nullable();
            $table->string('dasSemFatorR')->nullable();
            $table->string('issSemFatorR')->nullable();
            $table->string('reciboSemFatorR')->nullable();
            $table->string('dasComFatorR')->nullable();
            $table->string('issComFatorR')->nullable();
            $table->string('reciboComFatorR')->nullable();

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
        Schema::dropIfExists('aliquotamensal');

    }
}
