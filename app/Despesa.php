<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Despesa extends Model
{

    protected $table = 'despesas';

    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    'idCodigoDespesas',
    'idOS',
    'descricaoDespesa',
    'despesaCodigoDespesas',
    'idFornecedor',
    'precoReal',
    'atuacao',
    'precoCliente',
    'pago',
    'quempagou',
    'idFormaPagamento',
    'conta',
    'nRegistro',
    'valorEstornado',
    'data',
    'totalPrecoReal',
    'totalPrecoCliente',
    'lucro',
    'ativoDespesa',
    'excluidoDespesa',

    ];

    public static function laratablesCustomAction($despesaModel)
    {
        return view('despesas.action', compact('despesaModel'))->render();
    }


}
