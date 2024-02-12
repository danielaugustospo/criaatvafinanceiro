<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoAnexadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_anexados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento_anexado', 100)->nullable();
            $table->string('enum_entidade', 100)->nullable();
            $table->string('id_entidade', 100)->nullable();
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
        Schema::dropIfExists('documentos_anexados');
    }
}
