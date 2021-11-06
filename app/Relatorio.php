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
}


