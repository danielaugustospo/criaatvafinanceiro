<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class FormaPagamento extends Model
{

    protected $table = 'formapagamento';

    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    'nomeFormaPagamento',
    'ativoFormaPagamento',
    'excluidoFormaPagamento',

    ];


    public static function laratablesCustomAction($formaPagamentoModel)
    {
        return view('formapagamentos.action', compact('formaPagamentoModel'))->render();
    }

}
