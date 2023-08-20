<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificaTabelaSaidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('saidas');

        Schema::create('saidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('status')->nullable();
            $table->string('descricaosaida', 191)->collation('utf8mb4_unicode_ci')->nullable();
            $table->unsignedBigInteger('id_estoque')->nullable();
            $table->unsignedInteger('quantidade_saida')->nullable(false)->default(0);
            $table->string('portador', 191)->collation('utf8mb4_unicode_ci')->nullable(false);
            $table->string('ordemdeservico', 191)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('datapararetirada', 191)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('dataretirada', 191)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('datapararetorno', 191)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('ocorrencia', 191)->collation('utf8mb4_unicode_ci')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_estoque')->references('id')->on('estoque');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saidas');

        Schema::create('saidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codbarras', 191)->nullable();
            $table->string('descricaosaida', 191)->nullable();
            $table->unsignedBigInteger('idbenspatrimoniais');
            $table->boolean('excluidosaida')->default(false);
            $table->string('portador', 191);
            $table->string('ordemdeservico', 191)->nullable();
            $table->string('datapararetirada', 191)->nullable();
            $table->string('dataretirada', 191)->nullable();
            $table->string('datapararetorno', 191)->nullable();
            $table->string('ocorrencia', 191)->nullable();
            $table->timestamps();

            $table->foreign('idbenspatrimoniais')->references('id')->on('benspatrimoniais');
        });
    }
}
