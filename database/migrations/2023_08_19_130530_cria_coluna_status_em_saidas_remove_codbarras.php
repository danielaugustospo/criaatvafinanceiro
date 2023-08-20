<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaColunaStatusEmSaidasRemoveCodbarras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('saidas')) {
            Schema::table('saidas', function (Blueprint $table) {
                $table->unsignedSmallInteger('status')->nullable()->after('id');
            });
        }

        if (Schema::hasTable('saidas') && Schema::hasColumn('saidas', 'codbarras')) {
            Schema::table('saidas', function (Blueprint $table) {
                $table->dropColumn('codbarras');
            });
        }

        if (Schema::hasTable('entradas') && Schema::hasColumn('entradas', 'codbarras')) {
            Schema::table('entradas', function (Blueprint $table) {
                $table->dropColumn('codbarras');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('saidas') && Schema::hasColumn('saidas', 'status')) {
            Schema::table('saidas', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
}
