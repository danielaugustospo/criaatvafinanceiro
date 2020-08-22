<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BensPatrimoniais extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomeBensPatrimoniais',
        'idTipoBensPatrimoniais',
        'descricaoBensPatrimoniais',
        'ativadoBensPatrimoniais',
        'excluidoBensPatrimoniais'
        ];
}
