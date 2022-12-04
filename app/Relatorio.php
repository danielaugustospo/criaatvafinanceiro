<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function dadosRelatorioFaturamentoPorCliente($param)
    {
        $stringQuery ="SELECT  
                        c.razaosocialCliente , 
                        os.valorOrdemdeServico,  
                        os.dataCriacaoOrdemdeServico, 
                        r.datapagamentoreceita,
                        -- sum(r.valorreceita) 'valortotal'
                        r.valorreceita  as 'valortotal',
                        r.pagoreceita

                        FROM ordemdeservico os

                        LEFT JOIN clientes   AS c 	ON c.id = os.idClienteOrdemdeServico   
                        LEFT JOIN receita    AS r 	ON r.idosreceita = os.id 

                        -- (os.idClienteOrdemdeServico = c.id) 
                        -- and (os.id = r.idosreceita)

                        -- GROUP BY os.id 
                        " . $param;                

        return $stringQuery;
    }

    public function dadosRelatorioEntradasPorContaBancaria($stringQuery)
    {
        $stringQuery = "SELECT 
                        r.datapagamentoreceita, 
                        r.idosreceita, 


                        CASE
                            WHEN r.idosreceita is NOT NULL THEN os.eventoOrdemdeServico
                            ELSE r.descricaoreceita
                        END AS descricaoreceita,

                        -- r.descricaoreceita, 
                        fpg.nomeFormaPagamento, 
                        r.valorreceita, 
                        cc.nomeConta as conta
                        FROM receita r, formapagamento fpg, conta cc, ordemdeservico os
                        -- LEFT JOIN ordemdeservico   AS os 	ON r.idosreceita = os.id
                        WHERE fpg.id = r.idformapagamentoreceita 
                        and cc.id = r.contareceita
                        and os.id = r.idosreceita
                        and r.ativoreceita  = 1
                        and r.valorreceita  != '0.00'";

        return $stringQuery;
    }

    public function dadosRelatorioDespesasPagasPorContaBancaria($stringQuery)
    {
        $stringQuery = "SELECT DISTINCT 
        d.vencimento,
        d.idOS,
        f.razaosocialFornecedor,
        -- b.descricaoBensPatrimoniais,
        CASE
            WHEN d.ehcompra = 1 THEN b.nomeBensPatrimoniais
            ELSE d.descricaoDespesa
        END AS despesa,
        fpg.nomeFormaPagamento, 
        d.precoReal,
        cod.despesaCodigoDespesa,
        gp.grupoDespesa,
        cc.apelidoConta 
        FROM despesas d
        
        LEFT JOIN fornecedores   AS f 	ON d.idFornecedor = f.id
        LEFT JOIN formapagamento AS fpg ON d.idFormaPagamento = fpg.id
        LEFT JOIN benspatrimoniais AS b ON d.descricaoDespesa = b.id
        LEFT JOIN codigodespesas AS cod ON d.despesaCodigoDespesas = cod.id
        LEFT JOIN grupodespesas AS gp   ON cod.idGrupoCodigoDespesa = gp.id
        LEFT JOIN conta AS cc ON d.conta = cc.id
where d.pago = 'S' ";



        return $stringQuery;
    }

    public function dadosRelatorioDespesasPorOS($stringQuery)
    {
        $stringQuery = 'SELECT os.id as idOS, c.razaosocialCliente, fpg.nomeFormaPagamento, forn.razaosocialFornecedor , os.eventoOrdemdeServico, cod.despesaCodigoDespesa, desp.vencimento, desp.dataDoPagamento, desp.notaFiscal,
        CASE WHEN desp.despesaFixa = 1  THEN "FIXA" ELSE "NÃO FIXA" END as despesaFixa, 
        -- bens.nomeBensPatrimoniais, 
        CASE
            WHEN desp.ehcompra = 1 THEN bens.nomeBensPatrimoniais
            ELSE desp.descricaoDespesa
        END AS despesa,
        desp.precoReal, cc.nomeConta, cc.apelidoConta,  desp.pago,
                CONCAT("N° OS:", os.id, "      - Cliente: ", c.razaosocialCliente, "       - Evento: ", os.eventoOrdemdeServico) AS dados
               FROM ordemdeservico os
                    
               JOIN despesas         	    AS desp ON os.id = desp.idOS 
               LEFT JOIN clientes         	AS c 	ON os.idClienteOrdemdeServico = c.id
               LEFT JOIN benspatrimoniais 	AS bens ON desp.descricaoDespesa = bens.id
               LEFT JOIN conta 			    AS cc  	ON desp.conta = cc.id
               LEFT JOIN codigodespesas 	AS cod	ON desp.despesaCodigoDespesas = cod.id
               LEFT JOIN fornecedores 		AS forn	ON desp.idFornecedor = forn.id
               LEFT JOIN formapagamento   fpg	 ON desp.idFormaPagamento = fpg.id';

        return $stringQuery;
    }

    public function dadosRelatorioOSCadastradas($stringQuery)
    {
        $stringQuery = 'SELECT 
        os.id,
        os.dataCriacaoOrdemdeServico, 
        cli.razaosocialCliente, 
        os.eventoOrdemdeServico 
        FROM 
        ordemdeservico os, clientes cli
        WHERE os.excluidoOrdemdeServico = 0
        AND os.idClienteOrdemdeServico = cli.id
        AND os.ativoOrdemdeServico = 1';

        return $stringQuery;
    }


    public function dadosRelatorioContas($stringQuery, $pago, $nomeFunc)
    {
        $stringQuery = "SELECT 
        desp.dataDoPagamento, 
        desp.idOS,
        desp.vencimento,
        desp.notaFiscal,
        desp.dataDoPagamento,
        cli.razaosocialCliente, 
        func.nomeFuncionario,
        os.eventoOrdemdeServico, 
        forn.razaosocialFornecedor, 
        -- bens.descricaoBensPatrimoniais,
        CASE
            WHEN desp.ehcompra = 1 THEN bens.nomeBensPatrimoniais
            ELSE desp.descricaoDespesa
        END AS despesa,
        fpg.nomeFormaPagamento,
        desp.precoReal,
        gdesp.grupoDespesa,
        cc.apelidoConta,
        CONCAT( 'Nº OS: ', desp.idOS, ' - Cliente: ', cli.razaosocialCliente, ' - Evento: ', os.eventoOrdemdeServico) AS dados,
        desp.pago  
        
        FROM despesas desp
        
        LEFT JOIN benspatrimoniais bens  ON desp.descricaoDespesa = bens.id
        LEFT JOIN fornecedores 	   forn  ON desp.idFornecedor = forn.id
        LEFT JOIN funcionarios 	   func  ON desp.idFuncionario = func.id
        LEFT JOIN formapagamento   fpg	 ON desp.idFormaPagamento = fpg.id
        LEFT JOIN grupodespesas    gdesp ON desp.despesaCodigoDespesas  = gdesp.id
        LEFT JOIN conta cc				 ON desp.conta = cc.id
        LEFT JOIN ordemdeservico	os	 ON desp.idOS = os.id
        LEFT JOIN clientes  		cli	 ON os.idClienteOrdemdeServico = cli.id
        WHERE $pago $nomeFunc";

        return $stringQuery;
    }

    public function dadosReembolso($stringQuery)
    {
        $stringQuery = "SELECT 
        d.dataDoPagamento, 
        forn.razaosocialFornecedor, 
        -- b.nomeBensPatrimoniais,
        CASE
            WHEN d.ehcompra = 1 THEN b.nomeBensPatrimoniais
            ELSE d.descricaoDespesa
        END AS despesa,
        os.eventoOrdemdeServico, 
        fpg.nomeFormaPagamento, 
        d.idOS, 
        d.precoReal 
        
        FROM despesas d 
        
        LEFT JOIN fornecedores     forn  ON d.reembolsado = forn.id
        LEFT JOIN benspatrimoniais b  ON d.descricaoDespesa = b.id
        LEFT JOIN ordemdeservico   os  	 ON d.idOS = os.id
        LEFT JOIN formapagamento   fpg   ON d.idFormaPagamento = fpg.id
        
        WHERE d.reembolsado != '0'";

        return $stringQuery;
    }
    
    public function dadosOrdemdeServicoRecebidas($stringQuery, $parametros)
    {
        $stringQuery = "SELECT 
	
            os.id as 'idOS',
            r.datapagamentoreceita,
            cli.razaosocialCliente,
            clireceita.razaosocialCliente as 'cliente',
            os.eventoOrdemdeServico,
            r.valorreceita,	
            r.nfreceita, 
            cc.apelidoConta as 'conta',
            cc.nomeConta,
            fpg.nomeFormaPagamento,
            os.dataCriacaoOrdemdeServico,
            r.descricaoreceita  
        
        FROM receita r 
    
         LEFT JOIN ordemdeservico os  ON r.idosreceita = os.id
         LEFT JOIN clientes		  cli ON os.idClienteOrdemdeServico = cli.id
         LEFT JOIN clientes		  clireceita ON r.idclientereceita = clireceita.id
         LEFT JOIN conta 	      cc  ON r.contareceita = cc.id
         LEFT JOIN formapagamento fpg ON r.idformapagamentoreceita = fpg.id
         
         WHERE r.pagoreceita = 'S' " . $parametros;

        return $stringQuery;
    }

    public function dadosOrdemdeServicoAReceber($stringQuery, $parametros)
    {
        $stringQuery = "SELECT  
	
        os.id as 'idOS',
        r.datapagamentoreceita,
        cli.razaosocialCliente,
        clireceita.razaosocialCliente as 'cliente',
        os.valorOrdemdeServico, 
        valnaopago.valnpg as 'receitanaopaga',
        valpago.valpg as 'receitapaga',
        os.eventoOrdemdeServico,
        r.nfreceita, 
        cc.apelidoConta,
        fpg.nomeFormaPagamento,
        os.dataCriacaoOrdemdeServico,
        r.descricaoreceita,
        r.pagoreceita
        
        FROM receita r
    
         LEFT JOIN ordemdeservico os  ON r.idosreceita = os.id
         LEFT JOIN clientes		  cli ON os.idClienteOrdemdeServico = cli.id
         LEFT JOIN clientes		  clireceita ON r.idclientereceita = clireceita.id
         LEFT JOIN conta 	      cc  ON r.contareceita = cc.id
         LEFT JOIN formapagamento fpg ON r.idformapagamentoreceita = fpg.id
         
  
   
            LEFT JOIN (SELECT distinct rnpg.idosreceita , valorreceita AS valnpg, rnpg.pagoreceita FROM receita rnpg WHERE rnpg.pagoreceita = 'N' ) AS valnaopago ON os.id = valnaopago.idosreceita
         
         LEFT JOIN (SELECT distinct rpg.idosreceita , sum(rpg.valorreceita) AS valpg, rpg.pagoreceita FROM receita rpg WHERE rpg.pagoreceita = 'S' group by idosreceita) AS valpago ON os.id = valpago.idosreceita 
         
         WHERE r.pagoreceita = 'N'
         and r.idosreceita != 'CRIAATVA'
         and valnaopago.valnpg !='null'
         and valnaopago.valnpg !='' " . $parametros . " group by valnaopago.valnpg";

        return $stringQuery;
    }
    public function dadosContasAReceber($stringQuery, $parametros)
    {
        $stringQuery = "SELECT 
	
        os.id as 'idOS',
        os.dataCriacaoOrdemdeServico, 
        r.datapagamentoreceita,
        cli.razaosocialCliente,
        clireceita.razaosocialCliente as 'cliente',
        os.eventoOrdemdeServico,
        r.valorreceita,	
        r.nfreceita, 
        cc.apelidoConta as 'conta',
        fpg.nomeFormaPagamento,
        os.dataCriacaoOrdemdeServico,
        r.descricaoreceita  
    
        FROM receita r 

        LEFT JOIN ordemdeservico os  ON r.idosreceita = os.id
        LEFT JOIN clientes		  cli ON os.idClienteOrdemdeServico = cli.id
        LEFT JOIN clientes		  clireceita ON r.idclientereceita = clireceita.id
        LEFT JOIN conta 	      cc  ON r.contareceita = cc.id
        LEFT JOIN formapagamento fpg ON r.idformapagamentoreceita = fpg.id
     
        WHERE r.pagoreceita = 'N' 
        and r.ativoreceita  = 1
        and r.valorreceita  != 0
        and r.idosreceita   != ''
        and r.idosreceita   != 'CRIAATVA' " . $parametros;

        return $stringQuery;
    }

    public function dadosReceitaOS($stringQuery)
    {
        $stringQuery ="SELECT 
	
        os.id as 'idOS',
        r.datapagamentoreceita,
        r.dataemissaoreceita,
        cli.razaosocialCliente,
        clireceita.razaosocialCliente as 'cliente',
        os.eventoOrdemdeServico,
        r.valorreceita,	
        r.nfreceita, 
        cc.apelidoConta,
        fpg.nomeFormaPagamento,
        os.dataCriacaoOrdemdeServico,
        os.valorOrdemdeServico,
        r.descricaoreceita,
        CONCAT( 'Nº OS: ', os.id, ' - Data da OS: ', DATE_FORMAT(os.dataCriacaoOrdemdeServico,'%d/%m/%Y'), ' - Valor do Projeto: ', os.valorOrdemdeServico, ' - Cliente: ', cli.razaosocialCliente, ' - Evento: ', os.eventoOrdemdeServico) AS dados,
        r.pagoreceita  
    
        FROM receita r 

         LEFT JOIN ordemdeservico os  ON r.idosreceita = os.id
         LEFT JOIN clientes		  cli ON os.idClienteOrdemdeServico = cli.id
         LEFT JOIN clientes		  clireceita ON r.idclientereceita = clireceita.id
         LEFT JOIN conta 	      cc  ON r.contareceita = cc.id
         LEFT JOIN formapagamento fpg ON r.idformapagamentoreceita = fpg.id
         where os.id != '' ";

        return $stringQuery;

    }

    public function dadosFechamentoFinal($stringQuery)
    {
        $stringQuery ="SELECT 
	
        os.id as 'idOS',
        os.dataCriacaoOrdemdeServico,
        cli.razaosocialCliente,
        os.eventoOrdemdeServico,
        os.valorOrdemdeServico, 
        COALESCE(valdesp.valpg, '0') as custo,
        os.valorOrdemdeServico - COALESCE(valdesp.valpg, '0') as 'lucro',
        (os.valorOrdemdeServico - COALESCE(valdesp.valpg, '0')) * 100 / (os.valorOrdemdeServico) as 'porcentagem',
        valpago.valpg,
        CASE WHEN os.valorOrdemdeServico <= valpago.valpg  THEN 'S' ELSE 'N' END as status
         
    	FROM ordemdeservico os

	    LEFT JOIN clientes		  cli ON os.idClienteOrdemdeServico = cli.id
	    LEFT JOIN (SELECT distinct desp2.idOS, sum(desp2.precoReal) AS valpg FROM despesas desp2 WHERE desp2.excluidoDespesa = '0' group by idOS) AS valdesp ON os.id = valdesp.idOS
	    LEFT JOIN (SELECT distinct rpg.idosreceita , sum(rpg.valorreceita) AS valpg, rpg.pagoreceita FROM receita rpg WHERE rpg.pagoreceita = 'S' group by idosreceita) AS valpago ON os.id = valpago.idosreceita 

      where os.id != ''";

    return $stringQuery;

    }

    public function dadosDespesaProjecaoTrimestral($stringQuery, $mes, $ano)
    {
        $stringQuery ="SELECT 
		
		despprimeiromes.id as idpri,
		despprimeiromes.razaosocialFornecedor as razaosocialFornecedorpri,
		despprimeiromes.descricaoBensPatrimoniais as descricaoBensPatrimoniaispri,
        despprimeiromes.apelidoConta as apelidoContapri,
		despprimeiromes.vencimento as vencimentopri,
				
        despsegundomes.id as idseg,
        despsegundomes.razaosocialFornecedor as razaosocialFornecedorseg,
        despsegundomes.descricaoBensPatrimoniais as descricaoBensPatrimoniaisseg,
        despsegundomes.apelidoConta as apelidoContaseg,
        despsegundomes.vencimento as vencimentoseg,

        despterceiromes.id as idterc,
        despterceiromes.razaosocialFornecedor as razaosocialFornecedorterc,
        despterceiromes.descricaoBensPatrimoniais as descricaoBensPatrimoniaisterc,
        despterceiromes.apelidoConta as apelidoContaterc,
        despterceiromes.vencimento as vencimentoterc
              
        FROM despesas d
        
        	-- inicio primeiro
            RIGHT JOIN (SELECT 
		    d.id,
		    d.vencimento,
		    f.razaosocialFornecedor, 
		    b.descricaoBensPatrimoniais,
		    cc.apelidoConta
		    
		    FROM despesas as d
		    
		    LEFT JOIN fornecedores  AS f ON d.idFornecedor = f.id
		    LEFT JOIN benspatrimoniais AS b ON d.descricaoDespesa = b.id
		    LEFT JOIN conta AS cc ON d.conta = cc.id 
		    where d.pago = 'N' and d.idOS = 'CRIAATVA'
        	and d.vencimento like '$ano[0]-$mes[0]%') AS despprimeiromes on d.id = despprimeiromes.id
            -- inicio segundo
            RIGHT JOIN (SELECT 
		    d.id,
		    d.vencimento,
		    f.razaosocialFornecedor, 
		    -- b.descricaoBensPatrimoniais,
            CASE
                WHEN d.ehcompra = 1 THEN b.nomeBensPatrimoniais
                ELSE d.descricaoDespesa
            END AS despesa,
		    cc.apelidoConta
		    
		    FROM despesas as d
		    
		    LEFT JOIN fornecedores  AS f ON d.idFornecedor = f.id
		    LEFT JOIN benspatrimoniais AS b ON d.descricaoDespesa = b.id
		    LEFT JOIN conta AS cc ON d.conta = cc.id 
		    where d.pago = 'N' and d.idOS = 'CRIAATVA'
        	and d.vencimento like '$ano[1]-$mes[1]%') AS despsegundomes on d.id = despsegundomes.id
            -- inicio terceiro
            RIGHT JOIN (SELECT 
		    d.id,
		    d.vencimento,
		    f.razaosocialFornecedor, 
		    b.nomeBensPatrimoniais,
		    cc.apelidoConta
		    
		    FROM despesas as d
		    
		    LEFT JOIN fornecedores  AS f ON d.idFornecedor = f.id
		    LEFT JOIN benspatrimoniais AS b ON d.descricaoDespesa = b.id
		    LEFT JOIN conta AS cc ON d.conta = cc.id 
		    where d.pago = 'N' and d.idOS = 'CRIAATVA'
        	and d.vencimento like '$ano[2]-$mes[2]%') AS despterceiromes on d.id = despterceiromes.id";

        var_dump($stringQuery);
        exit;
    }

    public function dadosFluxoDeCaixa($mes, $ano, $conta)
    {

        $stringQuery ="SELECT 	
            selecionageral.*
            FROM (
            
            SELECT id, dtoperacao, historico, idosreceita, apelidoConta as conta, idconta, valorreceita, pagoreceita, nomeFormaPagamento,
            SUM(valorreceita) OVER (PARTITION BY conta order by dtoperacao) AS saldo,
            
            CASE
		        WHEN dtoperacao BETWEEN '".$ano[0]."-".$mes[0]."-01' and '".$ano[0]."-".$mes[0]."-31' THEN valorreceita
		        ELSE '0.0'
		    END AS primeiromes,
            
		    CASE
		        WHEN dtoperacao BETWEEN '".$ano[1]."-".$mes[1]."-01' and '".$ano[1]."-".$mes[1]."-31' THEN valorreceita
		        ELSE '0.0'
		    END AS segundomes,
            
		    CASE
		        WHEN dtoperacao BETWEEN '".$ano[2]."-".$mes[2]."-01' and '".$ano[2]."-".$mes[2]."-31' THEN valorreceita
		        ELSE '0.0'
		    END AS terceiromes		
            
                from ((select `receita`.`id`, `receita`.`datapagamentoreceita` as dtoperacao, `receita`.`descricaoreceita` as historico, `conta`.`apelidoConta`, conta.id as idconta, `receita`.`valorreceita`,
                 `receita`.`idosreceita`, `receita`.`pagoreceita` , formapagamento.nomeFormaPagamento 

                from receita 

                inner join conta on `receita`.`contareceita` = `conta`.`id`
                inner join formapagamento on `receita`.`idformapagamentoreceita` = `formapagamento`.`id`) 
                union all (select `despesas`.`id`, `despesas`.`vencimento` as dtoperacao, `despesas`.`descricaoDespesa` as historico, `conta`.`apelidoConta`, conta.id as idconta, `despesas`.`precoReal` * (-1),
                 `despesas`.`idOS`, `despesas`.`pago` as pagoreceita, formapagamento.nomeFormaPagamento

                from despesas

                inner join conta on `despesas`.`conta` = `conta`.`id`
                inner join formapagamento on `despesas`.`idFormaPagamento` = `formapagamento`.`id`)) as x 

                where 
                -- (pagoreceita = 'N' or pagoreceita = '0') and 
                historico != '' 
                -- group by id
                order by dtoperacao
                ) as selecionageral


                WHERE idconta ='".$conta."' and selecionageral.dtoperacao  BETWEEN '".$ano[0]."-".$mes[0]."-01' AND '".$ano[2]."-".$mes[2]."-31'";
        
        // var_dump($stringQuery);
        // exit;
                return $stringQuery;
    }

    public function dadosReceitaProjecaoTrimestral($stringQuery, $mes, $ano)
    {
        $stringQuery ="SELECT 
            recprimeiromes.datapagamentoreceita as datapagamentoreceitapri,
            recprimeiromes.razaosocialCliente as razaosocialClientepri,
            recprimeiromes.valorreceita as valorreceitapri,
            recprimeiromes.apelidoConta as apelidoContapri,
            recprimeiromes.descricaoreceita as descricaoreceitapri,

            recsegundomes.datapagamentoreceita as datapagamentoreceitaseg,
            recsegundomes.razaosocialCliente as razaosocialClienteseg,
            recsegundomes.valorreceita as valorreceitaseg,
            recsegundomes.apelidoConta as apelidoContaseg,
            recsegundomes.descricaoreceita as descricaoreceitaseg,

            recterceiromes.datapagamentoreceita as datapagamentoreceitaterc,
            recterceiromes.razaosocialCliente as razaosocialClienteterc,
            recterceiromes.valorreceita as valorreceitaterc,
            recterceiromes.apelidoConta as apelidoContaterc,
            recterceiromes.descricaoreceita as descricaoreceitaterc

                FROM receita r
                RIGHT JOIN (
                    SELECT
                        r.id,
                        r.datapagamentoreceita,
                        clireceita.razaosocialCliente,
                        r.valorreceita,	
                        cc.apelidoConta,
                        r.descricaoreceita
                
                    FROM receita r 
                
                    LEFT JOIN clientes		  clireceita ON r.idclientereceita = clireceita.id
                    LEFT JOIN conta 	      cc  ON r.contareceita = cc.id
                    LEFT JOIN formapagamento fpg ON r.idformapagamentoreceita = fpg.id
                    where r.idosreceita = 'CRIAATVA' and r.pagoreceita = 'N' 
                    and r.datapagamentoreceita like '$ano[0]-$mes[0]%') as recprimeiromes on r.id = recprimeiromes.id
                RIGHT JOIN (
                    SELECT
                        r.id,
                        r.datapagamentoreceita,
                        clireceita.razaosocialCliente,
                        r.valorreceita,	
                        cc.apelidoConta,
                        r.descricaoreceita
                
                    FROM receita r 
                
                    LEFT JOIN clientes		  clireceita ON r.idclientereceita = clireceita.id
                    LEFT JOIN conta 	      cc  ON r.contareceita = cc.id
                    LEFT JOIN formapagamento fpg ON r.idformapagamentoreceita = fpg.id
                    where r.idosreceita = 'CRIAATVA' and r.pagoreceita = 'N' 
                    and r.datapagamentoreceita like '$ano[1]-$mes[1]%') as recsegundomes on r.id = recsegundomes.id
                RIGHT JOIN (
                    SELECT
                        r.id,
                        r.datapagamentoreceita,
                        clireceita.razaosocialCliente,
                        r.valorreceita,	
                        cc.apelidoConta,
                        r.descricaoreceita
                
                    FROM receita r 
                
                    LEFT JOIN clientes		  clireceita ON r.idclientereceita = clireceita.id
                    LEFT JOIN conta 	      cc  ON r.contareceita = cc.id
                    LEFT JOIN formapagamento fpg ON r.idformapagamentoreceita = fpg.id
                    where r.idosreceita = 'CRIAATVA' and r.pagoreceita = 'N' 
                    and r.datapagamentoreceita like '$ano[2]-$mes[2]%') as recterceiromes on r.id = recterceiromes.id";

             return $stringQuery;

    }
    
    public function contaCorrente()
    {
        $stringQuery ="SELECT 
        d.vencimento  as datamov,
        d.descricaoDespesa as 'historico',
        os.eventoOrdemdeServico as 'evento',
        fpg.nomeFormaPagamento as 'formapag',
        os.id as 'idOS',
        (d.precoReal * (-1)) as 'valor',
        c.nomeConta as 'conta' 
        
        from despesas d
        LEFT JOIN ordemdeservico os  ON d.idOS = os.id
        LEFT JOIN formapagamento fpg ON d.idFormaPagamento = fpg.id
        LEFT JOIN conta c ON d.conta = c.id
        where d.pago = 'S'

        UNION
        SELECT 
        datapagamentoreceita as datamov,
        descricaoreceita as 'historico',
        os.eventoOrdemdeServico as 'evento', 
        fpg.nomeFormaPagamento as 'formapag',
        os.id as 'idOS',
        valorreceita as 'valor',
        c.nomeConta as 'conta'
        
        from receita r
        
        LEFT JOIN ordemdeservico os  ON r.idosreceita = os.id
        LEFT JOIN formapagamento fpg ON r.idformapagamentoreceita = fpg.id
        LEFT JOIN conta c ON r.contareceita = c.id
        where r.pagoreceita = 'S'
        
        order by datamov";
        return $stringQuery;
    }
		
}


