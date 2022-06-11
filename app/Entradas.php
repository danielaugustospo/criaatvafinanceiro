<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'qtdeEntrada',
        'idbenspatrimoniais',
        'valorunitarioentrada',
        // 'ativoentrada',
        'dtdevolucao',
        'excluidoentrada',
        'quemdevolveu',
        'ocorrenciadevolucao'
        ];
}


