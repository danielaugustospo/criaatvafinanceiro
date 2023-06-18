<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBancos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banco', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomeBanco', 191)->nullable(false);
            $table->string('codigoBanco', 191)->nullable(false);
            $table->tinyInteger('ativoBanco')->nullable(false);
            $table->tinyInteger('excluidoBanco')->nullable(false);
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
        Schema::dropIfExists('banco');
    }
}
