<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomeConta', 191)->nullable(false);
            $table->string('apelidoConta', 191)->nullable(false);
            $table->tinyInteger('ativoConta')->default(1)->nullable(false);
            $table->tinyInteger('excluidoConta')->default(0)->nullable(false);
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
        Schema::dropIfExists('conta');
    }
}
