<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Fornecedores extends Model
{


    protected $table = 'fornecedores';

    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'nomeFornecedor',
        'contatoFornecedor',
        'razaosocialFornecedor',
        'siteFornecedor',
        'cepFornecedor',
        'enderecoFornecedor',
        'bairroFornecedor',
        'cidadeFornecedor',
        'estadoFornecedor',
        'telefone1Fornecedor',
        'telefone2Fornecedor',
        'cnpjFornecedor',
        'inscEstadualFornecedor',
        'cpfFornecedor',
        'identidadeFornecedor',
        'emailFornecedor',
        'dataCadastroFornecedor',
        'bancoFornecedor',
        'nrcontaFornecedor',
        'agenciaFornecedor',
        'bancoFavorecidoFornecedor',
        'nomefavorecidoFornecedor',
        'cpffavorecidoFornecedor',
        'contacorrentefavorecidoFornecedor',
        'nrcontafavorecidoFornecedor',
        'agenciafavorecidoFornecedor',
        'ativoFornecedor',
        'excluidoFornecedor',
        // 'created_at'

    ];


}
