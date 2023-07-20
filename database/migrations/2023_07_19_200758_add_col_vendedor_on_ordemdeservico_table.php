<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColVendedorOnOrdemdeservicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordemdeservico', function (Blueprint $table) {
            $table->unsignedBigInteger('vendedor')->after('idClienteOrdemdeServico')->nullable();
        });
    }

    public function down()
    {
        Schema::table('ordemdeservico', function (Blueprint $table) {
            $table->dropColumn('vendedor');
        });
    }
}
