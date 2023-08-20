<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificaTabelaEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('estoque');
        Schema::create('estoque', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codbarras', 191)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('nomematerial', 191)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('descricao', 191)->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedBigInteger('idbenspatrimoniais')->nullable(false);
            $table->unsignedTinyInteger('ativadoestoque')->nullable(false)->default(1);
            $table->unsignedTinyInteger('excluidoestoque')->nullable(false)->default(0);
            $table->timestamps();
            $table->integer('quantidade')->nullable(false)->default(0);
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estoque');
        Schema::create('estoque', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codbarras', 191)->nullable(false);
            $table->string('nomematerial', 191)->nullable(false);
            $table->string('descricao', 191)->nullable();
            $table->unsignedBigInteger('idbenspatrimoniais')->nullable(false);
            $table->unsignedTinyInteger('ativadoestoque')->default(1)->nullable(false);
            $table->unsignedTinyInteger('excluidoestoque')->default(0)->nullable(false);
            $table->timestamps();
        });
    }
}
