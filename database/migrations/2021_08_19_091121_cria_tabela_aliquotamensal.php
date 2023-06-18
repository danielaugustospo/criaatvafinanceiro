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
            $table->bigIncrements('id');
            $table->string('idconta', 191);
            $table->string('mes', 191)->nullable();
            $table->string('dasSemFatorR', 191)->nullable();
            $table->string('issSemFatorR', 191)->nullable();
            $table->string('reciboSemFatorR', 191)->nullable();
            $table->string('dasComFatorR', 191)->nullable();
            $table->string('issComFatorR', 191)->nullable();
            $table->string('reciboComFatorR', 191)->nullable();
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
