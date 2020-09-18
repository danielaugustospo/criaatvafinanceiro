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

    public static function laratablesCustomAction($codigoDespesasModel)
    {
        return view('codigodespesas.action', compact('codigoDespesasModel'))->render();
    }

}
