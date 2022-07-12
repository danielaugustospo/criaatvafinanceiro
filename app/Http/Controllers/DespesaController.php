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
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use App\Estoque;

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
        if ($request->get('id')) {
            $iddespesa = $request->get('id');
            settype($iddespesa, "integer");
            $this->show($iddespesa);

            $despesas = Despesa::where('id', $iddespesa)->where('excluidoDespesa', 0)->get();
            if(count($despesas) == 1){
                header("Location: despesas/$iddespesa");
                exit();
            }
            else{
                return redirect()->route('despesas.index')
                        ->with('warning', 'Depesa '. $iddespesa .' é um dado excluído, ou uma despesa inexistente, não podendo ser acessado');
            }
        }
        $validacoesPesquisa = $this->validaPesquisa($request);

        $despesas       = $validacoesPesquisa[0];
        $valor          = $validacoesPesquisa[1];
        $dtinicio       = $validacoesPesquisa[2];
        $dtfim          = $validacoesPesquisa[3];
        $coddespesa     = $validacoesPesquisa[4];
        $fornecedor     = $validacoesPesquisa[5];
        $ordemservico   = $validacoesPesquisa[6];
        $conta          = $validacoesPesquisa[7];
        $notafiscal     = $validacoesPesquisa[8];
        $cliente        = $validacoesPesquisa[9];
        $fixavariavel   = $validacoesPesquisa[10];
        $pago           = $validacoesPesquisa[11];

        $rota = $this->verificaRelatorio($request);

        return view($rota, compact('consulta', 'despesas', 'valor', 'dtinicio', 'dtfim', 'coddespesa', 'fornecedor', 'ordemservico', 'conta', 'notafiscal', 'cliente', 'fixavariavel', 'pago'));
    }


    public function apidespesas(Request $request)
    {
        // TODO: Montar filtro genérico de despesas

        $descricao = $this->montaFiltrosConsulta($request);

        $listaDespesas = DB::select('SELECT distinct d.id, 
        c.despesaCodigoDespesa,
        g.grupoDespesa,
        CASE
            WHEN d.ehcompra = 1 THEN b.nomeBensPatrimoniais
            ELSE d.descricaoDespesa
        END AS descricaoDespesa,
        CASE 
            WHEN d.despesaFixa = 1  THEN "FIXA" 
            ELSE "NÃO FIXA" 
        END as despesaFixa,
        CONCAT("N° OS:", os.id, "      - Cliente: ", cli.razaosocialCliente, "       - Evento: ", os.eventoOrdemdeServico) AS dados,
        d.idOS, 
        f.razaosocialFornecedor,
        fun.nomeFuncionario,
        d.vencimento, 
        d.dataDoPagamento, 
        d.precoReal, 
        d.vale,
        d.datavale,
        d.pago,
        d.precoReal - d.vale as despesareal,
        d.notaFiscal,
        cc.nomeConta,
        cc.apelidoConta,
        os.eventoOrdemdeServico,
        fpg.nomeFormaPagamento
        
        
        FROM despesas d  

        LEFT JOIN fornecedores      AS f 	ON d.idFornecedor = f.id
        LEFT JOIN funcionarios      AS fun 	ON d.idFuncionario = fun.id
        LEFT JOIN codigodespesas    AS c    ON d.despesaCodigoDespesas = c.id
        LEFT JOIN conta             AS cc   ON d.conta = cc.id
        LEFT JOIN ordemdeservico    AS os   ON d.idOS = os.id
        LEFT JOIN grupodespesas     AS g    ON c.idGrupoCodigoDespesa = g.id
        LEFT JOIN formapagamento    AS fpg  ON d.idFormaPagamento = fpg.id
        LEFT JOIN benspatrimoniais  AS b    ON d.descricaoDespesa = b.id
        LEFT JOIN clientes          AS cli  ON os.idClienteOrdemdeServico = cli.id
     
        
        WHERE d.excluidoDespesa = 0 ' . $descricao);

        return $listaDespesas;

    }

    private function montaFiltrosConsulta($request)
    {
        $descricao = "";
        $verificaInputCampos = 0;
        if ($request->despesas) :     $descricao .= " AND d.descricaoDespesa like  '%$request->despesas%'";
            $verificaInputCampos++;
        endif;

        if ($request->coddespesa) :   $descricao .= " AND c.despesaCodigoDespesa like  '%$request->coddespesa%'";
            $verificaInputCampos++;
        endif;
        if ($request->fornecedor) :   $descricao .= " AND f.razaosocialFornecedor like  '%$request->fornecedor%'";
            $verificaInputCampos++;
        endif;
        if ($request->ordemservico) : $descricao .= " AND d.idOS = '$request->ordemservico'";
            $verificaInputCampos++;
        endif;
        if ($request->valor) :        $descricao .= " AND d.precoReal = '$request->valor'";
            $verificaInputCampos++;
        endif;
        if ($request->conta) :        $descricao .= " AND cc.apelidoConta = '$request->conta'";
            $verificaInputCampos++;
        endif;
        if ($request->prolabore) : $descricao .= " AND (fun.nomeFuncionario != '') and (c.id = 33)";
            $verificaInputCampos++;
        endif;
        if ($request->reembolso) : $descricao .= " AND d.reembolsado != '0'";
            $verificaInputCampos++;
        endif;


        if ($request->notafiscal) : $descricao  .= " AND d.notaFiscal = '$request->notafiscal'";
            $verificaInputCampos++;
        endif;
        if ($request->cliente) : $descricao     .= " AND os.idClienteOrdemdeServico = '$request->cliente'";
            $verificaInputCampos++;
        endif;
        if ($request->fixavariavel) : $descricao .= " AND d.despesaFixa = '$request->fixavariavel'";
            $verificaInputCampos++;
        endif;
        if ($request->pago) :        $descricao .= " AND d.pago = '$request->pago'";
            $verificaInputCampos++;
        endif;


        if ($request->dtfim) :        $datafim    = $request->dtfim;
        elseif ($verificaInputCampos == 0) : $datafim = date('Y-m-t');
        endif;

        if ($request->dtinicio) :     $descricao .= " AND d.vencimento BETWEEN  '$request->dtinicio' and '$datafim'";
        elseif ($verificaInputCampos == 0) :   $datainicio = date('Y-m') . '-01';
            $descricao .= " AND d.vencimento BETWEEN  '$datainicio' and '$datafim'";
        endif;
        return $descricao;
    }

    private function validaPesquisa($request)
    {
        if ($request->get('despesas')) :     $despesas = $request->get('despesas');
        else : $despesas = '';
        endif;
        if ($request->get('valor')) :        $valor = FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valor'));
        else : $valor = '';
        endif;
        if ($request->get('dtinicio')) :     $dtinicio = $request->get('dtinicio');
        else : $dtinicio = '';
        endif;
        if ($request->get('dtfim')) :        $dtfim = $request->get('dtfim');
        else : $dtfim = '';
        endif;
        if ($request->get('coddespesa')) :   $coddespesa = $request->get('coddespesa');
        else : $coddespesa = '';
        endif;
        if ($request->get('fornecedor')) :   $fornecedor = $request->get('fornecedor');
        else : $fornecedor = '';
        endif;
        if ($request->get('ordemservico')) : $ordemservico = $request->get('ordemservico');
        else : $ordemservico = '';
        endif;
        if ($request->get('conta')) :        $conta = $request->get('conta');
        else : $conta = '';
        endif;
        if ($request->get('notafiscal')) :    $notafiscal = $request->get('notafiscal');
        else : $notafiscal = '';
        endif;
        if ($request->get('cliente')) :       $cliente = $request->get('cliente');
        else : $cliente = '';
        endif;
        if ($request->get('fixavariavel')) :  $fixavariavel = $request->get('fixavariavel');
        else : $fixavariavel = '';
        endif;
        if ($request->get('pago')) :        $pago = $request->get('pago');
        else : $pago = '';
        endif;

        $solicitacaoArray = array($despesas, $valor, $dtinicio, $dtfim, $coddespesa, $fornecedor, $ordemservico, $conta, $notafiscal, $cliente, $fixavariavel, $pago);
        return $solicitacaoArray;
    }

    private function verificaRelatorio($request)
    {

        $rotaRetorno = 'despesas.index';

        if ($request->get('tpRel') ==  'pesquisadespesascompleto') :
            $rotaRetorno = 'despesas.completo';

        elseif ($request->get('tpRel') ==  'fornecedor') :
            $rotaRetorno = 'relatorio.fornecedor.index';

        elseif ($request->get('tpRel') ==  'pclienteanalitico') :
            $rotaRetorno = 'relatorio.despesasporclienteanalitico.index';

        elseif ($request->get('tpRel') ==  'contasapagarporgrupo') :
            $rotaRetorno = 'relatorio.contasapagarporgrupo.index';

        elseif ($request->get('tpRel') ==  'contaspagasporgrupo') :
            $rotaRetorno = 'relatorio.contaspagasporgrupo.index';

        elseif ($request->get('tpRel') ==  'despesasfixavariavel') :
            $rotaRetorno = 'relatorio.despesasfixavariavel.index';

        elseif ($request->get('tpRel') ==  'notafiscalfornecedor') :
            $rotaRetorno = 'relatorio.notafiscalfornecedor.index';

        elseif ($request->get('tpRel') ==  'despesaspagasporcontabancaria') :
            $rotaRetorno = 'relatorio.despesaspagasporcontabancaria.index';

        elseif ($request->get('tpRel') ==  'despesasporos') :
            $rotaRetorno = 'relatorio.despesasporos.index';

        elseif ($request->get('tpRel') ==  'despesasporosplanilha') :
            $rotaRetorno = 'relatorio.despesasporosplanilha.index';

        elseif ($request->get('tpRel') ==  'despesassinteticaporos') :
            $rotaRetorno = 'relatorio.despesassinteticaporos.index';

        elseif ($request->get('tpRel') ==  'prolabore') :
            $rotaRetorno = 'relatorio.prolabore.index';

        elseif ($request->get('tpRel') ==  'reembolso') :
            $rotaRetorno = 'relatorio.reembolso.index';

        endif;

        return $rotaRetorno;
    }

    public function tabelaDespesas(Request $request)
    {

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
            ->addColumn('action', function ($consulta) {

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

            ->select(['despesas.id', 'bens.nomeBensPatrimoniais as descricaoDespesa', 'cod.despesaCodigoDespesa as codDespesa', 'despesas.precoReal as precoReal', 'despesas.idFornecedor', 'forn.razaosocialFornecedor', 'despesas.vencimento as vencimento', 'despesas.notaFiscal as notaFiscal', 'despesas.idOS as idOS']);
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

            'idFormaPagamento'          => 'required',
            'conta'                     => 'required',
            'despesaFixa'               => 'required',
        ]);

        $verificaCompra =  $request->get('a');

        if ($verificaCompra == 'S') : $despesa->ehcompra = 1;
        else :
            $request->validate(
                ['descricaoDespesaNaoCompra' => 'required'],
                ['descricaoDespesaNaoCompra.required' => 'Informe a descrição da despesa']
            );
            $despesa->ehcompra = 0;

            $despesa->descricaoDespesa =  $request->get('descricaoDespesaNaoCompra');

        endif;

        $compraparcelada =  $request->get('compraparcelada');

        $despesa->idFuncionario         =  $request->get('idFuncionario');
        $despesa->idFornecedor          =  $request->get('idFornecedor');
        $despesa->idFormaPagamento      =  $request->get('idFormaPagamento');
        $despesa->conta                 =  $request->get('conta');
        $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('precoReal'));
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

            // var_dump($request->get('descricaoTabela')[0]);
            // exit;

            for ($i = 0; $i < $tamanhoArrayQuantidade; $i++) {
                $despesa = new Despesa();

                // $request->validate(
                //     [$request->get('descricaoTabela')[$i] => 'required'], ['descricaoTabela.required' => 'Informe os itens comprados']
                // );
                $despesa->ehcompra              =  1;
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
                // if($request->inserirestoque == 'S'){
                //     $salvaEstoque  = Estoque::create([
                //         'codbarras'             => 'CRIAATVAD00'.$despesa->id,
                //         'idbenspatrimoniais'    => $despesa->descricaoDespesa,
                //         'ativadoestoque'        => 1,
                //         'excluidoestoque'       => 0,
                //     ]);
                // }
                $this->logCadastraDespesas($despesa);
            }
        } elseif ($compraparcelada == 'N') {

            //Não é uma compra parcelada
            if ($despesa->ehcompra == 1) :
                $despesa->descricaoDespesa      =  $request->get('descricaoDespesaCompra');
                $despesa->ehcompra              =  1;

                $request->validate(
                    ['descricaoDespesaCompra' => 'required'],
                    ['descricaoDespesaCompra.required' => 'Informe o que foi comprado']
                );
            endif;

            $despesa->idOS                  =  $request->get('idOS');
            $despesa->vencimento            =  $request->get('vencimento');
            $despesa->notaFiscal            =  $request->get('notaFiscal');
            $despesa->pago                  =  $request->get('pago')[0];
            $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('precoReal'));
            $despesa->quantidade            =  $request->get('quantidadeTabelaSemParcelamento');
            $despesa->valorUnitario         =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorUnitarioSemParcelamento'));

            $despesa->save();
            // if($request->inserirestoque == 'S'){
            //     $salvaEstoque  = Estoque::create([
            //         'codbarras'             => 'CRIAATVAD00'.$despesa->id,
            //         'idbenspatrimoniais'    => $despesa->descricaoDespesa,
            //         'ativadoestoque'        => 1,
            //         'excluidoestoque'       => 0,
            //     ]);
            // }
            $this->logCadastraDespesas($despesa);
        } elseif (($compraparcelada != 'N') && ($compraparcelada != 'S') && ($despesa->ehcompra != 0)) {
            return redirect()->route('despesas.index')
                ->with('error', 'Ocorreu um erro ao salvar.');
        }
        if ($despesa->ehcompra == 0) {
            // Não é uma compra
            $despesa->ehcompra              =  0;
            $despesa->idOS                  =  $request->get('idOS');
            $despesa->vencimento            =  $request->get('vencimento');
            $despesa->notaFiscal            =  $request->get('notaFiscal');
            $despesa->pago                  =  $request->get('pago')[0];

            $despesa->save();

            // if($request->inserirestoque == 'S'){
                
            //     $salvaEstoque  = Estoque::create([
            //         'codbarras'             => 'CRIA-D'.$despesa->id,
            //         'idbenspatrimoniais'    => $despesa->descricaoDespesa,
            //         'ativadoestoque'        => 1,
            //         'excluidoestoque'       => 0,
            //     ]);
            // }
            $this->logCadastraDespesas($despesa);
        }
        $mensagemExito = 'Despesa id ' . $despesa->id . ' cadastrada com êxito.';
        
        if($request->get('tpRetorno') == 'visualiza'):
            
            return redirect()->route('despesas.show', ['id' => $despesa->id])->with('success', $mensagemExito);

        elseif($request->get('tpRetorno') == 'novo'):  $rotaRetorno = 'despesas.create';
        else: $rotaRetorno = 'despesas.index';
        endif;
        
        return redirect()->route($rotaRetorno)->with('success',  $mensagemExito);
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
        if (!isset($despesa)) {
            $mensagemErro = "Não encontramos o id referente a esta despesa.";
            return view('home', compact('mensagemErro'));
        }

        $listaContas  = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1 order by id = :conta desc', ['conta' => $despesa->conta]);

        $codigoDespesa = DB::select('select c.id,  c.despesaCodigoDespesa, c.idGrupoCodigoDespesa, g.grupoDespesa from codigodespesas c, grupodespesas g 
        where (c.ativoCodigoDespesa = 1) and (g.id = c.idGrupoCodigoDespesa) order by c.id = :codigoCadastrado desc', ['codigoCadastrado' => $despesa->despesaCodigoDespesas]);

        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1 order by id = :idFornecedor desc', ['idFornecedor' => $despesa->idFornecedor]);
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 order by id = :idFormaPagamento desc', ['idFormaPagamento' => $despesa->idFormaPagamento]);
        $todasOSAtivas = DB::select('SELECT x.* FROM ordemdeservico x WHERE ativoOrdemdeServico = 1 order by id = :idOS desc', ['idOS' => $despesa->idOS]);
        $todosOSBancos = DB::select('SELECT * FROM banco WHERE ativoBanco = 1 order by id = :idBanco desc', ['idBanco' => $despesa->idBanco]);
        $valorDespesa = $despesa->precoReal;
        $valorVale = $despesa->vale;
        $precoReal = FormatacoesServiceProvider::validaValoresParaView($valorDespesa);
        $vale = FormatacoesServiceProvider::validaValoresParaView($valorVale);

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;


        // $this->logVisualizaDespesas($despesa);

        return view('despesas.show', compact('despesa', 'listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'todosOSBancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
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
        $todosOSBancos = DB::select('SELECT * FROM banco WHERE ativoBanco = 1 order by id = :idBanco desc', ['idBanco' => $despesa->idBanco]);

        $valorDespesa = $despesa->precoReal;
        $valorVale = $despesa->vale;
        $precoReal = FormatacoesServiceProvider::validaValoresParaView($valorDespesa);
        $vale = FormatacoesServiceProvider::validaValoresParaView($valorVale);

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('despesas.edit', compact('despesa', 'listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'todosOSBancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
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
        $despesa = new Despesa();

        $request->validate([
            'idFormaPagamento'          => 'required',
            'conta'                     => 'required',
            'despesaFixa'               => 'required',
        ]);

        $verificaCompra =  $request->get('a');
        if ($verificaCompra == 'S') : $despesa->ehcompra = 1;
        else :
            $request->validate(
                ['descricaoDespesaNaoCompra' => 'required'],
                ['descricaoDespesaNaoCompra.required' => 'Informe a descrição da despesa']
            );
            $despesa->ehcompra = 0;
            $despesa->descricaoDespesa =  $request->get('descricaoDespesaNaoCompra');
        endif;

        // $compraparcelada                =  $request->get('compraparcelada');

        $despesa->id                    =  $request->get('id');
        $despesa->idFuncionario         =  $request->get('idFuncionario');
        $despesa->idFornecedor          =  $request->get('idFornecedor');
        $despesa->idFormaPagamento      =  $request->get('idFormaPagamento');
        $despesa->conta                 =  $request->get('conta');
        $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('precoReal'));
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


            //É compra, mas não é parcelada
            if ($despesa->ehcompra == 1) :
                $despesa->descricaoDespesa      =  $request->get('descricaoDespesaCompra');

                $request->validate(
                    ['descricaoDespesaCompra' => 'required'],
                    ['descricaoDespesaCompra.required' => 'Informe o que foi comprado']
                );
            endif;

            $despesa->idOS                  =  $request->get('idOS');
            $despesa->vencimento            =  $request->get('vencimento');
            $despesa->notaFiscal            =  $request->get('notaFiscal');
            $despesa->pago                  =  $request->get('pago')[0];
            $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('precoReal'));
            $despesa->quantidade            =  $request->get('quantidadeTabelaSemParcelamento');
            $despesa->valorUnitario         =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorUnitarioSemParcelamento'));

        
        if ($despesa->ehcompra == 0) {
            // Não é uma compra
            $despesa->idOS                  =  $request->get('idOS');
            $despesa->vencimento            =  $request->get('vencimento');
            $despesa->notaFiscal            =  $request->get('notaFiscal');
            $despesa->pago                  =  $request->get('pago')[0];

        }

        $original   = $despesa->getOriginal();



        try {
            // $despesa->update();
            
            Despesa::where('id', $despesa->id)
            ->where('excluidoDespesa', '0')
            ->update([
                'ehcompra'                =>  $despesa->ehcompra,
                'idFuncionario'           =>  $despesa->idFuncionario,
                'idFornecedor'            =>  $despesa->idFornecedor,
                'idFormaPagamento'        =>  $despesa->idFormaPagamento,
                'conta'                   =>  $despesa->conta,
                'precoReal'               =>  $despesa->precoReal,
                'dataDaCompra'            =>  $despesa->dataDaCompra,
                'dataDoTrabalho'          =>  $despesa->dataDoTrabalho,
                'quemcomprou'             =>  $despesa->quemcomprou,
                'idBanco'                 =>  $despesa->idBanco,
                'cheque'                  =>  $despesa->cheque,
                'reembolsado'             =>  $despesa->reembolsado,
                'despesaFixa'             =>  $despesa->despesaFixa,
                'nRegistro'               =>  $despesa->nRegistro,
                'despesaCodigoDespesas'   =>  $despesa->despesaCodigoDespesas,
                'ativoDespesa'            =>  $despesa->ativoDespesa,
                'excluidoDespesa'         =>  $despesa->excluidoDespesa,
                'vale'                    =>  $despesa->vale,
                'datavale'                =>  $despesa->datavale,
                'idDespesaPai'            =>  $despesa->idDespesaPai,
                'ativoDespesa'            =>  $despesa->ativoDespesa,
                'excluidoDespesa'         =>  $despesa->excluidoDespesa,
                'idAutor'                 =>  $despesa->idAutor,
                'idOS'                    =>  $despesa->idOS, 
                'vencimento'              =>  $despesa->vencimento, 
                'notaFiscal'              =>  $despesa->notaFiscal, 
                'pago'                    =>  $despesa->pago, 
                'quantidade'              =>  $despesa->quantidade, 
                'valorUnitario'           =>  $despesa->valorUnitario, 
                'valorparcela'            =>  $despesa->valorparcela,  
                'descricaoDespesa'        =>  $despesa->descricaoDespesa,  
                'idFornecedor'            =>  $despesa->idFornecedor,  
                'idFormaPagamento'        =>  $despesa->idFormaPagamento,  
                'conta'                   =>  $despesa->conta,  
                'dataDaCompra'            =>  $despesa->dataDaCompra,  
                'dataDoTrabalho'          =>  $despesa->dataDoTrabalho,  
                'quemcomprou'             =>  $despesa->quemcomprou,  
                'idBanco'                 =>  $despesa->idBanco,  
                'cheque'                  =>  $despesa->cheque,  
                'reembolsado'             =>  $despesa->reembolsado,  
                'despesaFixa'             =>  $despesa->despesaFixa,  
                'nRegistro'               =>  $despesa->nRegistro,  
                'despesaCodigoDespesas'   =>  $despesa->despesaCodigoDespesas,  
                'ativoDespesa'            =>  $despesa->ativoDespesa,  
                'excluidoDespesa'         =>  $despesa->excluidoDespesa,  
                'vale'                    =>  $despesa->vale,  
                'datavale'                =>  $despesa->datavale,  
                'idDespesaPai'            =>  $despesa->idDespesaPai,  
                'ativoDespesa'            =>  $despesa->ativoDespesa,  
                'excluidoDespesa'         =>  $despesa->excluidoDespesa,  
            ]);

            $alteracoes = $despesa->getChanges();
            $this->logAtualizaDespesas($despesa, $alteracoes, $original);

            return redirect()->route('despesas.show', ['id' => $despesa->id])
                ->with('success', 'Despesa ' . $despesa->id  . ' atualizada com êxito.');
        } catch (\Throwable $th) {
            return redirect()->route('despesas.show', ['id' => $despesa->id])
                ->with('error', 'Ocorreu um erro ao atualizar.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Despesa::where('id', $id)
        ->update(['excluidoDespesa' => 1]);

        $this->logExcluiDespesas($id);

        return redirect()->route('despesas.index')
            ->with('success', 'Despesa '. $id .' excluída com êxito!');
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

    public function listaTipoMateriais()
    {
        $listaBensPatrimoniais = DB::select('SELECT * FROM products where ativotipobenspatrimoniais = 1');
        echo json_encode($listaBensPatrimoniais);
    }

    public function listaFornecedores()
    {
        $listaFornecedores =  DB::select('SELECT * from fornecedores where ativoFornecedor = 1');
        echo json_encode($listaFornecedores);
    }

    public function logCadastraDespesas($despesa = null)
    {
        $this->Logger->log('info', 'Cadastrou a despesa ' . $despesa->id);
    }

    public function logVisualizaDespesas($despesa = null)
    {
        $this->Logger->log('info', 'Visualizou a despesa ' . $despesa->id);
    }

    public function logAtualizaDespesas($despesa = null, $alteracoes, $original)
    {
        $trechoMensagem =  $despesa->id . " Dados Alterados: " . PHP_EOL;
        if (isset($alteracoes['despesaCodigoDespesas']) != NULL) {
            $trechoMensagem .= 'Id Cod Desp Atual: ' .       $alteracoes['despesaCodigoDespesas'] .    '. Antigo: ' .  $original['despesaCodigoDespesas'] . PHP_EOL;
        }
        if (isset($alteracoes['idOS']) != NULL) {
            $trechoMensagem .= 'Id OS Atual: ' .             $alteracoes['idOS'] .                     '. Antigo: ' .  $original['idOS'] . PHP_EOL;
        }
        if (isset($alteracoes['idDespesaPai']) != NULL) {
            $trechoMensagem .= 'Id Desp Pai Atual: ' .       $alteracoes['idDespesaPai'] .             '. Antigo: ' .  $original['idDespesaPai'] . PHP_EOL;
        }
        if (isset($alteracoes['descricaoDespesa']) != NULL) {
            $trechoMensagem .= 'Desc Desp Atual: ' .         $alteracoes['descricaoDespesa'] .         '. Antigo: ' .  $original['descricaoDespesa'] . PHP_EOL;
        }
        if (isset($alteracoes['idFornecedor']) != NULL) {
            $trechoMensagem .= 'Id Fornecedor Atual: ' .     $alteracoes['idFornecedor'] .             '. Antigo: ' .  $original['idFornecedor'] . PHP_EOL;
        }
        if (isset($alteracoes['precoReal']) != NULL) {
            $trechoMensagem .= 'Valor Atual: ' .             $alteracoes['precoReal'] .                '. Antigo: ' .  $original['precoReal'] . PHP_EOL;
        }
        if (isset($alteracoes['ehcompra']) != NULL) {
            $trechoMensagem .= 'Foi uma compra Atual: ' .    $alteracoes['ehcompra'] .                 '. Antigo: ' .  $original['ehcompra'] . PHP_EOL;
        }
        if (isset($alteracoes['pago']) != NULL) {
            $trechoMensagem .= 'Pago Atual: ' .              $alteracoes['pago'] .                     '. Antigo: ' .  $original['pago'] . PHP_EOL;
        }
        if (isset($alteracoes['quempagou']) != NULL) {
            $trechoMensagem .= 'Quem Pagou Atual: ' .        $alteracoes['quempagou'] .                '. Antigo: ' .  $original['quempagou'] . PHP_EOL;
        }
        if (isset($alteracoes['idFormaPagamento']) != NULL) {
            $trechoMensagem .= 'Forma PG Atual: ' .          $alteracoes['idFormaPagamento'] .         '. Antigo: ' .  $original['idFormaPagamento'] . PHP_EOL;
        }
        if (isset($alteracoes['conta']) != NULL) {
            $trechoMensagem .= 'Id Conta Atual: ' .          $alteracoes['conta'] .                    '. Antigo: ' .  $original['conta'] . PHP_EOL;
        }
        if (isset($alteracoes['nRegistro']) != NULL) {
            $trechoMensagem .= 'Num Reg Atual: ' .           $alteracoes['nRegistro'] .                '. Antigo: ' .  $original['nRegistro'] . PHP_EOL;
        }
        if (isset($alteracoes['valorEstornado']) != NULL) {
            $trechoMensagem .= 'Estornado Atual: ' .         $alteracoes['valorEstornado'] .           '. Antigo: ' .  $original['valorEstornado'] . PHP_EOL;
        }
        if (isset($alteracoes['vencimento']) != NULL) {
            $trechoMensagem .= 'Vencimento Atual: ' .        $alteracoes['vencimento'] .               '. Antigo: ' .  $original['vencimento'] . PHP_EOL;
        }
        if (isset($alteracoes['despesaFixa']) != NULL) {
            $trechoMensagem .= 'Desp Fixa Atual: ' .         $alteracoes['despesaFixa'] .              '. Antigo: ' .  $original['despesaFixa'] . PHP_EOL;
        }
        if (isset($alteracoes['notaFiscal']) != NULL) {
            $trechoMensagem .= 'Nota Fiscal Atual: ' .       $alteracoes['notaFiscal'] .               '. Antigo: ' .  $original['notaFiscal'] . PHP_EOL;
        }
        if (isset($alteracoes['idBanco']) != NULL) {
            $trechoMensagem .= 'Id Banco Atual: ' .          $alteracoes['idBanco'] .                  '. Antigo: ' .  $original['idBanco'] . PHP_EOL;
        }
        if (isset($alteracoes['reembolsado']) != NULL) {
            $trechoMensagem .= 'Id Reembolsado Atual: ' .    $alteracoes['reembolsado'] .              '. Antigo: ' .  $original['reembolsado'] . PHP_EOL;
        }
        if (isset($alteracoes['cheque']) != NULL) {
            $trechoMensagem .= 'Cheque Atual: ' .            $alteracoes['cheque'] .                   '. Antigo: ' .  $original['cheque'] . PHP_EOL;
        }
        if (isset($alteracoes['dataDoTrabalho']) != NULL) {
            $trechoMensagem .= 'Data do Trabalho Atual: ' .  $alteracoes['dataDoTrabalho'] .           '. Antigo: ' .  $original['dataDoTrabalho'] . PHP_EOL;
        }
        if (isset($alteracoes['dataDaCompra']) != NULL) {
            $trechoMensagem .= 'Data da Compra Atual: ' .    $alteracoes['dataDaCompra'] .             '. Antigo: ' .  $original['dataDaCompra'] . PHP_EOL;
        }
        if (isset($alteracoes['ativoDespesa']) != NULL) {
            $trechoMensagem .= 'Despesa Ativa Atual: ' .     $alteracoes['ativoDespesa'] .             '. Antigo: ' .  $original['ativoDespesa'] . PHP_EOL;
        }
        if (isset($alteracoes['excluidoDespesa']) != NULL) {
            $trechoMensagem .= 'Despesa Excluída Atual: ' .  $alteracoes['excluidoDespesa'] .          '. Antigo: ' .  $original['excluidoDespesa'] . PHP_EOL;
        }
        if (isset($alteracoes['idFuncionario']) != NULL) {
            $trechoMensagem .= 'Tipo Fornecedor Atual: ' .   $alteracoes['idFuncionario'] .           '. Antigo: ' .  $original['idFuncionario'] . PHP_EOL;
        }
        if (isset($alteracoes['idAlteracaoUsuario']) != NULL) {
            $trechoMensagem .= 'Id Alter. Usuario Atual: ' . $alteracoes['idAlteracaoUsuario'] .       '. Antigo: ' .  $original['idAlteracaoUsuario'] . PHP_EOL;
        }
        if (isset($alteracoes['idAutor']) != NULL) {
            $trechoMensagem .= 'Id Usuario Autor Atual: ' .  $alteracoes['idAutor'] .                  '. Antigo: ' .  $original['idAutor'] . PHP_EOL;
        }

        $this->Logger->log('info', 'Atualizou a despesa ' .  $trechoMensagem);
    }

    public function logExcluiDespesas($id = null)
    {
        $this->Logger->log('info', 'Excluiu a despesa ' . $id);
    }
}
