<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGrupoDespesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupodespesas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('grupoDespesa', 191)->nullable(false);
            $table->string('ativoDespesa', 191)->nullable(false);
            $table->string('excluidoDespesa', 191)->nullable(false);
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
        Schema::dropIfExists('grupodespesas');
    }
}
