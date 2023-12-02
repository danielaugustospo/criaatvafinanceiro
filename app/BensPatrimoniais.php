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
        'statusbenspatrimoniais',
        'qtdestoqueminimo',
        'unidademedida',
        'estante',
        'prateleira'
        ];


    public function tipo()
    {
        return $this->belongsTo(Product::class, 'idTipoBensPatrimoniais', 'id');
    }

    public function unidademedida()
    {
        return $this->belongsTo(UnidadeMedida::class, 'unidademedida', 'id');
    }
}
