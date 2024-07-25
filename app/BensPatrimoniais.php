<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BensPatrimoniais extends Model
{
    protected $table = 'benspatrimoniais';

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
        return $this->belongsTo(Product::class, 'idTipoBensPatrimoniais', 'id')->withDefault([
            'id' => null,
            'name' => null,
            'detail' => null,
            'ativotipobenspatrimoniais' => null,
            'excluidotipobenspatrimoniais' => null,
            'created_at' => null,
            'updated_at' => null
        ]);
    }

    public function unidademedida()
    {
        return $this->belongsTo(UnidadeMedida::class, 'unidademedida', 'id')->withDefault([
            'id' => null,
            'sigla' => null,
            'nomeunidade' => null
        ]);
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class, 'idbenspatrimoniais');
    }
}
