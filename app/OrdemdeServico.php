<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class OrdemdeServico extends Model
{

    protected $table = 'ordemdeservico';

    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'nomeFormaPagamento',
    'idClienteOrdemdeServico',
    'dataVendaOrdemdeServico',
    'valorTotalOrdemdeServico',
    'valorProjetoOrdemdeServico',
    'valorOrdemdeServico',
    'dataOrdemdeServico',
    'clienteOrdemdeServico',
    'eventoOrdemdeServico',
    'servicoOrdemdeServico',
    'obsOrdemdeServico',
    'dataCriacaoOrdemdeServico',
    'dataExclusaoOrdemdeServico',


    'ativoOrdemdeServico',
    'excluidoOrdemdeServico',

    ];


}
