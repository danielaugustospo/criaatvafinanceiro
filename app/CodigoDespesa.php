<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class CodigoDespesa extends Model
{

    protected $table = 'codigodespesas';

    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    'despesaCodigoDespesa',
    'idGrupoCodigoDespesa',
    'ativoCodigoDespesa',
    'excluidoCodigoDespesa',

    ];

    public function codigoDespesa(){
        // return $this->query("SELECT * FROM codigodespesas WHERE (excluidoCodigoDespesa = 0) and (ativoCodigoDespesa = 1) order by id");
        return 78;

    }

    public static function laratablesCustomAction($codigoDespesasModel)
    {
        return view('codigodespesas.action', compact('codigoDespesasModel'))->render();
    }


    public function grupoDespesa()
    {
        return $this->BelongsTo(GrupoDespesa::class, 'idGrupoCodigoDespesa');
    }
}
