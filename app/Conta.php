<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Response;


class Conta extends Model
{

    protected $table = 'conta';

    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    'apelidoConta',
    'nomeConta',
    'ativoConta',
    'excluidoConta',

    ];


    public static function laratablesCustomAction($contasModel)
    {
        return view('contas.action', compact('contasModel'))->render();
    }

    public function dadosRelatorio($stringQueryExtrato, $complemento)
    {
        $stringQueryExtrato = "SELECT 	
        selecionageral.*
        FROM (
    
        SELECT id, dtoperacao, historico, idosreceita, apelidoConta as conta, idconta, valorreceita, pagoreceita, nomeFormaPagamento,
        SUM(valorreceita) OVER (PARTITION BY conta order by dtoperacao, id) AS saldo, created_at
    
            from ((select concat('C-',`receita`.`id`) as id, `receita`.`datapagamentoreceita` as dtoperacao, 
                        
            `receita`.`descricaoreceita` as historico, 
            
            `conta`.`apelidoConta`, conta.id as idconta, `receita`.`valorreceita`,
             `receita`.`idosreceita`, `receita`.`pagoreceita` , formapagamento.nomeFormaPagamento, receita.created_at
            
            from receita 
            
            inner join conta on `receita`.`contareceita` = `conta`.`id`
            inner join formapagamento on `receita`.`idformapagamentoreceita` = `formapagamento`.`id`) 
            union all (select concat('D-',`despesas`.`id`) as id, `despesas`.`vencimento` as dtoperacao, 
   
            
            
            CASE
            WHEN despesas.ehcompra = 1 and (despesas.insereestoque IS NULL or despesas.insereestoque = 1) THEN b.nomeBensPatrimoniais
            ELSE despesas.descricaoDespesa
        END AS historico,
            
            
            `conta`.`apelidoConta`, conta.id as idconta, `despesas`.`precoReal` * (-1),
             `despesas`.`idOS`, `despesas`.`pago` as pagoreceita, formapagamento.nomeFormaPagamento, despesas.created_at
            
            from despesas
            
            inner join conta on `despesas`.`conta` = `conta`.`id`
            inner join formapagamento on `despesas`.`idFormaPagamento` = `formapagamento`.`id`
            LEFT JOIN  benspatrimoniais  AS b    ON despesas.descricaoDespesa = b.id

            
            where `despesas`.`excluidoDespesa` = 0)) as x 
            
            where (pagoreceita = 'S' or pagoreceita = '1') 
            and historico != '' 
            -- group by id
            order by dtoperacao
            ) as selecionageral
            $complemento " ;

        return $stringQueryExtrato;
    }

    public function dadosRelatorioAReceberPorOS($stringQueryExtrato)
    {
        $stringQueryExtrato = "SELECT 
        os.id, 
        os.dataCriacaoOrdemdeServico, 
        os.eventoOrdemdeServico, 
        os.valorOrdemdeServico, 
        SUM(CASE WHEN receita.idosreceita = os.id and receita.pagoreceita = 'S' THEN receita.valorreceita ELSE 0 END) as 'receitapaga',
        SUM(CASE WHEN receita.idosreceita = os.id and receita.pagoreceita = 'N' THEN receita.valorreceita ELSE 0 END) as 'valorareceber'
        
        from ordemdeservico os, receita, clientes 
        
        GROUP by os.id";
        return $stringQueryExtrato;
    }

}
