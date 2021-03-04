<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomeestoque',
        'descricaoestoque',
        'idbenspatrimoniais',
        'ativadoestoque',
        'excluidoestoque'
        ];
}


