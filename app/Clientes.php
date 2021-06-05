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

        'contacorrenteCliente1',
        'bancoCliente1',
        'nrcontaCliente1',
        'agenciaCliente1',
        'chavePixCliente1',

        'contacorrenteCliente2',
        'bancoCliente2',
        'nrcontaCliente2',
        'agenciaCliente2',
        'chavePixCliente2',

        'contacorrenteCliente3',
        'bancoCliente3',
        'nrcontaCliente3',
        'agenciaCliente3',
        'chavePixCliente3',

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
