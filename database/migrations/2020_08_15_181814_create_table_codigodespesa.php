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

            $table->string('despesaCodigoDespesa');


            $table->unsignedBigInteger('idGrupoCodigoDespesa');
            // $table->foreign('idGrupoCodigoDespesa')
            // ->references('id')
            // ->on('grupodespesas')
            // ->onDelete('cascade');

            $table->string('ativoCodigoDespesa');
            $table->string('excluidoCodigoDespesa');


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
