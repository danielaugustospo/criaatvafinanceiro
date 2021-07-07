<?php


namespace App\Http\Controllers;

use App\OrdemdeServico;
use App\Despesa;
use App\Receita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\FormatacoesServiceProvider;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
// use Freshbitsweb\Laratables\Laratables;
use DataTables;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class OrdemdeServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:ordemdeservico-list|ordemdeservico-create|ordemdeservico-edit|ordemdeservico-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:ordemdeservico-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:ordemdeservico-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:ordemdeservico-delete', ['only' => ['destroy']]);

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
        if ($request->ajax()) {

            $data = OrdemdeServico::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $idClienteOrdemdeServico = $request->get('idClienteOrdemdeServico');
                    $eventoOrdemdeServico = $request->get('eventoOrdemdeServico');
                    $valorOrdemdeServico = $request->get('valorOrdemdeServico');

                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($idClienteOrdemdeServico)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idClienteOrdemdeServico'], $request->get('idClienteOrdemdeServico')) ? true : false;
                        });
                    }
                    if (!empty($eventoOrdemdeServico)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['eventoOrdemdeServico'], $request->get('eventoOrdemdeServico')) ? true : false;
                        });
                    }
                    if (!empty($valorOrdemdeServico)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['valorOrdemdeServico'], $request->get('valorOrdemdeServico')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idClienteOrdemdeServico']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['eventoOrdemdeServico']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['valorOrdemdeServico']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="ordemdeservicos/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar Financeiro</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = OrdemdeServico::orderBy('id', 'DESC')->paginate(5);
            return view('ordemdeservicos.index', compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $ultimaOS = DB::select('select max(id) idMaximo from ordemdeservico');
        if (isset($ultimaOS)) {
            $ultimaOSParseInt = $ultimaOS[0]->idMaximo;
            $novaOS = $ultimaOSParseInt + 1;
        }

        $listaContas = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $cliente = DB::select('select id, nomeCliente, razaosocialCliente from clientes where ativoCliente = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');
        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');

        $dataInicio = date("d/m/Y");

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('ordemdeservicos.create', compact('novaOS', 'cliente', 'formapagamento', 'listaContas', 'listaForncedores', 'codigoDespesa', 'ultimaOS', 'dataInicio', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ordemdeservico = new OrdemdeServico();
        $temReceita = $request->get('idformapagamentoreceita');

        $tamanhoArrayReceita = count($temReceita);
        $request->validate([
            'idClienteOrdemdeServico'        => 'required',
            'valorProjetoOrdemdeServico'     => 'required|min:3',
            'valorOrdemdeServico'            => 'required|min:3',
            'dataOrdemdeServico'             => 'required|min:3',
            'clienteOrdemdeServico'          => 'required|min:3',
            'eventoOrdemdeServico'           => 'required|min:3',
            'servicoOrdemdeServico'          => 'required|min:3',
            'dataCriacaoOrdemdeServico'      => 'required|min:3',
            'dataExclusaoOrdemdeServico'     => 'required',

            'ativoOrdemdeServico'            => 'required|min:1',
            'excluidoOrdemdeServico'         => 'required|min:1',
        ]);

        $valorMonetario                                   = $request->get('valorOrdemdeServico');

        $ordemdeservico->idClienteOrdemdeServico          = $request->get('idClienteOrdemdeServico');
        $ordemdeservico->valorProjetoOrdemdeServico       = $request->get('valorProjetoOrdemdeServico');
        $ordemdeservico->valorOrdemdeServico              = $valorMonetario;
        $ordemdeservico->dataOrdemdeServico               = $request->get('dataOrdemdeServico');
        $ordemdeservico->clienteOrdemdeServico            = $request->get('clienteOrdemdeServico');
        $ordemdeservico->eventoOrdemdeServico             = $request->get('eventoOrdemdeServico');
        $ordemdeservico->servicoOrdemdeServico            = $request->get('servicoOrdemdeServico');
        $ordemdeservico->obsOrdemdeServico                = $request->get('obsOrdemdeServico');
        $ordemdeservico->dataCriacaoOrdemdeServico        = $request->get('dataCriacaoOrdemdeServico');
        $ordemdeservico->ativoOrdemdeServico              = $request->get('ativoOrdemdeServico');
        $ordemdeservico->excluidoOrdemdeServico           = $request->get('excluidoOrdemdeServico');

        $salvaOS = $ordemdeservico->save();
        $idDaOS = $ordemdeservico->id;

        if ($temReceita != '0') {

            for ($i = 0; $i < $tamanhoArrayReceita; $i++) {
                $receita = new Receita();
                $request->validate([
                    'idformapagamentoreceita'       => 'required',
                    'datapagamentoreceita'          => 'required',
                    'valorreceita'                  => 'required',
                    'pagoreceita'                   => 'required',
                    'contareceita'                  => 'required',
                    'nfreceita'                     => 'required',

                ]);

                $receita->idformapagamentoreceita       = $request->get('idformapagamentoreceita')[$i];
                $receita->datapagamentoreceita          = $request->get('datapagamentoreceita')[$i];
                $receita->dataemissaoreceita            = $request->get('dataemissaoreceita')[$i];
                $receita->valorreceita                  = FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorreceita')[$i]);
                $receita->pagoreceita                   = $request->get('pagoreceita')[$i];
                $receita->contareceita                  = $request->get('contareceita')[$i];
                $receita->registroreceita               = $request->get('registroreceita');
                $receita->nfreceita                     = $request->get('nfreceita')[0];

                $receita['idosreceita']                 = "$idDaOS";

                $receita->save();
                $idReceita = $receita->id;
            }
        }

        if ($temReceita != '0') {
            return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $idDaOS  . ' com ' . $tamanhoArrayReceita . ' parcela(s) cadastrada(s) com êxito.');
        } else if ($temReceita === '0') {
            return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $idDaOS . ' cadastrada com êxito. Não foram cadastradas receitas.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdemdeServico  $ordemdeservico
     * @return \Illuminate\Http\Response
     */
    public  function show($id)
    {
        $ordemdeservico = OrdemdeServico::find($id);
        $dataInicio = $ordemdeservico->dataCriacaoOrdemdeServico;

        $listaContas = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 and id = :idFormaPagamento', ['idFormaPagamento' => $ordemdeservico->nomeFormaPagamento]);
        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');


        $cliente = DB::select('select distinct id, nomeCliente, razaosocialCliente from clientes  where  ativoCliente = 1 and id = :clienteOrdemServico', ['clienteOrdemServico' => $ordemdeservico->idClienteOrdemdeServico]);
        $despesaPorOS = DB::select('select distinct * from despesas  where  ativoDespesa = 1 and idOS = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        $receitasPorOS = DB::select('select distinct * from receita  where  idosreceita = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        $percentualPorOS = DB::select('select distinct * from tabelapercentual  where  idostabelapercentual = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);

        $totaldespesas = DB::select('select sum(despesas.precoReal) as totaldespesa, ordemdeservico.id from despesas, ordemdeservico where despesas.idOS = ordemdeservico.id and ordemdeservico.id = :idOrdemServico GROUP BY id', ['idOrdemServico' => $ordemdeservico->id]);
        $totaldespesasAPagar = DB::select('select sum(despesas.precoReal) as totaldespesa, ordemdeservico.id from despesas, ordemdeservico where despesas.idOS = ordemdeservico.id and despesas.pago = "N" and ordemdeservico.id = :idOrdemServico GROUP BY id', ['idOrdemServico' => $ordemdeservico->id]);

        $contadorDespesas = count($totaldespesas);
        $contadorDespesasAPagar = count($totaldespesasAPagar);

        if ($contadorDespesas == 0) {
            $getArrayTotalDespesas = 0.00;
        } else {
            $getArrayTotalDespesas = $totaldespesas[0]->totaldespesa;
        }
        //verifica o contador de todas as despesas a pagar
        if ($contadorDespesasAPagar == 0) {
            $getArrayTotalDespesasAPagar = 0.00;
        } else {
            $getArrayTotalDespesasAPagar = $totaldespesasAPagar[0]->totaldespesa;
        }

        $totalreceitas = DB::select('select  sum(r.valorreceita) as totalreceita, o.id from  receita r, ordemdeservico o where  r.idosreceita = o.id and o.id = :idOrdemServico GROUP BY id', ['idOrdemServico' => $ordemdeservico->id]);
        $totalreceitasAPagar = DB::select('select  sum(r.valorreceita) as totalreceita, o.id from  receita r, ordemdeservico o where  r.idosreceita = o.id and r.pagoreceita = "N" and o.id = :idOrdemServico GROUP BY id', ['idOrdemServico' => $ordemdeservico->id]);

        $tamanhoArrayReceita = count($totalreceitas);
        if ($tamanhoArrayReceita == 0) {
            $getArrayTotalReceitas = 0.00;
        } else {
            $getArrayTotalReceitas = $totalreceitas[0]->totalreceita;
        }

        $tamanhoArrayReceitaAPagar = count($totalreceitasAPagar);
        if ($tamanhoArrayReceitaAPagar == 0) {
            $getArrayTotalReceitasAPagar = 0.00;
        } else {
            $getArrayTotalReceitasAPagar = $totalreceitasAPagar[0]->totalreceita;
        }

        $totalOS = $ordemdeservico->valorOrdemdeServico;

        bcscale(2);
        $lucro = bcsub($getArrayTotalReceitas, $getArrayTotalDespesas);

        $porcentagemDespesa = bcmul($getArrayTotalDespesas, 100); //cem por cento da regra de tres
        if (($porcentagemDespesa > 0) && ($totalOS > 0)) {
            $porcentagemDespesa = bcdiv($porcentagemDespesa, $totalOS); // divido pelo total da OS
        }

        $porcentagemReceita = bcmul($getArrayTotalReceitas, 100); //cem por cento da regra de tres
        if (($porcentagemReceita > 0) && ($totalOS > 0)) {
            $porcentagemReceita = bcdiv($porcentagemReceita, $totalOS); // divido pelo total da OS
        }

        $porcentagemDespesaAPagar = bcmul($getArrayTotalDespesasAPagar, 100); //cem por cento da regra de tres
        if (($porcentagemDespesaAPagar > 0) && ($totalOS > 0)) {
            $porcentagemDespesaAPagar = bcdiv($porcentagemDespesaAPagar, $totalOS); // divido pelo total da OS
        }

        $porcentagemReceitaAPagar = bcmul($getArrayTotalReceitasAPagar, 100); //cem por cento da regra de tres
        if (($porcentagemReceita > 0) && ($totalOS > 0)) {
            $porcentagemReceitaAPagar = bcdiv($porcentagemReceitaAPagar, $totalOS); // divido pelo total da OS
        }

        $porcentagemLucro = bcmul($lucro, 100); //cem por cento da regra de tres

        if (($porcentagemLucro > 0) && ($totalOS > 0)) {
            $porcentagemLucro = bcdiv($porcentagemLucro, $totalOS); // divido pelo total da OS
        }


        // $porcentagemDespesa = bcmul($porcentagemDespesa, 100); //multiplica por 100 para obter porcentagem

        // var_dump($porcentagemDespesa);
        // exit;


        // $totalreceitas  = "";
        // $totaldespesas  = "";
        // $totalOS        = "";
        // $lucro          = "";

        $totalreceitas = number_format($getArrayTotalReceitas, 2, ',', '.');
        $totalreceitasAPagar = number_format($getArrayTotalReceitasAPagar, 2, ',', '.');
        $totaldespesas = number_format($getArrayTotalDespesas, 2, ',', '.');
        $totaldespesasAPagar = number_format($getArrayTotalDespesasAPagar, 2, ',', '.');
        $totalOS = number_format($ordemdeservico->valorOrdemdeServico, 2, ',', '.');
        $lucro = number_format($lucro, 2, ',', '.');



        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;


        $qtdDespesas = DB::select('select COUNT(precoReal) as numerodespesas FROM despesas where idOS =:idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        $qtdReceitas = DB::select('select COUNT(valorreceita) as numeroreceitas FROM receita where idosreceita =:idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);

        return view('ordemdeservicos.show', compact('ordemdeservico', 'dataInicio', 'cliente', 'formapagamento', 'listaContas', 'listaForncedores', 'codigoDespesa', 'despesaPorOS', 'receitasPorOS', 'percentualPorOS', 'totaldespesas', 'totaldespesasAPagar', 'totalreceitas', 'totalreceitasAPagar', 'qtdDespesas', 'qtdReceitas', 'lucro', 'totalOS', 'porcentagemDespesa', 'porcentagemReceita', 'porcentagemLucro', 'porcentagemDespesaAPagar', 'porcentagemReceitaAPagar', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdemdeServico  $ordemdeservico
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ordemdeservico = OrdemdeServico::find($id);
        $dataInicio = $ordemdeservico->dataCriacaoOrdemdeServico;

        $listaContas = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $cliente = DB::select('select id, nomeCliente, razaosocialCliente from clientes where ativoCliente = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');

        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');

        $receitasPorOS = DB::select('select distinct id as idReceita, idosreceita, idclientereceita,idformapagamentoreceita,datapagamentoreceita,dataemissaoreceita,valorreceita,pagoreceita,contareceita,descricaoreceita,registroreceita,nfreceita from receita  where  idosreceita = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);

        $valorOS = $ordemdeservico->valorOrdemdeServico;
        if (isset($valorOS)) {
            $ordemdeservico->valorOrdemdeServico = number_format($valorOS, 2, ',', '.');
        }

        $contadorReceita = count($receitasPorOS);

        if ($contadorReceita == 0 || $contadorReceita == null) {
            $valorTratadoReceita[0] = 0.0;
        } else {
            for ($i = 0; $i < $contadorReceita; $i++) {
                $valorMonetarioReceita[$i] = $receitasPorOS[$i]->valorreceita;
                $receitasPorOS[$i]->valorreceita = FormatacoesServiceProvider::validaValoresParaView($valorMonetarioReceita[$i]);
            }
        }

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('ordemdeservicos.edit', compact('ordemdeservico', 'dataInicio', 'listaContas', 'listaForncedores', 'cliente', 'formapagamento', 'codigoDespesa', 'receitasPorOS', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdemdeServico  $ordemdeservico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdemdeServico $ordemdeservico, Receita $receita)
    {
        $temReceita = $request->get('idformapagamentoreceita');
        $tamanhoArrayReceita = count($temReceita);

        $request->validate([
            // 'nomeFormaPagamento'             => 'required',
            'idClienteOrdemdeServico'         => 'required',
            // 'dataVendaOrdemdeServico'        => 'required|min:3',
            // 'valorProjetoOrdemdeServico'     => 'required|min:3',
            'valorOrdemdeServico'            => 'required|min:3',
            'dataOrdemdeServico'             => 'required|min:3',
            'clienteOrdemdeServico'          => 'required|min:3',
            'eventoOrdemdeServico'           => 'required|min:3',
            'servicoOrdemdeServico'          => 'required|min:3',
            // 'obsOrdemdeServico'              => 'required|min:3',
            // 'dataCriacaoOrdemdeServico'      => 'required|min:3',
            // 'dataExclusaoOrdemdeServico'     => 'required',

        ]);

        if ($temReceita != '0') {


            for ($i = 0; $i < $tamanhoArrayReceita; $i++) {

                $request->validate([
                    'idformapagamentoreceita'       => 'required',
                    'datapagamentoreceita'          => 'required',
                    // 'dataemissaoreceita'            => 'required',
                    'valorreceita'                  => 'required',
                    'pagoreceita'                   => 'required',
                    'contareceita'                  => 'required',
                    // 'registroreceita'            => 'required',
                    // 'emissaoreceita'             => 'required',
                    'nfreceita'                     => 'required',
                    // 'idosreceita'                => 'required',

                ]);



                $valorMonetarioReceita[$i]                  = $request->get('valorreceita')[$i];
                $valorReceita[$i] = FormatacoesServiceProvider::validaValoresParaBackEnd($valorMonetarioReceita[$i]);

                // $receita = new Receita;
                $receita->idReceita                     = $request->get('idReceita')[$i];
                $receita->idformapagamentoreceita       = $request->get('idformapagamentoreceita')[$i];
                $receita->datapagamentoreceita          = $request->get('datapagamentoreceita')[$i];
                $receita->dataemissaoreceita            = $request->get('dataemissaoreceita')[$i];
                $receita->valorreceita                  = $valorReceita[$i];
                $receita->pagoreceita                   = $request->get('pagoreceita')[$i];
                $receita->contareceita                  = $request->get('contareceita')[$i];
                $receita->registroreceita               = $request->get('registroreceita');
                // $receita->emissaoreceita             = $request->get('emissaoreceita');
                $receita->nfreceita                     = $request->get('nfreceita')[0];
                $receita->idosreceita                   = $request->get('idosreceita');

                $receita['idosreceita'] = $ordemdeservico->id;


                if ($receita->idReceita == 'novo') {
                    DB::insert(
                        'insert into receita 
                    (idformapagamentoreceita,
                    datapagamentoreceita,
                    dataemissaoreceita,
                    valorreceita,
                    pagoreceita,
                    contareceita,
                    registroreceita,
                    nfreceita,
                    idosreceita) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                        [
                            $receita->idformapagamentoreceita,
                            $receita->datapagamentoreceita,
                            $receita->dataemissaoreceita,
                            $receita->valorreceita,
                            $receita->pagoreceita,
                            $receita->contareceita,
                            $receita->registroreceita,
                            $receita->nfreceita,
                            $receita->idosreceita
                        ]
                    );
                } else {
                    DB::update(
                        "UPDATE receita
                SET idformapagamentoreceita = '$receita->idformapagamentoreceita', 
                datapagamentoreceita        = '$receita->datapagamentoreceita',           
                dataemissaoreceita          = '$receita->dataemissaoreceita',             
                valorreceita                = '$receita->valorreceita',                   
                pagoreceita                 = '$receita->pagoreceita',                    
                contareceita                = '$receita->contareceita',                   
                registroreceita             = '$receita->registroreceita',                
                nfreceita                   = '$receita->nfreceita',                      
                idosreceita                 = '$receita->idosreceita'                  
                WHERE id                    = '$receita->idReceita'"
                    );
                }
            }
        }
        $request['valorOrdemdeServico'] = FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorOrdemdeServico'));
        $ordemdeservico->update($request->all());

        return redirect()->route('ordemdeservicos.index')
            ->with('success', 'Ordem de Serviço atualizada com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdemdeServico  $ordemdeservico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrdemdeServico::find($id)->delete();
        return redirect()->route('ordemdeservicos.index')
            ->with('success', 'Ordem de Serviço excluída com êxito!');
    }
}
