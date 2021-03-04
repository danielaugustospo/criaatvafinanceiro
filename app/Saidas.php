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
        'portadorsaida',
        'datapararetiradasaida',
        'dataretiradasaida',
        'dataretornoretiradasaida',
        'ocorrenciasaida',
        'ativadosaida',
        'excluidosaida'
        ];
}


