<?php

namespace App\Http\Controllers;

use App\CodigoDespesa;
use App\Despesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
// use Freshbitsweb\Laratables\Laratables;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Providers\AppServiceProvider;
use App\Providers\FormatacoesServiceProvider;
use Illuminate\Support\Facades\App;
use App\Classes\Logger;
use Auth;


class DespesaController extends Controller
{
    private $Enc;
    private $Logger;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:despesa-list|despesa-create|despesa-edit|despesa-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:despesa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:despesa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:despesa-delete', ['only' => ['destroy']]);

        //Importação do Logger
        $this->Logger = new Logger();

        $this->acao =  request()->segment(count(request()->segments()));
        $this->valorInput = null;
        $this->valorSemCadastro = null;


        if ($this->acao == 'create') {
            $this->valorInput = " ";
            $this->valorSemCadastro = "0";
            $this->variavelReadOnlyNaView = "";
            $this->variavelDisabledNaView = "";
        } elseif ($this->acao == 'edit') {
            $this->variavelReadOnlyNaView = "";
            $this->variavelDisabledNaView = "";
        } elseif ($this->acao != 'edit' && $this->acao != 'create') {
            $this->variavelReadOnlyNaView = "readonly";
            $this->variavelDisabledNaView = 'disabled';
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $consulta = $this->consultaIndexDespesa();
        
        if ($request->ajax()) {

            return Datatables::of($consulta)
                ->addIndexColumn()
                ->addColumn('action', function($consulta) {

                $btnVisualizar = '<div class="row col-sm-12">
                    <a href="despesas/' .  $consulta->id . '" class="edit btn btn-primary btn-lg" title="Visualizar Despesa">Visualizar</a>
                </div>';

                return $btnVisualizar;
                })

                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('despesas.index', compact('consulta'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }


    public function apidespesas(Request $request)
    {
        $data = Despesa::all();
        $listaDespesas = DB::select('SELECT d.id, 
        c.despesaCodigoDespesa,
        b.nomeBensPatrimoniais, 
        d.idOS, 
        f.razaosocialFornecedor,
        d.vencimento, 
        d.precoReal, 
        d.vale,
        d.datavale,
        d.precoReal - d.vale as despesareal,
        d.notaFiscal,
        cc.nomeConta,
        cc.apelidoConta
        
        
        FROM despesas d, fornecedores f, codigodespesas c, benspatrimoniais b, conta cc
        WHERE  
        d.idFornecedor = f.id
        AND
        d.despesaCodigoDespesas =  c.id 
        AND 
        d.descricaoDespesa = b.id
        AND 
        cc.id = d.conta 
        
        AND excluidoDespesa = 0');

        return $listaDespesas;
    }

    public function tabelaDespesas(Request $request){

        $consulta = $this->consultaIndexDespesa();

        return Datatables::of($consulta)
        ->filter(function ($query) use ($request) {


            if (($request->has('idOS')) && ($request->idOS != NULL)) {
                $query->where('idOS', '=', "{$request->get('idOS')}");
            }
            if (($request->has('descricaoDespesa')) && ($request->descricaoDespesa != NULL)) {
                $query->where('descricaoDespesa', '=', "{$request->get('descricaoDespesa')}");
            }
            if (($request->has('precoReal')) && ($request->precoReal != NULL)) {
                $query->where('precoReal', '=', "{$request->get('precoReal')}");
            }
            if (($request->has('notaFiscal')) && ($request->notaFiscal != NULL)) {
                $query->where('notaFiscal', 'like', "{$request->get('notaFiscal')}%");
            }
            if (($request->has('idFornecedor')) && ($request->idFornecedor != NULL)) {
                $query->where('idFornecedor', '=', "{$request->get('idFornecedor')}");
            }
            if (($request->has('vencimento')) && ($request->vencimento != NULL)) {
                $query->where('vencimento', '=', "{$request->get('vencimento')}");
            }
            if (($request->buscaDataInicio != null) && ($request->buscaDataFim != null)) {
                $query->whereDate('vencimento', ">=", "{$request->buscaDataInicio}")
                    ->whereDate('vencimento', "<=", "{$request->buscaDataFim}");
            }
        })
        ->addIndexColumn()
        ->addColumn('action', function($consulta) {

        $btnVisualizar = '<div class="row col-sm-12">
            <a href="despesas/' .  $consulta->id . '" class="edit btn btn-primary btn-lg" title="Visualizar Despesa">Visualizar</a>
        </div>';

        return $btnVisualizar;
        })
    
        ->rawColumns(['action'])
        ->make(true);

    }

    public function consultaIndexDespesa()
    {
        $consulta = DB::table('despesas')
        ->join('benspatrimoniais as bens', 'despesas.descricaoDespesa', 'bens.id')
        ->join('codigodespesas as cod', 'despesas.despesaCodigoDespesas', 'cod.id')
        ->join('fornecedores as forn', 'despesas.idFornecedor', 'forn.id')

        ->select(['despesas.id','bens.nomeBensPatrimoniais as descricaoDespesa','cod.despesaCodigoDespesa as codDespesa','despesas.precoReal as precoReal', 'despesas.idFornecedor', 'forn.razaosocialFornecedor','despesas.vencimento as vencimento','despesas.notaFiscal as notaFiscal','despesas.idOS as idOS']);    
        return $consulta;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaContas = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1');
        // $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');
        $codigoDespesa = DB::select('select c.id,  c.despesaCodigoDespesa, c.idGrupoCodigoDespesa, g.grupoDespesa from codigodespesas c, grupodespesas g 
        where (c.ativoCodigoDespesa = 1) and (g.id = c.idGrupoCodigoDespesa) order by c.id');

        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');
        $todasOSAtivas = DB::select('SELECT x.* FROM ordemdeservico x WHERE ativoOrdemdeServico = 1');
        $todosOSBancos = DB::select('SELECT * FROM banco WHERE ativoBanco = 1');
        $precoReal = " ";
        $vale = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;
        return view('despesas.create', compact('listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'todosOSBancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $despesa = new Despesa();

        $request->validate([

            'descricaoDespesa'          => 'required',
            'idFormaPagamento'          => 'required',
            'conta'                     => 'required',
            'despesaFixa'               => 'required',
        ]);

        $verificaCompra =  $request->get('a');
        if($verificaCompra == 'S'){ $despesa->ehcompra = 1; } else { $despesa->ehcompra = 0; }
        $compraparcelada =  $request->get('compraparcelada');

        $despesa->idFuncionario         =  $request->get('idFuncionario');
        $despesa->idFornecedor          =  $request->get('idFornecedor');
        $despesa->idFormaPagamento      =  $request->get('idFormaPagamento');
        $despesa->conta                 =  $request->get('conta');
        $despesa->precoReal             =  $request->get('precoReal');
        $despesa->dataDaCompra          =  $request->get('dataDaCompra');
        $despesa->dataDoTrabalho        =  $request->get('dataDoTrabalho');
        $despesa->quemcomprou           =  $request->get('quemcomprou');
        $despesa->idBanco               =  $request->get('idBanco');
        $despesa->cheque                =  $request->get('cheque');
        $despesa->reembolsado           =  $request->get('reembolsado');
        $despesa->despesaFixa           =  $request->get('despesaFixa');
        $despesa->nRegistro             =  $request->get('nRegistro');
        $despesa->despesaCodigoDespesas =  $request->get('despesaCodigoDespesas');
        $despesa->ativoDespesa          =  $request->get('ativoDespesa');
        $despesa->excluidoDespesa       =  $request->get('excluidoDespesa');
        $despesa->vale                  =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('vale'));
        $despesa->datavale              =  $request->get('datavale');
        $despesa->idDespesaPai          =  $request->get('idDespesaPai');
        $despesa->ativoDespesa          =  $request->get('ativoDespesa');
        $despesa->excluidoDespesa       =  $request->get('excluidoDespesa');
        $despesa->idAutor               =  auth()->user()->id;


        if ($compraparcelada == 'S') {
            $quantidade = $request->get('quantidadeTabela');
            $tamanhoArrayQuantidade = count($quantidade);

            for ($i = 0; $i < $tamanhoArrayQuantidade; $i++) {
                $despesa = new Despesa();

                $despesa->idOS                  =  $request->get('idOSTabela')[$i];
                $despesa->vencimento            =  $request->get('vencimentoTabela')[$i];
                $despesa->notaFiscal            =  $request->get('notaFiscalTabela')[$i];
                $despesa->pago                  =  $request->get('pagoTabela')[$i];
                $despesa->quantidade            =  $request->get('quantidadeTabela')[$i];
                $despesa->valorUnitario         =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorUnitarioTabela')[$i]);

                $despesa->valorparcela          =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorparcelaTabela')[$i]);
                $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorparcelaTabela')[$i]);
                $despesa->descricaoDespesa      =  $request->get('descricaoTabela')[$i];

                $despesa->idFornecedor          =  $request->get('selecionaFornecedor');
                $despesa->idFormaPagamento      =  $request->get('idFormaPagamento');
                $despesa->conta                 =  $request->get('conta');
                $despesa->dataDaCompra          =  $request->get('dataDaCompra');
                $despesa->dataDoTrabalho        =  $request->get('dataDoTrabalho');
                $despesa->quemcomprou           =  $request->get('quemcomprou');
                $despesa->idBanco               =  $request->get('idBanco');
                $despesa->cheque                =  $request->get('cheque');
                $despesa->reembolsado           =  $request->get('reembolsado');
                $despesa->despesaFixa           =  $request->get('despesaFixa');
                $despesa->nRegistro             =  $request->get('nRegistro');
                $despesa->despesaCodigoDespesas =  $request->get('despesaCodigoDespesas');
                $despesa->ativoDespesa          =  $request->get('ativoDespesa');
                $despesa->excluidoDespesa       =  $request->get('excluidoDespesa');
                $despesa->vale                  =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('vale'));
                $despesa->datavale              =  $request->get('datavale');
                $despesa->idDespesaPai          =  $request->get('idDespesaPai');
                $despesa->ativoDespesa          =  $request->get('ativoDespesa');
                $despesa->excluidoDespesa       =  $request->get('excluidoDespesa');


                $despesa->save();
                $this->logCadastraDespesas($despesa);
            }
        } elseif ($compraparcelada == 'N') {

            $despesa->idOS                  =  $request->get('idOS');
            $despesa->vencimento            =  $request->get('vencimento');
            $despesa->notaFiscal            =  $request->get('notaFiscal');
            $despesa->pago                  =  $request->get('pago')[0];
            $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('precoReal'));
            $despesa->descricaoDespesa      =  $request->get('descricaoDespesa');

            $despesa->save();
            $this->logCadastraDespesas($despesa);

        } elseif (($compraparcelada != 'N') && ($compraparcelada != 'S')) {
            return redirect()->route('despesas.index')
                ->with('error', 'Ocorreu um erro ao salvar.');
        }

        return redirect()->route('despesas.index')
            ->with('success', 'Despesa cadastrada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $despesa = Despesa::find($id);

        $listaContas  = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1 order by id = :conta desc', ['conta' => $despesa->conta]);

        $codigoDespesa = DB::select('select c.id,  c.despesaCodigoDespesa, c.idGrupoCodigoDespesa, g.grupoDespesa from codigodespesas c, grupodespesas g 
        where (c.ativoCodigoDespesa = 1) and (g.id = c.idGrupoCodigoDespesa) order by c.id = :codigoCadastrado desc', ['codigoCadastrado' => $despesa->despesaCodigoDespesas]);

        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1 order by id = :idFornecedor desc', ['idFornecedor' => $despesa->idFornecedor]);
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 order by id = :idFormaPagamento desc', ['idFormaPagamento' => $despesa->idFormaPagamento]);
        $todasOSAtivas = DB::select('SELECT x.* FROM ordemdeservico x WHERE ativoOrdemdeServico = 1 order by id = :idOS desc', ['idOS' => $despesa->idOS]);
        $listabancos = DB::select('SELECT * FROM banco WHERE ativoBanco = 1 order by id = :idBanco desc', ['idBanco' => $despesa->idBanco]);
        $valorDespesa = $despesa->precoReal;
        $valorVale = $despesa->vale;
        $precoReal = FormatacoesServiceProvider::validaValoresParaView($valorDespesa);
        $vale = FormatacoesServiceProvider::validaValoresParaView($valorVale);

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;


        $this->logVisualizaDespesas($despesa);

        return view('despesas.show', compact('despesa', 'idUsuario', 'listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'listabancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $despesa = Despesa::find($id);

        $listaContas  = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1 order by id = :conta desc', ['conta' => $despesa->conta]);

        $codigoDespesa = DB::select('select c.id,  c.despesaCodigoDespesa, c.idGrupoCodigoDespesa, g.grupoDespesa from codigodespesas c, grupodespesas g 
        where (c.ativoCodigoDespesa = 1) and (g.id = c.idGrupoCodigoDespesa) order by c.id = :codigoCadastrado desc', ['codigoCadastrado' => $despesa->despesaCodigoDespesas]);

        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 order by id = :idFormaPagamento desc', ['idFormaPagamento' => $despesa->idFormaPagamento]);
        $todasOSAtivas = DB::select('SELECT x.* FROM ordemdeservico x WHERE ativoOrdemdeServico = 1 order by id = :idOS desc', ['idOS' => $despesa->idOS]);
        $listabancos = DB::select('SELECT * FROM banco WHERE ativoBanco = 1 order by id = :idBanco desc', ['idBanco' => $despesa->idBanco]);

        $valorDespesa = $despesa->precoReal;
        $valorVale = $despesa->vale;
        $precoReal = FormatacoesServiceProvider::validaValoresParaView($valorDespesa);
        $vale = FormatacoesServiceProvider::validaValoresParaView($valorVale);

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('despesas.edit', compact('despesa', 'listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'listabancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Despesa $despesa)
    {
        request()->validate([
            'descricaoDespesa'          => 'required',
            'idFormaPagamento'          => 'required',
            'conta'                     => 'required',
            'despesaFixa'               => 'required',
        ]);

        $valorMonetario                  = $request->get('precoReal');
        $quantia = FormatacoesServiceProvider::validaValoresParaBackEnd($valorMonetario);

        $despesa->idOS                       = $request->get('idOS');
        $despesa->idDespesaPai               = $request->get('idDespesaPai');
        $despesa->descricaoDespesa           = $request->get('descricaoDespesa');
        $despesa->despesaCodigoDespesas      = $request->get('despesaCodigoDespesas');
        $despesa->idFuncionario              = $request->get('idFuncionario');
        $despesa->idFornecedor               = $request->get('idFornecedor');
        $despesa->precoReal                  = $quantia;
        $despesa->ehcompra                   = $request->get('ehcompra');
        $despesa->pago                       = $request->get('pago');
        $despesa->reembolsado                = $request->get('reembolsado');
        $despesa->idFormaPagamento           = $request->get('idFormaPagamento');
        $despesa->conta                      = $request->get('conta');
        $despesa->nRegistro                  = $request->get('nRegistro');
        $despesa->dataDaCompra               = $request->get('dataDaCompra');
        $despesa->dataDoTrabalho             = $request->get('dataDoTrabalho');
        $despesa->vencimento                 = $request->get('vencimento');
        $despesa->datavale                   = $request->get('datavale');
        $despesa->vale                       = FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('vale'));
        $despesa->despesaFixa                = $request->get('despesaFixa');
        $despesa->notaFiscal                 = $request->get('notaFiscal');
        $despesa->idBanco                    = $request->get('idBanco');
        $despesa->cheque                     = $request->get('cheque');
        $despesa->ativoDespesa               = $request->get('ativoDespesa');
        $despesa->excluidoDespesa            = $request->get('excluidoDespesa');
        $despesa->idAlteracaoUsuario         = auth()->user()->id;


        $original   = $despesa->getOriginal();
        $despesa->update();
        $alteracoes = $despesa->getChanges();

        $this->logAtualizaDespesas($despesa, $alteracoes, $original);
        
        return redirect()->route('despesas.index')
            ->with('success', 'Despesa atualizada com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $despesa->id = Despesa::find($id);
        Despesa::find($id)->delete();

        $this->logExcluiDespesas($despesa);

        return redirect()->route('despesas.index')
            ->with('success', 'Despesa excluída com êxito!');
    }


    public function listaCodigoDespesa()
    {
        $listaCodigoDespesa = DB::select('SELECT c.id, c.despesaCodigoDespesa, g.grupoDespesa 
        FROM codigodespesas c, grupodespesas g 
        WHERE (c.excluidoCodigoDespesa = 0) 
        and (c.ativoCodigoDespesa = 1) 
        and (c.idGrupoCodigoDespesa = g.id) 
        order by c.despesaCodigoDespesa');

        view()->share('listaCodigoDespesa', $listaCodigoDespesa);
        echo json_encode($listaCodigoDespesa);
    }

    public function listaMateriais()
    {
        $listaBensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais where ativadobenspatrimoniais = 1');
        echo json_encode($listaBensPatrimoniais);
    }

    public function listaFornecedores()
    {
        $listaFornecedores =  DB::select('SELECT * from fornecedores where ativoFornecedor = 1');
        echo json_encode($listaFornecedores);
    }

    public function logCadastraDespesas($despesa = null)
    {
            $this->Logger->log('info', 'Cadastrou a despesa '. $despesa->id);
    }

    public function logVisualizaDespesas($despesa = null)
    {
            $this->Logger->log('info', 'Visualizou a despesa '. $despesa->id);
    }

    public function logAtualizaDespesas($despesa = null, $alteracoes, $original)
    {   
        $trechoMensagem =  $despesa->id . " Dados Alterados: " . PHP_EOL;
        if(isset($alteracoes['despesaCodigoDespesas']) != NULL)  { $trechoMensagem .= 'Id Cod Desp Atual: '.       $alteracoes['despesaCodigoDespesas'] .    '. Antigo: '.  $original['despesaCodigoDespesas'] . PHP_EOL  ; }
        if(isset($alteracoes['idOS']) != NULL )                  { $trechoMensagem .= 'Id OS Atual: '.             $alteracoes['idOS'] .                     '. Antigo: '.  $original['idOS'] . PHP_EOL  ; }
        if(isset($alteracoes['idDespesaPai']) != NULL )          { $trechoMensagem .= 'Id Desp Pai Atual: '.       $alteracoes['idDespesaPai'] .             '. Antigo: '.  $original['idDespesaPai'] . PHP_EOL  ; }
        if(isset($alteracoes['descricaoDespesa']) != NULL )      { $trechoMensagem .= 'Desc Desp Atual: '.         $alteracoes['descricaoDespesa'] .         '. Antigo: '.  $original['descricaoDespesa'] . PHP_EOL  ; }
        if(isset($alteracoes['idFornecedor']) != NULL )          { $trechoMensagem .= 'Id Fornecedor Atual: '.     $alteracoes['idFornecedor'] .             '. Antigo: '.  $original['idFornecedor'] . PHP_EOL  ; }
        if(isset($alteracoes['precoReal']) != NULL )             { $trechoMensagem .= 'Valor Atual: '.             $alteracoes['precoReal'] .                '. Antigo: '.  $original['precoReal'] . PHP_EOL  ; }
        if(isset($alteracoes['ehcompra']) != NULL )              { $trechoMensagem .= 'Foi uma compra Atual: '.    $alteracoes['ehcompra'] .                 '. Antigo: '.  $original['ehcompra'] . PHP_EOL  ; }
        if(isset($alteracoes['pago']) != NULL )                  { $trechoMensagem .= 'Pago Atual: '.              $alteracoes['pago'] .                     '. Antigo: '.  $original['pago'] . PHP_EOL  ; }
        if(isset($alteracoes['quempagou']) != NULL )             { $trechoMensagem .= 'Quem Pagou Atual: '.        $alteracoes['quempagou'] .                '. Antigo: '.  $original['quempagou'] . PHP_EOL  ; }
        if(isset($alteracoes['idFormaPagamento']) != NULL )      { $trechoMensagem .= 'Forma PG Atual: '.          $alteracoes['idFormaPagamento'] .         '. Antigo: '.  $original['idFormaPagamento'] . PHP_EOL  ; }
        if(isset($alteracoes['conta']) != NULL )                 { $trechoMensagem .= 'Id Conta Atual: '.          $alteracoes['conta'] .                    '. Antigo: '.  $original['conta'] . PHP_EOL  ; }
        if(isset($alteracoes['nRegistro']) != NULL )             { $trechoMensagem .= 'Num Reg Atual: '.           $alteracoes['nRegistro'] .                '. Antigo: '.  $original['nRegistro'] . PHP_EOL  ; }
        if(isset($alteracoes['valorEstornado']) != NULL )        { $trechoMensagem .= 'Estornado Atual: '.         $alteracoes['valorEstornado'] .           '. Antigo: '.  $original['valorEstornado'] . PHP_EOL  ; }
        if(isset($alteracoes['vencimento']) != NULL )            { $trechoMensagem .= 'Vencimento Atual: '.        $alteracoes['vencimento'] .               '. Antigo: '.  $original['vencimento'] . PHP_EOL  ; }
        if(isset($alteracoes['despesaFixa']) != NULL )           { $trechoMensagem .= 'Desp Fixa Atual: '.         $alteracoes['despesaFixa'] .              '. Antigo: '.  $original['despesaFixa'] . PHP_EOL  ; }
        if(isset($alteracoes['notaFiscal']) != NULL )            { $trechoMensagem .= 'Nota Fiscal Atual: '.       $alteracoes['notaFiscal'] .               '. Antigo: '.  $original['notaFiscal'] . PHP_EOL  ; }
        if(isset($alteracoes['idBanco']) != NULL )               { $trechoMensagem .= 'Id Banco Atual: '.          $alteracoes['idBanco'] .                  '. Antigo: '.  $original['idBanco'] . PHP_EOL  ; }
        if(isset($alteracoes['reembolsado']) != NULL )           { $trechoMensagem .= 'Id Reembolsado Atual: '.    $alteracoes['reembolsado'] .              '. Antigo: '.  $original['reembolsado'] . PHP_EOL  ; }
        if(isset($alteracoes['cheque']) != NULL )                { $trechoMensagem .= 'Cheque Atual: '.            $alteracoes['cheque'] .                   '. Antigo: '.  $original['cheque'] . PHP_EOL  ; }
        if(isset($alteracoes['dataDoTrabalho']) != NULL )        { $trechoMensagem .= 'Data do Trabalho Atual: '.  $alteracoes['dataDoTrabalho'] .           '. Antigo: '.  $original['dataDoTrabalho'] . PHP_EOL  ; }
        if(isset($alteracoes['dataDaCompra']) != NULL )          { $trechoMensagem .= 'Data da Compra Atual: '.    $alteracoes['dataDaCompra'] .             '. Antigo: '.  $original['dataDaCompra'] . PHP_EOL  ; }
        if(isset($alteracoes['ativoDespesa']) != NULL )          { $trechoMensagem .= 'Despesa Ativa Atual: '.     $alteracoes['ativoDespesa'] .             '. Antigo: '.  $original['ativoDespesa'] . PHP_EOL  ; }
        if(isset($alteracoes['excluidoDespesa']) != NULL )       { $trechoMensagem .= 'Despesa Excluída Atual: '.  $alteracoes['excluidoDespesa'] .          '. Antigo: '.  $original['excluidoDespesa'] . PHP_EOL  ; }
        if(isset($alteracoes['idFuncionario']) != NULL )        { $trechoMensagem .= 'Tipo Fornecedor Atual: '.   $alteracoes['idFuncionario'] .           '. Antigo: '.  $original['idFuncionario'] . PHP_EOL  ; }
        if(isset($alteracoes['idAlteracaoUsuario']) != NULL )    { $trechoMensagem .= 'Id Alter. Usuario Atual: '. $alteracoes['idAlteracaoUsuario'] .       '. Antigo: '.  $original['idAlteracaoUsuario'] . PHP_EOL  ; }
        if(isset($alteracoes['idAutor']) != NULL )               { $trechoMensagem .= 'Id Usuario Autor Atual: '.  $alteracoes['idAutor'] .                  '. Antigo: '.  $original['idAutor'] . PHP_EOL  ; }
        
        $this->Logger->log('info', 'Atualizou a despesa '.  $trechoMensagem);
    }

    public function logExcluiDespesas($despesa = null)
    {
        $this->Logger->log('info', 'Excluiu a despesa '. $despesa->id);
    }

}
