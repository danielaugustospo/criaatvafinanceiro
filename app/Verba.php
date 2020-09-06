<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Verba extends Model
{

    protected $table = 'verba';

    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'idFormaPagamento',
        'dataPagamento',
        'descricaoVerba',
        'dataEmissao',
        'valorVerba',
        'pagamentoVerba',
        'contaVerba',
        'registroVerba',
        'emissaoVerba',
        'nfVerba',
        'valorTotalVerba',
        'idOSVerba',
        'ativoVerba',
        'excluidoVerba',

    ];


}
