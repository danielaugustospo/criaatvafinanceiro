<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToOrdemdeservicoTable extends Migration
{
    public function up()
    {
        Schema::table('ordemdeservico', function (Blueprint $table) {
            $table->unsignedBigInteger('valorOrcamento')->nullable();
            $table->tinyInteger('percentualPermitido')->unsigned();
        });
    }

    public function down()
    {
        Schema::table('ordemdeservico', function (Blueprint $table) {
            $table->dropColumn('valorOrcamento');
            $table->dropColumn('percentualPermitido');
        });
    }
}
