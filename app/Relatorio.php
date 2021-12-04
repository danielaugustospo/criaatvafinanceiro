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
        $stringQuery = "SELECT DISTINCT 
                        c.razaosocialCliente , 
                        os.valorOrdemdeServico,  
                        sum(r.valorreceita) 'valortotal'

                        FROM ordemdeservico os, receita r, clientes c
                        WHERE (os.idClienteOrdemdeServico = c.id) 
                        and (os.id = r.idosreceita)
                        AND (r.pagoreceita = '$param')
                            
                        GROUP BY os.id ";

        return $stringQuery;
    }

    public function dadosRelatorioEntradasPorContaBancaria($stringQuery)
    {
        $stringQuery = "SELECT 
                        r.datapagamentoreceita, 
                        r.idosreceita, 
                        r.descricaoreceita, 
                        fpg.nomeFormaPagamento, 
                        r.valorreceita, 
                        cc.nomeConta as conta
                        FROM receita r, formapagamento fpg, conta cc
                        WHERE fpg.id = r.idformapagamentoreceita and cc.id = r.contareceita ";

        return $stringQuery;
    }

    public function dadosRelatorioDespesasPagasPorContaBancaria($stringQuery)
    {
        $stringQuery = "SELECT DISTINCT 
        d.vencimento,
        d.idOS,
        f.razaosocialFornecedor,
        b.descricaoBensPatrimoniais,
        fpg.nomeFormaPagamento, 
        d.precoReal,
        cod.despesaCodigoDespesa,
        cc.apelidoConta 
        FROM despesas d
        
        LEFT JOIN fornecedores   AS f 	ON d.idFornecedor = f.id
        LEFT JOIN formapagamento AS fpg ON d.idFormaPagamento = fpg.id
        LEFT JOIN benspatrimoniais AS b ON d.descricaoDespesa = b.id
        LEFT JOIN codigodespesas AS cod ON d.despesaCodigoDespesas = cod.id
        LEFT JOIN conta AS cc ON d.conta = cc.id";

        return $stringQuery;
    }

    public function dadosRelatorioDespesasPorOS($stringQuery)
    {
        $stringQuery = 'SELECT os.id as idOS, c.razaosocialCliente, fpg.nomeFormaPagamento, forn.razaosocialFornecedor , os.eventoOrdemdeServico, g.grupoDespesa, desp.vencimento, desp.dataDoPagamento, desp.notaFiscal,
        CASE WHEN desp.despesaFixa = 1  THEN "FIXA" ELSE "NÃO FIXA" END as despesaFixa, bens.nomeBensPatrimoniais, desp.precoReal, cc.nomeConta, cc.apelidoConta,  desp.pago,
                CONCAT("N° OS:", os.id, "      - Cliente: ", c.razaosocialCliente, "       - Evento: ", os.eventoOrdemdeServico) AS dados
               FROM ordemdeservico os
                    
               JOIN despesas         	    AS desp ON os.id = desp.idOS 
               LEFT JOIN clientes         	AS c 	ON os.idClienteOrdemdeServico = c.id
               LEFT JOIN benspatrimoniais 	AS bens ON desp.descricaoDespesa = bens.id
               LEFT JOIN conta 			    AS cc  	ON desp.conta = cc.id
               LEFT JOIN grupodespesas 	    AS g	ON desp.despesaCodigoDespesas = g.id
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
        cli.razaosocialCliente, 
        func.nomeFuncionario,
        os.eventoOrdemdeServico, 
        forn.razaosocialFornecedor, 
        bens.descricaoBensPatrimoniais,
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
        bens.nomeBensPatrimoniais,
        os.eventoOrdemdeServico, 
        fpg.nomeFormaPagamento, 
        d.idOS, 
        d.precoReal 
        
        FROM despesas d 
        
        LEFT JOIN fornecedores     forn  ON d.reembolsado = forn.id
        LEFT JOIN benspatrimoniais bens  ON d.descricaoDespesa = bens.id
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
        $stringQuery = "SELECT DISTINCT 
	
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
         LEFT JOIN (SELECT distinct rnpg.idosreceita , sum(rnpg.valorreceita) AS valnpg, rnpg.pagoreceita FROM receita rnpg WHERE rnpg.pagoreceita = 'N' group by idosreceita) AS valnaopago ON os.id = valnaopago.idosreceita
         LEFT JOIN (SELECT distinct rpg.idosreceita , sum(rpg.valorreceita) AS valpg, rpg.pagoreceita FROM receita rpg WHERE rpg.pagoreceita = 'S' group by idosreceita) AS valpago ON os.id = valpago.idosreceita 
         WHERE r.pagoreceita = 'N'
         and r.idosreceita != 'CRIAATVA'" . $parametros;

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
     where os.id != ''";

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
        CASE WHEN os.valorOrdemdeServico <= valpago.valpg  THEN 'PAGO' ELSE 'NÃO PAGO' END as status
         
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
		    b.descricaoBensPatrimoniais,
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
		    b.descricaoBensPatrimoniais,
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
		
}


