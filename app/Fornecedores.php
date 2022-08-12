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

        'contacorrenteFornecedor1',
        'contacorrenteFornecedor2',
        'contacorrenteFornecedor3',

    ];

    public static function laratablesCustomAction($tabelaFornecedoresModel)
    {
        return view('fornecedores.action', compact('tabelaFornecedoresModel'))->render();
    }

    public function dadosRelatorio($stringQueryExtrato)
    {
        $stringQueryExtrato = "SELECT 
        os.id, 
        os.dataCriacaoOrdemdeServico, 
        os.eventoOrdemdeServico, 
        os.valorOrdemdeServico, 
        SUM(CASE WHEN receita.idosreceita = os.id and receita.pagoreceita = 'S' THEN receita.valorreceita ELSE 0 END) as 'receitapaga',
        SUM(CASE WHEN receita.idosreceita = os.id and receita.pagoreceita = 'N' THEN receita.valorreceita ELSE 0 END) as 'valorareceber'
        
        from ordemdeservico os, receita, clientes 
        
        GROUP by os.id
        ";
        return $stringQueryExtrato;
    }

}
