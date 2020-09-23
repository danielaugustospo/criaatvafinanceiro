<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BensPatrimoniais extends Model
{

    protected $table = 'benspatrimoniais';

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
        'excluidoBensPatrimoniais',
        'statusbenspatrimoniais'
        ];
}
