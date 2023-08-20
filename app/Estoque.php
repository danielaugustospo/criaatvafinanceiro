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
        'quantidade',
        'idbenspatrimoniais',
        'ativadoestoque',
        'excluidoestoque'
        ];

        public function bensPatrimoniais()
        {
            return $this->belongsTo(BensPatrimoniais::class, 'idbenspatrimoniais', 'id');
        }
}


