<?php


namespace App\Http\Controllers;

use App\OrdemdeServico;
use App\Despesa;
use App\Receita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                    $valorTotalOrdemdeServico = $request->get('valorTotalOrdemdeServico');

                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($idClienteOrdemdeServico)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['idClienteOrdemdeServico'], $request->get('idClienteOrdemdeServico')) ? true : false;
                        });
                    }
                    if (!empty($eventoOrdemdeServico)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['eventoOrdemdeServico'], $request->get('eventoOrdemdeServico')) ? true : false;
                        });
                    }
                    if (!empty($valorTotalOrdemdeServico)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['valorTotalOrdemdeServico'], $request->get('valorTotalOrdemdeServico')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::contains(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['idClienteOrdemdeServico']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['eventoOrdemdeServico']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['valorTotalOrdemdeServico']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="ordemdeservicos/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
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
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $cliente = DB::select('select id, nomeCliente from clientes where ativoCliente = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');
        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');

        $dataInicio = date("d/m/Y");
        // var_dump($ultimaOS);

        return view('ordemdeservicos.create', compact('cliente', 'formapagamento', 'listaContas', 'listaForncedores', 'codigoDespesa', 'ultimaOS', 'dataInicio'));
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

        // $recebe = $request->get('valorreceita');
        $tamanhoArrayReceita = count($temReceita);
        // var_dump($tamanhoArrayReceita);
        // exit;

        $request->validate([
            // 'nomeFormaPagamento'             => 'required',
            'idClienteOrdemdeServico'         => 'required',
            // 'dataVendaOrdemdeServico'        => 'required|min:3',
            'valorTotalOrdemdeServico'       => 'required|min:3',
            'valorProjetoOrdemdeServico'     => 'required|min:3',
            'valorOrdemdeServico'            => 'required|min:3',
            'dataOrdemdeServico'             => 'required|min:3',
            'clienteOrdemdeServico'          => 'required|min:3',
            'eventoOrdemdeServico'           => 'required|min:3',
            'servicoOrdemdeServico'          => 'required|min:3',
            'obsOrdemdeServico'              => 'required|min:3',
            'dataCriacaoOrdemdeServico'      => 'required|min:3',
            'dataExclusaoOrdemdeServico'     => 'required',

            'ativoOrdemdeServico'            => 'required|min:1',
            'excluidoOrdemdeServico'         => 'required|min:1',

        ]);




        // $ordemdeservico->nomeFormaPagamento               = $request->get('nomeFormaPagamento');
        $ordemdeservico->idClienteOrdemdeServico          = $request->get('idClienteOrdemdeServico');
        // $ordemdeservico->dataVendaOrdemdeServico          = $request->get('dataVendaOrdemdeServico');
        $ordemdeservico->valorTotalOrdemdeServico         = $request->get('valorTotalOrdemdeServico');
        $ordemdeservico->valorProjetoOrdemdeServico       = $request->get('valorProjetoOrdemdeServico');
        $ordemdeservico->valorOrdemdeServico              = $request->get('valorOrdemdeServico');
        $ordemdeservico->dataOrdemdeServico               = $request->get('dataOrdemdeServico');
        $ordemdeservico->clienteOrdemdeServico            = $request->get('clienteOrdemdeServico');
        $ordemdeservico->eventoOrdemdeServico             = $request->get('eventoOrdemdeServico');
        $ordemdeservico->servicoOrdemdeServico            = $request->get('servicoOrdemdeServico');
        $ordemdeservico->obsOrdemdeServico                = $request->get('obsOrdemdeServico');
        $ordemdeservico->dataCriacaoOrdemdeServico        = $request->get('dataCriacaoOrdemdeServico');

        $ordemdeservico->ativoOrdemdeServico              = $request->get('ativoOrdemdeServico');
        $ordemdeservico->excluidoOrdemdeServico           = $request->get('excluidoOrdemdeServico');

        $salvaOS = OrdemdeServico::create($request->all());

        $idDaOS = $salvaOS->id;

        // $temDespesa = $request->get('idCodigoDespesas');


        // if ($temDespesa != '0') {

        //     $despesa = new Despesa();

        //     $request->validate([
        //         'idCodigoDespesas'               => 'required',
        //         'idClienteOrdemdeServico'        => 'required',
        //         'despesaCodigoDespesas'          => 'required',
        //         'idFornecedor'                   => 'required',
        //         'eventoOrdemdeServico'           => 'required',
        //         'atuacao'                        => 'required',
        //         'precoCliente'                   => 'required',
        //         'pago'                           => 'required',
        //         'quempagou'                      => 'required',
        //         'idFormaPagamento'               => 'required',
        //         'conta'                          => 'required',
        //         'nRegistro'                      => 'required',
        //         'valorEstornado'                 => 'required',
        //         'data'                           => 'required',
        //         'totaleventoOrdemdeServico'      => 'required',
        //         'totalPrecoCliente'              => 'required',
        //         'lucro'                          => 'required',
        //         'ativoDespesa'                   => 'required',
        //         'excluidoDespesa'                => 'required',
        //     ]);

        //     $despesa->idCodigoDespesas           = $request->get('idCodigoDespesas');
        //     $despesa->idClienteOrdemdeServico    = $request->get('idClienteOrdemdeServico');
        //     $despesa->despesaCodigoDespesas      = $request->get('despesaCodigoDespesas');
        //     $despesa->idFornecedor               = $request->get('idFornecedor');
        //     $despesa->eventoOrdemdeServico       = $request->get('eventoOrdemdeServico');
        //     $despesa->atuacao                    = $request->get('atuacao');
        //     $despesa->precoCliente               = $request->get('precoCliente');
        //     $despesa->pago                       = $request->get('pago');
        //     $despesa->quempagou                  = $request->get('quempagou');
        //     $despesa->idFormaPagamento           = $request->get('idFormaPagamento');
        //     $despesa->conta                      = $request->get('conta');
        //     $despesa->nRegistro                  = $request->get('nRegistro');
        //     $despesa->valorEstornado             = $request->get('valorEstornado');
        //     $despesa->data                       = $request->get('data');
        //     $despesa->totaleventoOrdemdeServico  = $request->get('totaleventoOrdemdeServico');
        //     $despesa->totalPrecoCliente          = $request->get('totalPrecoCliente');
        //     $despesa->lucro                      = $request->get('lucro');

        //     $despesa->ativoDespesa               = $request->get('ativoDespesa');
        //     $despesa->excluidoDespesa            = $request->get('excluidoDespesa');
        //     $despesa['idOS'] = "$idDaOS";

        //     $idDespesa = $despesa->id;

        //     $despesa->save();

        // }

        if ($temReceita != '0') {

            // $receita->idformapagamentoreceita       = $request->get('idformapagamentoreceita');
            // var_dump($request->get('idformapagamentoreceita')[0]);
            // exit;
            for ($i = 0; $i < $tamanhoArrayReceita; $i++) {
                $receita = new Receita();
                $request->validate([
                    'idformapagamentoreceita'       => 'required',
                    'datapagamentoreceita'          => 'required',
                    'dataemissaoreceita'            => 'required',
                    'valorreceita'                  => 'required',
                    'pagoreceita'                   => 'required',
                    'contareceita'                  => 'required',
                    // 'registroreceita'            => 'required',
                    // 'emissaoreceita'             => 'required',
                    'nfreceita'                     => 'required',
                    // 'idosreceita'                => 'required',

                ]);

                $receita->idformapagamentoreceita       = $request->get('idformapagamentoreceita')[$i];
                $receita->datapagamentoreceita          = $request->get('datapagamentoreceita')[$i];
                $receita->dataemissaoreceita            = $request->get('dataemissaoreceita')[$i];
                $receita->valorreceita                  = $request->get('valorreceita')[$i];
                $receita->pagoreceita                   = $request->get('pagoreceita')[$i];
                $receita->contareceita                  = $request->get('contareceita')[$i];
                $receita->registroreceita               = $request->get('registroreceita');
                // $receita->emissaoreceita             = $request->get('emissaoreceita');
                $receita->nfreceita                     = $request->get('nfreceita')[0];
                // $receita->idosreceita                = $request->get('idosreceita');

                $receita['idosreceita'] = "$idDaOS";



                $receita->save();
                $idReceita = $receita->id;
            }
        }


        // if (($temDespesa != '0') && ($temReceita != '0')){
        if ($temReceita != '0') {
            return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $salvaOS->id  . ' com ' . $tamanhoArrayReceita . ' parcelas cadastrada com êxito.');
        }
        // else if (($temDespesa != '0') && ($temReceita === '0')){
        //             return redirect()->route('ordemdeservicos.index')
        //             ->with('success', 'Ordem de Serviço n°' . $salvaOS->id . ',  Despesa n°' . $idDespesa . ' cadastrados com êxito. Nenhuma receita foi cadastrada');

        // }
        // else if (($temDespesa === '0') && ($temReceita != '0')){
        //             return redirect()->route('ordemdeservicos.index')
        //             ->with('success', 'Ordem de Serviço n°' . $salvaOS->id . ',  Receita n°' . $idReceita . ' cadastrados com êxito. Nenhuma despesa foi cadastrada');

        // }
        // else if (($temDespesa === '0') && ($temReceita === '0')){
        else if ($temReceita === '0') {
            return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $salvaOS->id . ' cadastrada com êxito. Não foram cadastradas receitas.');
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

        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 and id = :idFormaPagamento', ['idFormaPagamento' => $ordemdeservico->nomeFormaPagamento]);
        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');


        $cliente = DB::select('select distinct id, nomeCliente from clientes  where  ativoCliente = 1 and id = :clienteOrdemServico', ['clienteOrdemServico' => $ordemdeservico->idClienteOrdemdeServico]);
        $despesaPorOS = DB::select('select distinct * from despesas  where  ativoDespesa = 1 and idOS = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        $receitasPorOS = DB::select('select distinct * from receita  where  idosreceita = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        $percentualPorOS = DB::select('select distinct * from tabelapercentual  where  idostabelapercentual = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);

        $totaldespesas = DB::select('select sum(despesas.precoReal) as totaldespesa, ordemdeservico.id from despesas, ordemdeservico where despesas.idOS = ordemdeservico.id and ordemdeservico.id = :idOrdemServico GROUP BY id', ['idOrdemServico' => $ordemdeservico->id]);
        $contadorDespesas = count($totaldespesas);

        if ($contadorDespesas == 0) {
            $getArrayTotalDespesas = 0.00;
        } else {
            $getArrayTotalDespesas = $totaldespesas[0]->totaldespesa;
        }

        $totalreceitas = DB::select('select  sum(r.valorreceita) as totalreceita, o.id from  receita r, ordemdeservico o where  r.idosreceita = o.id and o.id = :idOrdemServico GROUP BY id', ['idOrdemServico' => $ordemdeservico->id]);
        // var_dump($totalreceitas);
        // exit;
        $tamanhoArrayReceita = count($totalreceitas);
        if ($tamanhoArrayReceita == 0) {
            $getArrayTotalReceitas = 0.00;
        } else {
            $getArrayTotalReceitas = $totalreceitas[0]->totalreceita;
        }

        $totalOS = $ordemdeservico->valorTotalOrdemdeServico;

        bcscale(2);
        $lucro = bcsub($getArrayTotalReceitas, $getArrayTotalDespesas);

        $porcentagemDespesa = bcmul($getArrayTotalDespesas, 100); //cem por cento da regra de tres
        if (($porcentagemDespesa > 0 ) && ($totalOS > 0)){
            $porcentagemDespesa = bcdiv($porcentagemDespesa, $totalOS); // divido pelo total da OS
        }

        $porcentagemReceita = bcmul($getArrayTotalReceitas, 100); //cem por cento da regra de tres
        if (($porcentagemReceita > 0 ) && ($totalOS > 0)){
            $porcentagemReceita = bcdiv($porcentagemReceita, $totalOS); // divido pelo total da OS
        }

        $porcentagemLucro = bcmul($lucro, 100); //cem por cento da regra de tres

        if (($porcentagemLucro > 0 ) && ($totalOS > 0)){
            $porcentagemLucro = bcdiv($porcentagemLucro, $totalOS); // divido pelo total da OS
        }


        // $porcentagemDespesa = bcmul($porcentagemDespesa, 100); //multiplica por 100 para obter porcentagem

        // var_dump($porcentagemDespesa);
        // exit;


        $totalreceitas = number_format($getArrayTotalReceitas, 2, ',', '.');
        $totaldespesas = number_format($getArrayTotalDespesas, 2, ',', '.');
        $totalOS = number_format($ordemdeservico->valorTotalOrdemdeServico, 2, ',', '.');
        $lucro = number_format($lucro, 2, ',', '.');



        // var_dump($lucro);
        // exit;

        $qtdDespesas = DB::select('select COUNT(precoReal) as numerodespesas FROM despesas where idOS =:idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        $qtdReceitas = DB::select('select COUNT(valorreceita) as numeroreceitas FROM receita where idosreceita =:idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);

        return view('ordemdeservicos.show', compact('ordemdeservico', 'cliente', 'formapagamento', 'listaContas', 'listaForncedores', 'codigoDespesa', 'despesaPorOS', 'receitasPorOS', 'percentualPorOS', 'totaldespesas', 'totalreceitas', 'qtdDespesas', 'qtdReceitas', 'lucro', 'totalOS', 'porcentagemDespesa', 'porcentagemReceita', 'porcentagemLucro'));
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

        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $cliente = DB::select('select id, nomeCliente from clientes where ativoCliente = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');
        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');


        // $roles = OrdemdeServico::pluck('nomeFormaPagamento', 'nomeFormaPagamento')->all();
        // $bancoRole = $ordemdeservico->roles->pluck('nomeFormaPagamento', 'nomeFormaPagamento')->all();

        return view('ordemdeservicos.edit', compact('ordemdeservico', 'listaContas', 'listaForncedores', 'cliente', 'formapagamento', 'codigoDespesa'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdemdeServico  $ordemdeservico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdemdeServico $ordemdeservico)
    {
        $request->validate([
            'nomeFormaPagamento'             => 'required',
            'idClienteOrdemdeServico'        => 'required',
            'dataVendaOrdemdeServico'        => 'required',
            'valorTotalOrdemdeServico'       => 'required',
            'valorProjetoOrdemdeServico'     => 'required',
            'valorOrdemdeServico'            => 'required',
            'dataOrdemdeServico'             => 'required',
            'clienteOrdemdeServico'          => 'required',
            'eventoOrdemdeServico'           => 'required',
            'servicoOrdemdeServico'          => 'required',
            'obsOrdemdeServico'              => 'required',
            'dataCriacaoOrdemdeServico'      => 'required',
            'dataExclusaoOrdemdeServico'     => 'required',

            'ativoOrdemdeServico'            => 'required|min:1',
            'excluidoOrdemdeServico'         => 'required|min:1',

        ]);



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
