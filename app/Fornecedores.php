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
        'inscMunicipalFornecedor',
        'cpfFornecedor',
        'identidadeFornecedor',
        'emailFornecedor',
        // 'dataContratoFornecedor',

        'bancoFornecedor1',
        'nrcontaFornecedor1',
        'agenciaFornecedor1',
        'chavePixFornecedor1',

        'bancoFornecedor2',
        'nrcontaFornecedor2',
        'agenciaFornecedor2',
        'chavePixFornecedor2',

        'bancoFornecedor3',
        'nrcontaFornecedor3',
        'agenciaFornecedor3',
        'chavePixFornecedor3',

        'ativoFornecedor',
        'excluidoFornecedor',
        // 'created_at'

    ];

    public static function laratablesCustomAction($tabelaFornecedoresModel)
    {
        return view('fornecedores.action', compact('tabelaFornecedoresModel'))->render();
    }

}
