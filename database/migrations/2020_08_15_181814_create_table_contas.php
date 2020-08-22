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
        // Schema::create('conta', function (Blueprint $table) {
            Schema::create('conta', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('numeroConta');
            $table->string('agenciaConta');


            $table->unsignedBigInteger('idBanco');
            $table->foreign('idBanco')
            ->references('id')
            ->on('banco')
            ->onDelete('cascade');


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
