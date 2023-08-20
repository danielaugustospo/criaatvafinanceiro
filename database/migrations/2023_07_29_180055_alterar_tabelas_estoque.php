<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterarTabelasEstoque extends Migration
{
    public function up()
    {
        if (Schema::hasTable('entradas')) {
            Schema::table('entradas', function (Blueprint $table) {
                if (Schema::hasColumn('entradas', 'codbarras')) {
                    // Remove the column 'codbarras'
                    $table->dropColumn('codbarras');
                }

                // Add the column 'id_estoque'
                $table->unsignedBigInteger('id_estoque')->after('descricaoentrada')->nullable();

                // Rename the column 'qtdeEntrada'
                $table->renameColumn('qtdeEntrada', 'quantidade_entrada');

                // Create the foreign key for the table 'estoque'
                $table->foreign('id_estoque')->references('id')->on('estoque');

                // Remove the column 'excluidoentrada'
                if (Schema::hasColumn('entradas', 'excluidoentrada')) {
                    $table->dropColumn('excluidoentrada');
                }

                // Add the column 'deleted_at' to support soft deletion
                $table->softDeletes();
            });
        }

        if (Schema::hasTable('saidas')) {
            Schema::table('saidas', function (Blueprint $table) {
                if (Schema::hasColumn('saidas', 'codbarras')) {
                    // Remove the column 'codbarras'
                    $table->dropColumn('codbarras');
                }

                // Add the column 'id_estoque'
                $table->unsignedBigInteger('id_estoque')->after('descricaosaida')->nullable();

                // Add the column 'quantidade_saida'
                $table->unsignedInteger('quantidade_saida')->after('id_estoque')->default(0)->nullable(false);

                // Create the foreign key for the table 'estoque'
                $table->foreign('id_estoque')->references('id')->on('estoque');

                // Remove the column 'excluidosaida'
                if (Schema::hasColumn('saidas', 'excluidosaida')) {
                    $table->dropColumn('excluidosaida');
                }

                // Add the column 'deleted_at' to support soft deletion
                $table->softDeletes();
            });
        }

        if (Schema::hasTable('estoque')) {
            Schema::table('estoque', function (Blueprint $table) {
                // Add the column 'quantidade'
                $table->unsignedInteger('quantidade')->default(0)->nullable(false);

                // Add the column 'deleted_at' to support soft deletion
                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        // Revert the alterations, if necessary
        if (Schema::hasTable('entradas')) {
            Schema::table('entradas', function (Blueprint $table) {
                // Re-add the column 'codbarras'
                $table->string('codbarras', 191)->nullable(false);

                // Remove the foreign key
                if (Schema::hasColumn('entradas', 'id_estoque')) {
                    $table->dropForeign(['id_estoque']);
                }

                // Remove the column 'id_estoque'
                if (Schema::hasColumn('entradas', 'id_estoque')) {
                    $table->dropColumn('id_estoque');
                }

                // Rename the column 'quantidade_entrada'
                $table->renameColumn('quantidade_entrada', 'qtdeEntrada');
            });
        }

        if (Schema::hasTable('saidas')) {
            Schema::table('saidas', function (Blueprint $table) {
                // Re-add the column 'codbarras'
                $table->string('codbarras', 191)->nullable(false);

                // Remove the foreign key
                if (Schema::hasColumn('saidas', 'id_estoque')) {
                    $table->dropForeign(['id_estoque']);
                }

                // Remove the column 'quantidade_saida'
                if (Schema::hasColumn('saidas', 'quantidade_saida')) {
                    $table->dropColumn('quantidade_saida');
                }

                // Remove the column 'id_estoque'
                if (Schema::hasColumn('saidas', 'id_estoque')) {
                    $table->dropColumn('id_estoque');
                }
            });
        }

        if (Schema::hasTable('estoque')) {
            Schema::table('estoque', function (Blueprint $table) {
                // Remove the column 'quantidade'
                if (Schema::hasColumn('estoque', 'quantidade')) {
                    $table->dropColumn('quantidade');
                }

                // Remove the column 'deleted_at' for soft deletion support
                if (Schema::hasColumn('estoque', 'deleted_at')) {
                    $table->dropSoftDeletes();
                }
            });
        }
    }
}
