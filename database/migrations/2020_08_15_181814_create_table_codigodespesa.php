<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCodigoDespesa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigodespesas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('despesaCodigoDespesa', 191)->nullable(false);
            $table->bigInteger('idGrupoCodigoDespesa')->unsigned()->nullable(false);
            $table->string('ativoCodigoDespesa', 191)->nullable(false);
            $table->string('excluidoCodigoDespesa', 191)->nullable(false);
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
        Schema::dropIfExists('codigodespesas');
    }
}
