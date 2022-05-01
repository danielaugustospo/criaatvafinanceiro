<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Funcionario extends Model
{

    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'funcionarios';

     
    protected $fillable = [

    'nomeFuncionario',
    'cepFuncionario',
    'enderecoFuncionario',
    'bairroFuncionario',
    'cidadeFuncionario',
    'ufFuncionario',
    'celularFuncionario',
    'telresidenciaFuncionario',
    'contatoemergenciaFuncionario',
    'emailFuncionario',
    'redesocialFuncionario',
    'facebookFuncionario',
    'telegramFuncionario',
    'cpfFuncionario',
    'rgFuncionario',
    'orgaoRGFuncionario',
    'expedicaoRGFuncionario',
    'tituloFuncionario',
    'maeFuncionario',
    'paiFuncionario',
    'profissaoFuncionario',
    'cargoEmpresaFuncionario',
    'tipocontratoFuncionario',
    'grauescolaridadeFuncionario',
    'descformacaoFuncionario',
    'certficFuncionario',
    'uncertificadoraFuncionario',
    'anocertificacaoFuncionario',

    'contacorrenteFuncionario1',
    'bancoFuncionario1',
    'nrcontaFuncionario1',
    'agenciaFuncionario1',
    'chavePixFuncionario1',

    'contacorrenteFuncionario2',
    'bancoFuncionario2',
    'nrcontaFuncionario2',
    'agenciaFuncionario2',
    'chavePixFuncionario2',
    
    'nomefavorecidoFuncionario',
    'cpffavorecidoFuncionario',
    'contacorrentefavorecidoFuncionario',
    'bancofavorecidoFuncionario',
    'nrcontafavorecidoFuncionario',
    'agenciafavorecidoFuncionario',
    'fotoFuncionario',
    'ativoFuncionario',
    'excluidoFuncionario'
    ];


}
