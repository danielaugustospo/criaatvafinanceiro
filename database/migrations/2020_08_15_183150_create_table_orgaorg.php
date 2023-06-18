<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrgaorg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orgaorg', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 191)->nullable(false);
            $table->string('estadoOrgaoRG', 191)->nullable(false);
            $table->tinyInteger('ativoOrgaoRG')->nullable(false);
            $table->tinyInteger('excluidoOrgaoRG')->nullable(false);
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
        Schema::dropIfExists('orgaorg');
    }
}
