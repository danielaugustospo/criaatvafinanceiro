<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelapercentual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tabelapercentual', function (Blueprint $table) {
            $table->bigincrements('id');


            $table->string('nometabelapercentual');
            $table->string('percentualtabelapercentual');
            $table->string('pgtabelapercentual');
            $table->string('idostabelapercentual');



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
        Schema::dropIfExists('tabelapercentual');

    }
}
