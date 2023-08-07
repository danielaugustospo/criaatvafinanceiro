<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saidas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomesaida',
        'descricaosaida',
        'idbenspatrimoniais',
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
        return $this->belongsTo('App\Estoque', 'estoque_id');
    }
}


