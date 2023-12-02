<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadeMedida extends Model
{
    protected $table = 'unidademedida';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sigla',
        'nomeunidade'
        ];

}


