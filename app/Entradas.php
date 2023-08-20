<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Entradas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codbarras',
        'descricaoentrada',
        'id_estoque',
        'quantidade_entrada',
        'idbenspatrimoniais',
        'valorunitarioentrada',
        'dtdevolucao',
        'excluidoentrada',
        'quemdevolveu',
        'ocorrenciadevolucao'
        ];


        public function estoque()
        {
            return $this->belongsTo('App\Estoque', 'id_estoque');
        }

        public function listaEntradas()
        {
            return $this->select('entradas.*', 'benspatrimoniais.nomeBensPatrimoniais', 'estoque.codbarras')
                ->leftJoin('estoque', 'entradas.id_estoque', '=', 'estoque.id')
                ->leftJoin('benspatrimoniais', 'estoque.idbenspatrimoniais', '=', 'benspatrimoniais.id')
                ->whereNull('entradas.deleted_at')
                ->addSelect(\DB::raw('CASE WHEN entradas.dtdevolucao IS NULL THEN "NOVO" ELSE "DEVOLUÇÃO" END as tipo'));
        }
        
}


