<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewNotasrecibos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE VIEW view_notasrecibos AS
                SELECT r.dataemissaoreceita as 'Emissao', r.nfreceita as 'nfRecibo', 
                o.id as 'OS', r.valorreceita as 'Valor', 

                (CASE 
                	WHEN (o.fatorR = 0) and (nfreceita LIKE 'R-%') THEN (a2.reciboSemFatorR * 0.01)  * r.valorreceita
                	WHEN (o.fatorR = 0) and (nfreceita NOT LIKE 'R-%') THEN ((a2.issSemFatorR + a2.reciboSemFatorR) * 0.01 ) * r.valorreceita 

                	-- VERIFICACAO COM FATOR R 

                	WHEN (o.fatorR = 1) and (nfreceita LIKE 'R-%') THEN (a2.reciboComFatorR * 0.01)  * r.valorreceita
                	WHEN (o.fatorR = 1) and (nfreceita NOT LIKE 'R-%') THEN ((a2.issComFatorR + a2.reciboComFatorR) * 0.01 ) * r.valorreceita 

                END) AS imposto,

                (CASE 
                	WHEN (o.fatorR = 0) and (nfreceita LIKE 'R-%') THEN a2.reciboSemFatorR
                	WHEN (o.fatorR = 0) and (nfreceita NOT LIKE 'R-%') THEN a2.issSemFatorR + a2.reciboSemFatorR

                	-- VERIFICACAO COM FATOR R 

                	WHEN (o.fatorR = 1) and (nfreceita LIKE 'R-%') THEN a2.reciboComFatorR
                	WHEN (o.fatorR = 1) and (nfreceita NOT LIKE 'R-%') THEN a2.issComFatorR + a2.reciboComFatorR

                	ELSE 'Fator Nao Identificado'

                END) AS aliquota, r.datapagamentoreceita, c.nomeConta, r.created_at 

                FROM ordemdeservico o, receita r, aliquotamensal a2, conta c

                where (o.id = r.idosreceita) and
                (a2.idconta = r.contareceita) AND 
                (c.id = r.contareceita) AND 
                (SELECT EXTRACT(YEAR_MONTH FROM r.datapagamentoreceita) as datareceita) = (SELECT REPLACE(a2.mes, '-', '') as periodoaliquota);"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_notasrecibos");
    }
}
