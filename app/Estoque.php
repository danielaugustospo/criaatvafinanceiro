<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoque';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codbarras',
        'nomematerial',
        'descricao',
        'idbenspatrimoniais',
        'ativadoestoque',
        'excluidoestoque'
        ];
}


