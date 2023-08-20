<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstoqueIdToSaidasAndEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // // Add the 'estoque_id' column to the 'saidas' table if it exists
        // if (Schema::hasTable('saidas')) {
        //     Schema::table('saidas', function (Blueprint $table) {
        //         // Add the column 'estoque_id'
        //         $table->unsignedBigInteger('estoque_id')->nullable();

        //         // Create the foreign key for the 'estoque_id' column
        //         $table->foreign('estoque_id')->references('id')->on('estoque')->onDelete('cascade');
        //     });
        // }

        // // Add the 'estoque_id' column to the 'entradas' table if it exists
        // if (Schema::hasTable('entradas')) {
        //     Schema::table('entradas', function (Blueprint $table) {
        //         // Add the column 'estoque_id'
        //         $table->unsignedBigInteger('estoque_id')->nullable();

        //         // Create the foreign key for the 'estoque_id' column
        //         $table->foreign('estoque_id')->references('id')->on('estoque')->onDelete('cascade');
        //     });
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the 'estoque_id' column and foreign key from the 'saidas' table if they exist
        if (Schema::hasTable('saidas') && Schema::hasColumn('saidas', 'estoque_id')) {
            Schema::table('saidas', function (Blueprint $table) {
                // Remove the foreign key from the 'estoque_id' column
                $table->dropForeign(['estoque_id']);

                // Remove the column 'estoque_id'
                $table->dropColumn('estoque_id');
            });
        }
        // Remove the 'idbenspatrimoniais' column and foreign key from the 'saidas' table if they exist
        if (Schema::hasTable('saidas') && Schema::hasColumn('saidas', 'idbenspatrimoniais')) {
            Schema::table('saidas', function (Blueprint $table) {
                // Remove the foreign key from the 'idbenspatrimoniais' column
                $table->dropForeign(['idbenspatrimoniais']);

                // Remove the column 'idbenspatrimoniais'
                $table->dropColumn('idbenspatrimoniais');
            });
        }

        // Remove the 'estoque_id' column and foreign key from the 'entradas' table if they exist
        if (Schema::hasTable('entradas') && Schema::hasColumn('entradas', 'estoque_id')) {
            Schema::table('entradas', function (Blueprint $table) {
                // Remove the foreign key from the 'estoque_id' column
                $table->dropForeign(['estoque_id']);

                // Remove the column 'estoque_id'
                $table->dropColumn('estoque_id');
            });
        }

        // Remove the 'idbenspatrimoniais' column and foreign key from the 'entradas' table if they exist
        if (Schema::hasTable('entradas') && Schema::hasColumn('entradas', 'idbenspatrimoniais')) {
            Schema::table('entradas', function (Blueprint $table) {
                // Remove the foreign key from the 'idbenspatrimoniais' column
                // $table->dropForeign(['entradas_id_estoque_foreign']);

                // Remove the column 'idbenspatrimoniais'
                $table->dropColumn('idbenspatrimoniais');
            });
        }
    }
}
