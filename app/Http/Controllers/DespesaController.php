<?php

namespace App\Http\Controllers;

use App\CodigoDespesa;
use App\Despesa;
use App\Conta;
use App\Banco;
use App\User;
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
use Illuminate\Support\Facades\Auth as FacadesAuth;
use stdClass;
use Illuminate\Support\Facades\Crypt;
use Gate;

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
        $this->middleware('permission:despesa-list|despesa-list-all|despesa-create|despesa-edit|despesa-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:despesa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:despesa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:despesa-delete', ['only' => ['destroy']]);

        //Importação do Logger
        $this->Logger           = new Logger();

        $this->acao             =  request()->segment(count(request()->segments()));
        $this->valorInput       = null;
        $this->valorSemCadastro = null;
        $this->infoSelectVazio  = '<option value="">NÃO INFORMADO</option>';


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
            $this->show($request, $iddespesa);

            $despesas = Despesa::where('id', $iddespesa)->where('excluidoDespesa', 0)->get();

            if (count($despesas) == 1) {

                header("Location: despesas/$iddespesa");
                exit();
            } else {
                return redirect()->route('despesas.index')
                    ->with('warning', 'Depesa ' . $iddespesa . ' é um dado excluído, ou uma despesa inexistente, não podendo ser acessado');
            }
        }

        if (!Gate::allows('despesa-list') && !Gate::allows('despesa-list-all')) {
            abort(401, 'Não Autorizado');
        } elseif (Gate::allows('despesa-list')) {
            $request->idUser = Auth::id();
        }

        $validacoesPesquisa = $this->validaPesquisa($request);

        $despesas               = $validacoesPesquisa[0];
        $valor                  = $validacoesPesquisa[1];
        $dtinicio               = $validacoesPesquisa[2];
        $dtfim                  = $validacoesPesquisa[3];
        $coddespesa             = $validacoesPesquisa[4];
        $grupodespesa           = $validacoesPesquisa[5];
        $fornecedor             = $validacoesPesquisa[6];
        $ordemservico           = $validacoesPesquisa[7];
        $conta                  = $validacoesPesquisa[8];
        $notafiscal             = $validacoesPesquisa[9];
        $cliente                = $validacoesPesquisa[10];
        $fixavariavel           = $validacoesPesquisa[11];
        $pago                   = $validacoesPesquisa[12];
        $idSalvo                = $validacoesPesquisa[13];
        $idUser                 = $validacoesPesquisa[14];
        $dtiniciolancamento     = $validacoesPesquisa[15];
        $dtfimlancamento        = $validacoesPesquisa[16];
        $formaPagamento         = $validacoesPesquisa[17];
        
        $rota = $this->verificaRelatorio($request);

        return view($rota, compact('consulta', 'despesas', 'valor', 'dtinicio', 'dtfim', 'coddespesa', 'grupodespesa', 'fornecedor', 'ordemservico', 'conta', 'notafiscal', 'cliente', 'fixavariavel', 'pago', 'idSalvo', 'dtiniciolancamento', 'dtfimlancamento', 'formaPagamento'));
    }


    public function apidespesas(Request $request)
    {
        $permissaoTotal = 0;
        if (isset(Auth()->user()->id)) {
            if (User::find(Auth()->user()->id)->can('despesa-list-all')) {
                $permissaoTotal = 1;
            } elseif (User::find(Auth()->user()->id)->can('despesa-list')) {
                $idUser = Auth()->user()->id;
            }
            else {
                abort(401, 'Não Autorizado');
            }
        } elseif (isset($request->idUser)) {
            $idUser = Crypt::decrypt($request->idUser);
            if (User::find($idUser)->can('despesa-list-all')) {
                $permissaoTotal = 1;
            } 
            elseif (User::find($idUser)->can('despesa-list')) {
                $idUser = $idUser;
            } 
            else {
                abort(401, 'Não Autorizado');
            }
        }
        else {
            abort(401, 'Não Autorizado');
        }
        // elseif (User::find($idUser)->can('despesa-create')){

        // }
        $permissaoTotal   == 1 ? $visaoLimitada = " " : $visaoLimitada = " AND idAutor = '$idUser' ";

        // TODO: Montar filtro genérico de despesas

        if (isset($request->idSalvo)) {
            //Verificação após retorno de lançamento de mais de uma despesa

            if (is_array($request->idSalvo) && (count($request->idSalvo) > 1)) {
                //Ref. is_array: 
                //https://stackoverflow.com/questions/49506003/sizeof-parameter-must-be-an-array-or-an-object-that-implements-countable
                $idSalvos = implode(',', $request->idSalvo);
                $descricao = " AND d.id in ( $idSalvos)";
            } else {
                $descricao = " AND d.id in ($request->idSalvo)";
            }
        } else {
            $descricao = $this->montaFiltrosConsulta($request);
        }
        $controleconsumomaterial = '';
        $controleConsumoMaterialLeftJoin = '';
        $groupByControleConsumo = '';

        if (isset($request->rel) && ($request->rel ==  'controleconsumomaterial')){
            $controleconsumomaterial = "
            bp.nomeBensPatrimoniais as 'material',
            COUNT( bp.nomeBensPatrimoniais) as 'qtde',
            p.name      as 'tipo',
            un.sigla    as 'unidade',";

            $controleConsumoMaterialLeftJoin = "
            LEFT JOIN products         	AS p		ON bp.idTipoBensPatrimoniais = p.id
            LEFT JOIN unidademedida 	AS un		ON bp.unidademedida = un.id";

            $groupByControleConsumo = " group by bp.nomeBensPatrimoniais ";
        }

        $listaDespesas = DB::select('SELECT distinct d.id, 
        c.despesaCodigoDespesa,
        g.grupoDespesa,' . $controleconsumomaterial .'
        CASE
            WHEN d.ehcompra = 1 and (insereestoque IS NULL or insereestoque = 1) THEN UPPER(bp.nomeBensPatrimoniais)
            ELSE UPPER(d.descricaoDespesa)
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
        fpg.nomeFormaPagamento,

        d.quantidade,
        d.valorUnitario,
        d.dataDaCompra,
        d.dataDoTrabalho,
        fqc.razaosocialFornecedor as quemcomprou,
        b.nomeBanco,
        d.cheque,
        fre.razaosocialFornecedor as reembolsado, 
        d.created_at,
        u.name  as nomeusuario


        FROM despesas d  

        LEFT JOIN fornecedores      AS f 	   ON d.idFornecedor = f.id
        LEFT JOIN funcionarios      AS fun 	   ON d.idFuncionario = fun.id
        LEFT JOIN codigodespesas    AS c       ON d.despesaCodigoDespesas = c.id
        LEFT JOIN conta             AS cc      ON d.conta = cc.id
        LEFT JOIN ordemdeservico    AS os      ON d.idOS = os.id
        LEFT JOIN grupodespesas     AS g       ON c.idGrupoCodigoDespesa = g.id
        LEFT JOIN formapagamento    AS fpg     ON d.idFormaPagamento = fpg.id
        LEFT JOIN benspatrimoniais  AS bp      ON d.descricaoDespesa = bp.id
        LEFT JOIN clientes          AS cli     ON os.idClienteOrdemdeServico = cli.id
        
        LEFT JOIN fornecedores      AS fqc     ON d.quemcomprou = fqc.id
        LEFT JOIN banco             AS b       ON d.idBanco = b.id
        LEFT JOIN fornecedores      AS fre     ON d.reembolsado = fre.id
        LEFT JOIN users             AS u        ON d.idAutor = u.id
        ' . $controleConsumoMaterialLeftJoin . '
     
        WHERE d.excluidoDespesa = 0 ' . $visaoLimitada . $descricao . $groupByControleConsumo);

        return $listaDespesas;
    }

    private function montaFiltrosConsulta($request)
    {
        $descricao = "";
        $verificaInputCampos = 0;

        if (isset($request->despesas))      $descricao .= " AND d.descricaoDespesa like  '%$request->despesas%'"; $verificaInputCampos++;

        if (isset($request->coddespesa))    $descricao .= " AND c.despesaCodigoDespesa like  '%$request->coddespesa%'"; $verificaInputCampos++;

        if (isset($request->grupodespesa))  $descricao .= " AND g.grupoDespesa like  '%$request->grupodespesa%'"; $verificaInputCampos++;
        
        if (isset($request->fornecedor))    $descricao .= " AND f.razaosocialFornecedor like  '%$request->fornecedor%'"; $verificaInputCampos++;
        
        if (isset($request->ordemservico))  $descricao .= " AND d.idOS = '$request->ordemservico'"; $verificaInputCampos++;
        
        if (isset($request->valor))         $descricao .= " AND d.precoReal = '$request->valor'"; $verificaInputCampos++;
        
        if (isset($request->conta))         $descricao .= " AND cc.apelidoConta = '$request->conta'"; $verificaInputCampos++;
        
        if (isset($request->prolabore))     $descricao .= " AND (fun.nomeFuncionario != '') and (c.id = 33)"; $verificaInputCampos++;
        
        if (isset($request->reembolso))     $descricao .= " AND d.reembolsado != '0'"; $verificaInputCampos++;

        if (isset($request->notafiscal))    $descricao .= " AND d.notaFiscal = '$request->notafiscal'"; $verificaInputCampos++;
        
        if (isset($request->cliente))       $descricao .= " AND os.idClienteOrdemdeServico = '$request->cliente'"; $verificaInputCampos++;

        if (isset($request->formaPagamento)) $descricao .= " AND fpg.nomeFormaPagamento = '$request->formaPagamento'"; $verificaInputCampos++;
        
        if (isset($request->fixavariavel))  $descricao .= " AND d.despesaFixa = '$request->fixavariavel'"; $verificaInputCampos++;
        
        if (isset($request->pago))          $descricao .= " AND d.pago = '$request->pago'"; $verificaInputCampos++;
       
        if (isset($request->rel) && ($request->rel ==  'controleconsumomaterial'))   $descricao .= " AND d.ehcompra = '1'"; $verificaInputCampos++;
       

        if (isset($request->dtfim)) :        $datafim    = $request->dtfim;
        else : $datafim = date('Y-m-t');
        endif;

        if (isset($request->dtinicio)) :     $descricao .= " AND d.vencimento BETWEEN  '$request->dtinicio' and '$datafim'";
            $verificaInputCampos++;
        elseif (($verificaInputCampos == 0) && (!isset($request->dtiniciolancamento))) :   $datainicio = date('Y-m') . '-01';
            $descricao .= " AND d.vencimento BETWEEN  '$datainicio' and '$datafim'";
        endif;

        if (isset($request->dtfimlancamento)) :        $datafimlancamento    = $request->dtfimlancamento;
        else : $datafimlancamento = date('Y-m-t');
        endif;

        if (isset($request->dtiniciolancamento)) :     $descricao .= " AND d.created_at BETWEEN  '$request->dtiniciolancamento 00:00:00' and '$datafimlancamento 23:59:59'";
        elseif ($verificaInputCampos == 0) :   $datainiciolancamento = date('Y-m') . '-01';
            $descricao .= " AND d.created_at BETWEEN  '$datainiciolancamento 00:00:00' and '$datafimlancamento 23:59:59'";
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
        if ($request->get('grupodespesa')) :   $grupodespesa = $request->get('grupodespesa');
        else : $grupodespesa = '';
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
        if ($request->get('dtiniciolancamento')) :     $dtiniciolancamento = $request->get('dtiniciolancamento');
        else : $dtiniciolancamento = '';
        endif;
        if ($request->get('dtfimlancamento')) :        $dtfimlancamento = $request->get('dtfimlancamento');
        else : $dtfimlancamento = '';
        endif;
        if ($request->get('formaPagamento')) :   $formaPagamento = $request->get('formaPagamento');
        else : $formaPagamento = '';
        endif;
        if (isset($request->idSalvo)) {
            $idSalvos = $request->idSalvo;
        } else {
            $idSalvos = null;
        }
        if (isset($request->idUser)) {
            $idUser = $request->idUser;
        } else {
            $idUser = null;
        }

        $solicitacaoArray = array($despesas, $valor, $dtinicio, $dtfim, $coddespesa, $grupodespesa, $fornecedor, $ordemservico, $conta, $notafiscal, $cliente, $fixavariavel, $pago, $idSalvos, $idUser, $dtiniciolancamento, $dtfimlancamento, $formaPagamento);
        return $solicitacaoArray;
    }
    
    private function verificaRelatorio($request)
    {
        if ($request == null) {
            $rotaRetorno = 'despesas.index';
            return $rotaRetorno;
        }

        $rotaRetorno = 'despesas.index';

        if ($request->tpRel ==  'pesquisadespesascompleto') :
            $rotaRetorno = 'despesas.completo';

        elseif ($request->tpRel ==  'fornecedor') :
            $rotaRetorno = 'relatorio.fornecedor.index';

        elseif ($request->tpRel ==  'pclienteanalitico') :
            $rotaRetorno = 'relatorio.despesasporclienteanalitico.index';

        elseif ($request->tpRel ==  'contasapagarporgrupo') :
            $rotaRetorno = 'relatorio.contasapagarporgrupo.index';

        elseif ($request->tpRel ==  'contaspagasporgrupo') :
            $rotaRetorno = 'relatorio.contaspagasporgrupo.index';

        elseif ($request->tpRel ==  'despesasfixavariavel') :
            $rotaRetorno = 'relatorio.despesasfixavariavel.index';

        elseif ($request->tpRel ==  'notafiscalfornecedor') :
            $rotaRetorno = 'relatorio.notafiscalfornecedor.index';

        elseif ($request->tpRel ==  'despesaspagasporcontabancaria') :
            $rotaRetorno = 'relatorio.despesaspagasporcontabancaria.index';

        elseif ($request->tpRel ==  'despesasporos') :
            $rotaRetorno = 'relatorio.despesasporos.index';

        elseif ($request->tpRel ==  'despesasporosplanilha') :
            $rotaRetorno = 'relatorio.despesasporosplanilha.index';

        elseif ($request->tpRel ==  'despesassinteticaporos') :
            $rotaRetorno = 'relatorio.despesassinteticaporos.index';

        elseif ($request->tpRel ==  'prolabore') :
            $rotaRetorno = 'relatorio.prolabore.index';

        elseif ($request->tpRel ==  'reembolso') :
            $rotaRetorno = 'relatorio.reembolso.index';

        elseif ($request->tpRel ==  'controleconsumomaterial') :
            $rotaRetorno = 'relatorio.controleconsumomaterial.index';

        endif;

        return $rotaRetorno;
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
    public function create(Request $request)
    {
        $listaContas    = Conta::select('id','apelidoConta', 'nomeConta')->where('ativoConta', '1')->get();
        $codigoDespesa  = CodigoDespesa::select('c.id', 'c.despesaCodigoDespesa', 'c.idGrupoCodigoDespesa', 'g.grupoDespesa')
                          ->from('codigodespesas as c')
                          ->join('grupodespesas as g', 'g.id', '=', 'c.idGrupoCodigoDespesa')
                          ->where('c.ativoCodigoDespesa', 1)
                          ->orderBy('c.id')
                          ->get();
        
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento   = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');
        $todasOSAtivas    = DB::select('SELECT x.* FROM ordemdeservico x WHERE ativoOrdemdeServico = 1');
        $todosOSBancos    = Banco::all()->where('ativoBanco', '1');
        
        $precoReal = " ";
        $vale = " ";
        $valorInput             = $this->valorInput;
        $valorSemCadastro       = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;
        $infoSelectVazio        = $this->infoSelectVazio;
        if (isset($request->paginaModal)) :
            $paginaModal = true;
            return view('despesas.create', compact('listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'todosOSBancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView', 'infoSelectVazio', 'paginaModal'));
        endif;
        return view('despesas.create', compact('listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'todosOSBancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView', 'infoSelectVazio'));
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

        $this->processaRequisicaoDeNaoCompraECompra($despesa, $request);

        $compraparcelada    =  $request->get('compraparcelada');
        $verificaCompra     =  $request->get('a');
        $idSalvo = [];
        if ($verificaCompra == 'S') {
            $despesa->ehcompra = 1;

            $this->processaCompra($despesa, $request, $compraparcelada, $idSalvo);
            $tamanhoArraySalvos = count($idSalvo);

            if ($tamanhoArraySalvos == 1) {
                if ($request->get('tpRetorno') == 'visualiza') {
                    $mensagemExito = 'Despesa id ' . $despesa->id . ' cadastrada com êxito.';


                    if ((int)$request->get('paginaModal') == 1) {
                        $paginaModal = true;
                        return redirect()->route('despesas.show', ['id' => $despesa->id])
                            ->with('paginaModal', $paginaModal)
                            ->with('success', $mensagemExito);
                    } elseif ((int)$request->get('paginaModal') == 0) {
                        return redirect()->route('despesas.show', ['id' => $despesa->id])
                            ->with('success', $mensagemExito);
                    }
                }
            } elseif ($tamanhoArraySalvos > 1) {

                $dados = new Request();

                $dados->idSalvo = [];
                $dados->idSalvo = $idSalvo;
                $this->apidespesas($dados);
                $rota = $this->verificaRelatorio($acesso = null);

                $consulta       = '';
                $despesas       = '';
                $valor          = '';
                $dtinicio       = '';
                $dtfim          = '';
                $coddespesa     = '';
                $grupodespesa   = '';
                $fornecedor     = '';
                $ordemservico   = '';
                $conta          = '';
                $notafiscal     = '';
                $cliente        = '';
                $fixavariavel   = '';
                $pago           = '';


                $idSalvos = implode(",", $dados->idSalvo);

                $mensagemExito = 'Despesas id ' . $idSalvos . ' cadastradas com êxito.';
                $permiteVisualizacaoDespesaCriada = 1;

                if ((int)$request->get('paginaModal') == 1) {
                    $paginaModal = true;
                    return view('despesas.completo', compact('consulta', 'despesas', 'valor', 'dtinicio', 'dtfim', 'coddespesa', 'grupodespesa', 'fornecedor', 'ordemservico', 'conta', 'notafiscal', 'cliente', 'fixavariavel', 'pago', 'mensagemExito', 'paginaModal', 'idSalvo', 'permiteVisualizacaoDespesaCriada'));
                } else {
                    return view('despesas.completo', compact('consulta', 'despesas', 'valor', 'dtinicio', 'dtfim', 'coddespesa', 'grupodespesa', 'fornecedor', 'ordemservico', 'conta', 'notafiscal', 'cliente', 'fixavariavel', 'pago', 'mensagemExito', 'idSalvo', 'permiteVisualizacaoDespesaCriada'));
                }
            }
        } else {
            $request->validate(
                ['descricaoDespesaNaoCompra' => 'required'],
                ['descricaoDespesaNaoCompra.required' => 'Informe a descrição da despesa']
            );
            $despesa->ehcompra = 0;
            $despesa->descricaoDespesa =  $request->get('descricaoDespesaNaoCompra');
            $this->processaNaoCompra($despesa, $request);
        }

        $mensagemExito = 'Despesa id ' . $despesa->id . ' cadastrada com êxito.';

        if ($request->get('tpRetorno') == 'visualiza') {

            if ((int)$request->get('paginaModal') == 1) {
                $paginaModal = true;

                return redirect()->route('despesas.show', ['id' => $despesa->id])->with('success', $mensagemExito)
                    ->with('paginaModal', $paginaModal);
            } elseif ((int)$request->get('paginaModal') == 0) {
                return redirect()->route('despesas.show', ['id' => $despesa->id])->with('success', $mensagemExito);
            }
        } elseif ($request->get('tpRetorno') == 'novo') {
            $rotaRetorno = 'despesas.create';
        } else {
            $rotaRetorno = 'despesas.index';
        }
        return redirect()->route($rotaRetorno)->with('success',  $mensagemExito);
    }

    public function processaRequisicaoDeNaoCompraECompra(&$despesa, &$request)
    {
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
        $despesa->insereestoque         =  (int)$request->get('inserirestoque');
    }

    public function processaCompra(&$despesa, &$request, &$compraparcelada, &$idSalvo)
    {
        
        if ($compraparcelada == 'S') {

            $quantidade             = $request->get('quantidadeTabela');
            $tamanhoArrayQuantidade = count($quantidade);

            for ($i = 0; $i < $tamanhoArrayQuantidade; $i++) {
                $despesa = new Despesa();

                $despesa->ehcompra              =  1;
                $despesa->idOS                  =  $request->get('idOSTabela')[$i];
                $despesa->vencimento            =  $request->get('vencimentoTabela')[$i];
                $despesa->notaFiscal            =  $request->get('notaFiscalTabela')[$i];
                $despesa->pago                  =  $request->get('pagoTabela')[$i];
                $despesa->quantidade            =  $request->get('quantidadeTabela')[$i];
                $despesa->valorUnitario         =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorUnitarioTabela')[$i]);
                $despesa->idAutor               =  auth()->user()->id;

                $despesa->valorparcela          =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorparcelaTabela')[$i]);
                $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorparcelaTabela')[$i]);

                $despesa->insereestoque         =  (int)$request->get('inserirestoque');

                if ($despesa->insereestoque == 0) {
                    $despesa->descricaoDespesa      =  $request->get('descricaoTabelaSemEstoque')[$i];
                    $despesa->insereestoque         = 0;
                } else if ($despesa->insereestoque == 1) {
                    $despesa->descricaoDespesa      =  $request->get('descricaoTabela')[$i];
                    $despesa->insereestoque         = 1;
                }

                $despesa->idFornecedor          =  $request->get('idFornecedor');
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
                $idSalvo[$i] = $despesa->id;

                if ($despesa->insereestoque == 1) {
                    //Lançando no estoque 
                    //S S S [OK]

                    $despesa->quantidade = intval($despesa->quantidade);
                    for ($e = 0; $e < $despesa->quantidade; $e++) {
                        $ultimoId = Estoque::max('id');
                        $novoCodBarras = "CRIAATVA" . str_pad(($ultimoId !== null ? ++$ultimoId : 1), 5, "0", STR_PAD_LEFT);
                        $lancaEstoque = Estoque::create([
                            'codbarras'             => $novoCodBarras,
                            'idbenspatrimoniais'    => $despesa->descricaoDespesa,
                            'descricao'             => "CRIADO VIA DESPESA ID $despesa->id",
                            'ativadoestoque'        => 1,
                            'excluidoestoque'       => 0,
                        ]);
                    }
                }

                $this->logCadastraDespesas($despesa);
            }
        } elseif ($compraparcelada == 'N') {

            if ($request->get('unicadespesa') == '0') {
                $quantidade = $request->get('quantidadeTabelaMultiplo');
                $tamanhoArrayQuantidade = count($quantidade);

                for ($i = 0; $i < $tamanhoArrayQuantidade; $i++) {
                    $despesa = new Despesa();
                    $despesa->ehcompra              =  1;
                    $despesa->idOS                  =  $request->get('idOSTabelaMultiplo')[$i];
                    $despesa->vencimento            =  $request->get('vencimentoTabelaMultiplo')[$i];
                    $despesa->notaFiscal            =  $request->get('notaFiscalTabelaMultiplo')[$i];
                    $despesa->pago                  =  $request->get('pagoTabelaMultiplo')[$i];
                    $despesa->quantidade            =  $request->get('quantidadeTabelaMultiplo')[$i];
                    $despesa->valorUnitario         =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorUnitarioTabelaMultiplo')[$i]);
                    $despesa->idAutor               =  auth()->user()->id;

                    $despesa->valorparcela          =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorparcelaTabelaMultiplo')[$i]);
                    $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorparcelaTabelaMultiplo')[$i]);
                    $despesa->insereestoque         =  (int)$request->get('inserirestoque');

                    if ($despesa->insereestoque == 0) {
                        $despesa->descricaoDespesa      =  $request->get('descricaoTabelaSemEstoqueMultiplo')[$i];
                        $despesa->insereestoque         = 0;
                    } else if ($despesa->insereestoque == 1) {
                        $despesa->descricaoDespesa      =  $request->get('descricaoTabelaMultiplo')[$i];
                        $despesa->insereestoque         = 1;
                    }

                    $despesa->idFornecedor          =  $request->get('idFornecedor');
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
                    $idSalvo[$i] = $despesa->id;
                    // if ($despesa->quantidade == null || $despesa->quantidade = ''){
                    //     $despesa->quantidade = 1;
                    // }
                    // else{
                    //     if ($despesa->insereestoque == 1) {
                    //         //Lançando no estoque
                    //         $estoque = Estoque::select('id')->orderBy('id', 'desc')->first();
                    //         $novoCodBarras = "CRIAA0" . $estoque->id++;
                    //         $despesa->quantidade = intval($despesa->quantidade);
                    //         for ($i = 0; $i < $despesa->quantidade; $i++) {
                    //             Estoque::create([
                    //                 'codbarras'             => $novoCodBarras,
                    //                 'idbenspatrimoniais'    => $despesa->descricaoDespesa,
                    //                 'descricao'             => "CRIADO VIA DESPESAS",
                    //                 'ativadoestoque'        => 1,
                    //                 'excluidoestoque'       => 0,
                    //             ]);
                    //         }
                    //     }
                    // }

                    if ($despesa->insereestoque == 1) {
                        //S N S N
                        if ($despesa->quantidade == null || $despesa->quantidade = '') $despesa->quantidade = 1;
                        $despesa->quantidade     = $request->get('quantidade');

                        for ($e = 0; $e < $despesa->quantidade; $e++) {
                            //Lançando no estoque
                            $ultimoId = Estoque::max('id');
                            $novoCodBarras = "CRIAATVA" . str_pad(($ultimoId !== null ? ++$ultimoId : 1), 5, "0", STR_PAD_LEFT);
                            $lancaEstoque = Estoque::create([
                                'codbarras'             => $novoCodBarras,
                                'idbenspatrimoniais'    => $despesa->descricaoDespesa,
                                'descricao'             => "CRIADO VIA DESPESA ID $despesa->id",
                                'ativadoestoque'        => 1,
                                'excluidoestoque'       => 0,
                            ]);
                        }
                    }
                    $this->logCadastraDespesas($despesa);
                }
            } elseif ($request->get('unicadespesa') == '1') {
                $despesa->ehcompra              =  1;
                $idSalvo                        = [];

                $despesa->idOS                  =  $request->get('idOS');
                $despesa->vencimento            =  $request->get('vencimento');
                $despesa->notaFiscal            =  $request->get('notaFiscal');
                $despesa->pago                  =  $request->get('pago')[0];
                $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('precoReal'));
                $despesa->quantidade            =  $request->get('quantidade');
                $despesa->valorUnitario         =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorUnitario'));
                $despesa->idAutor               =  auth()->user()->id;

                $despesa->insereestoque         =  (int)$request->get('inserirestoque');

                if ($despesa->insereestoque == 0) {
                    $despesa->descricaoDespesa      =  $request->get('descricaoDespesaSemEstoque');
                    $despesa->insereestoque         = 0;
                } else if ($despesa->insereestoque == 1) {
                    $despesa->descricaoDespesa      =  $request->get('descricaoDespesaCompra');
                    $despesa->insereestoque         = 1;
                }

                $despesa->save();
                $idSalvo[0] = $despesa->id;
                
                if ($despesa->insereestoque == 1) {
                    //S N S S
                    if ($despesa->quantidade == null || $despesa->quantidade = '') $despesa->quantidade = 1;
                    $despesa->quantidade     = $request->get('quantidade');

                    for ($e = 0; $e < $despesa->quantidade; $e++) {
                        //Lançando no estoque
                        $ultimoId = Estoque::max('id');
                        $novoCodBarras = "CRIAATVA" . str_pad(($ultimoId !== null ? ++$ultimoId : 1), 5, "0", STR_PAD_LEFT);
                        
                        $lancaEstoque = Estoque::create([
                            'codbarras'             => $novoCodBarras,
                            'idbenspatrimoniais'    => $despesa->descricaoDespesa,
                            'descricao'             => "CRIADO VIA DESPESA ID $despesa->id",
                            'ativadoestoque'        => 1,
                            'excluidoestoque'       => 0,
                        ]);
                    }
                }

                $this->logCadastraDespesas($despesa);
            }
        } elseif (($compraparcelada != 'N') && ($compraparcelada != 'S') && ($despesa->ehcompra != 0)) {
            return redirect()->route('despesas.index')
                ->with('error', 'Ocorreu um erro ao salvar.');
        }
    }

    public function processaNaoCompra(&$despesa, &$request)
    {
        if ($despesa->ehcompra == 0) {

            $despesa->ehcompra              =  0;
            $despesa->idOS                  =  $request->get('idOS');
            $despesa->vencimento            =  $request->get('vencimento');
            $despesa->notaFiscal            =  $request->get('notaFiscal');
            $despesa->pago                  =  $request->get('pago')[0];

            $despesa->save();

            // if($request->inserirestoque == '1'){

            //     $salvaEstoque  = Estoque::create([
            //         'codbarras'             => 'CRIA-D'.$despesa->id,
            //         'idbenspatrimoniais'    => $despesa->descricaoDespesa,
            //         'ativadoestoque'        => 1,
            //         'excluidoestoque'       => 0,
            //     ]);
            // }
            $this->logCadastraDespesas($despesa);
            return true;
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $despesa = Despesa::find($id);

        if (!isset($despesa)) {
            $mensagemErro = "Não encontramos o id referente a esta despesa.";
            return view('home', compact('mensagemErro'));
        }
        if ($request->user()->cannot('despesa-list-all') &&  $despesa->idAutor !=  auth()->user()->id) {
            abort(401, 'Não Autorizado');
        }

        $despesa = null;
        $listaContas = null;
        $codigoDespesa = null;
        $listaForncedores = null;
        $formapagamento = null;
        $todasOSAtivas = null;
        $todosOSBancos = null;
        $valorDespesa = null;
        $valorVale = null;
        $precoReal = null;
        $vale = null;
        $valorInput = null;
        $valorSemCadastro = null;
        $variavelReadOnlyNaView = null;
        $variavelDisabledNaView = null;
        $infoSelectVazio = null;

        $this->dadosDespesaEdicaoVisualizacao($id, $despesa, $listaContas, $codigoDespesa, $listaForncedores, $formapagamento, $todasOSAtivas, $todosOSBancos, $valorDespesa, $valorVale, $precoReal, $vale, $valorInput, $valorSemCadastro, $variavelReadOnlyNaView, $variavelDisabledNaView, $infoSelectVazio);

        return view('despesas.show', compact('despesa', 'listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'todosOSBancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView', 'infoSelectVazio'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $despesa = null;
        $listaContas = null;
        $codigoDespesa = null;
        $listaForncedores = null;
        $formapagamento = null;
        $todasOSAtivas = null;
        $todosOSBancos = null;
        $valorDespesa = null;
        $valorVale = null;
        $precoReal = null;
        $vale = null;
        $valorInput = null;
        $valorSemCadastro = null;
        $variavelReadOnlyNaView = null;
        $variavelDisabledNaView = null;
        $infoSelectVazio = null;

        $this->dadosDespesaEdicaoVisualizacao($id, $despesa, $listaContas, $codigoDespesa, $listaForncedores, $formapagamento, $todasOSAtivas, $todosOSBancos, $valorDespesa, $valorVale, $precoReal, $vale, $valorInput, $valorSemCadastro, $variavelReadOnlyNaView, $variavelDisabledNaView, $infoSelectVazio);

        return view('despesas.edit', compact('despesa', 'listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'todosOSBancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView', 'infoSelectVazio'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function editamodal($id)
    {
        $despesa = null;
        $listaContas = null;
        $codigoDespesa = null;
        $listaForncedores = null;
        $formapagamento = null;
        $todasOSAtivas = null;
        $todosOSBancos = null;
        $valorDespesa = null;
        $valorVale = null;
        $precoReal = null;
        $vale = null;
        $valorInput = null;
        $valorSemCadastro = null;
        $variavelReadOnlyNaView = null;
        $variavelDisabledNaView = null;
        $infoSelectVazio = null;

        $this->dadosDespesaEdicaoVisualizacao($id, $despesa, $listaContas, $codigoDespesa, $listaForncedores, $formapagamento, $todasOSAtivas, $todosOSBancos, $valorDespesa, $valorVale, $precoReal, $vale, $valorInput, $valorSemCadastro, $variavelReadOnlyNaView, $variavelDisabledNaView, $infoSelectVazio);

        $paginaModal = true;
        $variavelReadOnlyNaView = "";
        $variavelDisabledNaView = "";
        $infoSelectVazio        = $this->infoSelectVazio;

        return view('despesas.edit', compact('despesa', 'listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'todosOSBancos', 'precoReal', 'vale', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView', 'infoSelectVazio', 'paginaModal'));
    }


    public function dadosDespesaEdicaoVisualizacao($id, &$despesa, &$listaContas, &$codigoDespesa, &$listaForncedores, &$formapagamento, &$todasOSAtivas, &$todosOSBancos, &$valorDespesa, &$valorVale, &$precoReal, &$vale, &$valorInput, &$valorSemCadastro, &$variavelReadOnlyNaView, &$variavelDisabledNaView, &$infoSelectVazio)
    {
        $despesa        = Despesa::find($id);

        if (User::find(auth()->user()->id)->cannot('despesa-list-all') &&  $despesa->idAutor !=  auth()->user()->id) {
            abort(401, 'Não Autorizado');
        }

        $listaContas    = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1 order by id = :conta desc', ['conta' => $despesa->conta]);
        $codigoDespesa  = DB::select('select c.id,  c.despesaCodigoDespesa, c.idGrupoCodigoDespesa, g.grupoDespesa from codigodespesas c, grupodespesas g 
        where (c.ativoCodigoDespesa = 1) and (g.id = c.idGrupoCodigoDespesa) order by c.id = :codigoCadastrado desc', ['codigoCadastrado' => $despesa->despesaCodigoDespesas]);

        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento   = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 order by id = :idFormaPagamento desc', ['idFormaPagamento' => $despesa->idFormaPagamento]);
        $todasOSAtivas    = DB::select('SELECT x.* FROM ordemdeservico x WHERE ativoOrdemdeServico = 1 order by id = :idOS desc', ['idOS' => $despesa->idOS]);
        $todosOSBancos    = DB::select('SELECT * FROM banco WHERE ativoBanco = 1 order by id = :idBanco desc', ['idBanco' => $despesa->idBanco]);
        $valorDespesa     = $despesa->precoReal;
        $valorVale        = $despesa->vale;
        $precoReal        = FormatacoesServiceProvider::validaValoresParaView($valorDespesa);
        $vale             = FormatacoesServiceProvider::validaValoresParaView($valorVale);

        $valorInput             = $this->valorInput;
        $valorSemCadastro       = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;
        $infoSelectVazio        = $this->infoSelectVazio;
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

        $despesa            = new Despesa();


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

        $despesaOriginal    =  Despesa::find($despesa->id);

        //É compra, mas não é parcelada
        if (($despesa->ehcompra == 1 || $despesa->ehcompra == '1') && ($despesaOriginal->insereestoque == 1 || $despesaOriginal->insereestoque == '1')) :

            $despesa->descricaoDespesa      =  $request->get('descricaoDespesaCompra');

            $request->validate(
                ['descricaoDespesaCompra' => 'required'],
                ['descricaoDespesaCompra.required' => 'Informe o que foi comprado']
            );
        elseif (($despesa->ehcompra == 1  || $despesa->ehcompra == '1') && ($despesaOriginal->insereestoque == 0 || $despesaOriginal->insereestoque == '0')) :
            $despesa->descricaoDespesa      =  $request->get('descricaoDespesaSemEstoque'); //Input com o datalist aberto
        endif;


        $despesa->idOS                  =  $request->get('idOS');
        $despesa->vencimento            =  $request->get('vencimento');
        $despesa->notaFiscal            =  $request->get('notaFiscal');
        $despesa->pago                  =  $request->get('pago')[0];
        $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('precoReal'));
        $despesa->quantidade            =  $request->get('quantidadeTabelaSemParcelamento');
        $despesa->valorUnitario         =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorUnitario'));


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

            if ((int)$request->get('paginaModal') == 1) {
                $paginaModal = true;
                return redirect()->route('despesas.show', ['id' => $despesa->id])
                    ->with('paginaModal', $paginaModal)
                    ->with('success', 'Despesa ' . $despesa->id  . ' atualizada com êxito.');
            } elseif ((int)$request->get('paginaModal') == 0) {
                return redirect()->route('despesas.show', ['id' => $despesa->id])
                    ->with('success', 'Despesa ' . $despesa->id  . ' atualizada com êxito.');
            }
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
    public function destroy(Request $request, $id)
    {
        $excluiDespesa = Despesa::where('id', $id)->update(['excluidoDespesa' => 1]);
            
        $this->logExcluiDespesas($id);
            
        if($request->assync && $excluiDespesa == '1'): return response()->json(['success' => 'success'], 200); endif;

        return redirect()->route('despesas.index')->with('success', 'Despesa ' . $id . ' excluída com êxito!');
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
