<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Clientes extends Model
{

    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'nomeCliente',
        'contatoCliente',
        'razaosocialCliente',
        'siteCliente',
        'cepCliente',
        'enderecoCliente',
        'bairroCliente',
        'cidadeCliente',
        'estadoCliente',
        'telefone1Cliente',
        'telefone2Cliente',
        'cnpjCliente',
        'inscEstadualCliente',
        'cpfCliente',
        'identidadeCliente',
        'emailCliente',
        'dataCadastroCliente',
        'bancoCliente',
        'nrcontaCliente',
        'agenciaCliente',
        'bancoFavorecidoCliente',
        'nomefavorecidoCliente',
        'cpffavorecidoCliente',
        'contacorrentefavorecidoCliente',
        'nrcontafavorecidoCliente',
        'agenciafavorecidoCliente',
        'ativoCliente',
        'excluidoCliente',
        // 'created_at'

    ];


}
