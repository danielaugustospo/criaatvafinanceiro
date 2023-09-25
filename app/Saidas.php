<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Estoque;

class Saidas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'nomesaida',
        'descricaosaida',
        'idbenspatrimoniais',
        'quantidade_saida',
        'excluidosaida',
        'portador',
        'ordemdeservico',
        'datapararetirada',
        'dataretirada',
        'datapararetorno',
        'ocorrencia',
        'id_estoque',
        'itemporcionavel',
    ];

    public function estoque()
    {
        return $this->belongsTo('App\Estoque', 'id_estoque');
    }

    public function entradas()
    {
        return $this->belongsTo('App\Entradas', 'id_saida');
    }

    public function listaSaidas($id = null)
    {
        $query = $this->select([
            's.*', 'e.codbarras',
            \DB::raw('DATEDIFF(CURDATE(), s.dataretirada) AS qtddiasemprestado'),
            \DB::raw("CASE
                WHEN DATEDIFF(CURDATE(), s.datapararetorno) = 0 THEN 'Devolver hoje'
                WHEN DATEDIFF(CURDATE(), s.datapararetorno) > 0 THEN CONCAT(DATEDIFF(CURDATE(), s.datapararetorno), ' dia(s) atrasado')
                WHEN DATEDIFF(CURDATE(), s.datapararetorno) < 0 THEN CONCAT(DATEDIFF(CURDATE(), s.datapararetorno) * (-1), ' dia(s) restante(s)')
                ELSE 'Sem contagem disponível'
                END as qtddiaspararetorno"),
            'b.nomeBensPatrimoniais'
        ])
        ->from('saidas AS s')
        ->leftJoin('estoque AS e', 's.id_estoque', '=', 'e.id')
        ->leftJoin('benspatrimoniais AS b', 'e.idbenspatrimoniais', '=', 'b.id')
        ->whereNull('s.deleted_at');
    
        if ($id !== null) {
            $query->where('s.id', $id);
        }
    
        return $query;
    }
    

    public function disponivelEmEstoque()
    {
        $listaInventario = Estoque::select('estoque.id', 'estoque.idbenspatrimoniais', \DB::raw('SUM(estoque.quantidade) as quantidade'), 'estoque.descricao', 'benspatrimoniais.nomeBensPatrimoniais')
            ->leftJoin('benspatrimoniais', 'estoque.idbenspatrimoniais', '=', 'benspatrimoniais.id')
            ->where('estoque.quantidade', '>', 0)
            ->where('ativadoestoque', 1)
            ->whereNull('estoque.deleted_at')
            ->groupBy('estoque.idbenspatrimoniais')
            ->get();


        return $listaInventario;
    }
}
