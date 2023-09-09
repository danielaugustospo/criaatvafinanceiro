<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaColEstantePrateleira extends Migration
{
    public function up()
    {
        Schema::table('benspatrimoniais', function (Blueprint $table) {
            $table->string('estante')->after('qtdestoqueminimo')->nullable();
            $table->string('prateleira')->after('estante')->nullable();
        });
    }

    public function down()
    {
        Schema::table('benspatrimoniais', function (Blueprint $table) {
            $table->dropColumn('estante');
            $table->dropColumn('prateleira');
        });
    }
}
