<?php


namespace App\Http\Controllers;

use App\OrdemdeServico;
use App\Despesa;
use App\Receita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Freshbitsweb\Laratables\Laratables;


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

        $data = OrdemdeServico::orderBy('id', 'DESC')->paginate(5);

        // $cliente =  DB::select('select id, nomeCliente from clientes where ativoCliente = 1 and id = :clienteOrdemdeServico', ['clienteOrdemdeServico' => $data->clienteOrdemdeServico]);
        // $id = $data->id;

        // $idClienteOSJoinConta = OrdemdeServico::join("clientes", "ordemdeservico.clienteOrdemdeServico", "=", "clientes.id")
        // ->where("ordemdeservico.clienteOrdemdeServico", $id)
        // ->get();


        return view('ordemdeservicos.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }



    public function basicLaratableData()
    {
        return Laratables::recordsOf(OrdemdeServico::class);
    }

    public function basicLaratableDataReceita()
    {

        return Laratables::recordsOf(Receita::class);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $cliente = DB::select('select id, nomeCliente from clientes where ativoCliente = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');
        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');
        return view('ordemdeservicos.create', compact('cliente', 'formapagamento', 'listaContas', 'listaForncedores', 'codigoDespesa'));
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

        $request->validate([
            'nomeFormaPagamento'             => 'required',
            'idClienteOrdemdeServico'         => 'required',
            'dataVendaOrdemdeServico'        => 'required|min:3',
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



        $ordemdeservico->nomeFormaPagamento               = $request->get('nomeFormaPagamento');
        $ordemdeservico->idClienteOrdemdeServico          = $request->get('idClienteOrdemdeServico');
        $ordemdeservico->dataVendaOrdemdeServico          = $request->get('dataVendaOrdemdeServico');
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

        $temDespesa = $request->get('idCodigoDespesas');
        $temReceita = $request->get('idformapagamentoreceita');


        if ($temDespesa != '0') {

            $despesa = new Despesa();

            $request->validate([
                'idCodigoDespesas'          => 'required',
                'descricaoDespesa'          => 'required',
                'despesaCodigoDespesas'     => 'required',
                'idFornecedor'              => 'required',
                'precoReal'                 => 'required',
                'atuacao'                   => 'required',
                'precoCliente'              => 'required',
                'pago'                      => 'required',
                'quempagou'                 => 'required',
                'idFormaPagamento'          => 'required',
                'conta'                     => 'required',
                'nRegistro'                 => 'required',
                'valorEstornado'            => 'required',
                'data'                      => 'required',
                'totalPrecoReal'            => 'required',
                'totalPrecoCliente'         => 'required',
                'lucro'                     => 'required',
                'ativoDespesa'              => 'required',
                'excluidoDespesa'           => 'required',
            ]);

            $despesa->idCodigoDespesas          = $request->get('idCodigoDespesas');
            $despesa->descricaoDespesa          = $request->get('descricaoDespesa');
            $despesa->despesaCodigoDespesas     = $request->get('despesaCodigoDespesas');
            $despesa->idFornecedor              = $request->get('idFornecedor');
            $despesa->precoReal                 = $request->get('precoReal');
            $despesa->atuacao                   = $request->get('atuacao');
            $despesa->precoCliente              = $request->get('precoCliente');
            $despesa->pago                      = $request->get('pago');
            $despesa->quempagou                 = $request->get('quempagou');
            $despesa->idFormaPagamento          = $request->get('idFormaPagamento');
            $despesa->conta                     = $request->get('conta');
            $despesa->nRegistro                 = $request->get('nRegistro');
            $despesa->valorEstornado            = $request->get('valorEstornado');
            $despesa->data                      = $request->get('data');
            $despesa->totalPrecoReal            = $request->get('totalPrecoReal');
            $despesa->totalPrecoCliente         = $request->get('totalPrecoCliente');
            $despesa->lucro                     = $request->get('lucro');

            $despesa->ativoDespesa              = $request->get('ativoDespesa');
            $despesa->excluidoDespesa           = $request->get('excluidoDespesa');
            $despesa['idOS'] = "$idDaOS";

            $idDespesa = $despesa->id;

            $despesa->save();

        }

        if ($temReceita != '0') {

            $receita = new Receita();

            $request->validate([
                'idformapagamentoreceita'   => 'required',
                'datapagamentoreceita'      => 'required',
                'dataemissaoreceita'        => 'required',
                'valorreceita'              => 'required',
                'pagoreceita'               => 'required',
                'contareceita'              => 'required',
                'registroreceita'           => 'required',
                'emissaoreceita'            => 'required',
                'nfreceita'                 => 'required',
                // 'idosreceita'               => 'required',

            ]);

            $receita->idformapagamentoreceita       = $request->get('idformapagamentoreceita');
            $receita->datapagamentoreceita          = $request->get('datapagamentoreceita');
            $receita->dataemissaoreceita            = $request->get('dataemissaoreceita');
            $receita->valorreceita                  = $request->get('valorreceita');
            $receita->pagoreceita                   = $request->get('pagoreceita');
            $receita->contareceita                  = $request->get('contareceita');
            $receita->registroreceita               = $request->get('registroreceita');
            $receita->emissaoreceita                = $request->get('emissaoreceita');
            $receita->nfreceita                     = $request->get('nfreceita');
            // $receita->idosreceita                   = $request->get('idosreceita');

            $receita['idosreceita'] = "$idDaOS";

            $receita->save();
            $idReceita = $receita->id;

    }


    if (($temDespesa != '0') && ($temReceita != '0')){
                return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $salvaOS->id . ',  Despesa n°' . $idDespesa . ' e Receita n°'. $idReceita .' cadastrados com êxito.');

    }
    else if (($temDespesa != '0') && ($temReceita === '0')){
                return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $salvaOS->id . ',  Despesa n°' . $idDespesa . ' cadastrados com êxito. Nenhuma receita foi cadastrada');

    }
    else if (($temDespesa === '0') && ($temReceita != '0')){
                return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $salvaOS->id . ',  Receita n°' . $idReceita . ' cadastrados com êxito. Nenhuma despesa foi cadastrada');

    }
    else if (($temDespesa === '0') && ($temReceita === '0')){
                return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $salvaOS->id . ' cadastrada com êxito. Não foram cadastradas receitas e despesas');

    }


}



    /**
     * Display the specified resource.
     *
     * @param  \App\OrdemdeServico  $ordemdeservico
     * @return \Illuminate\Http\Response
     */
    public  function show($id )
    {
        $ordemdeservico = OrdemdeServico::find($id);

        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 and id = :idFormaPagamento',['idFormaPagamento' => $ordemdeservico->nomeFormaPagamento ]);
        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');


        $cliente = DB::select('select distinct id, nomeCliente from clientes  where  ativoCliente = 1 and id = :clienteOrdemServico', ['clienteOrdemServico' => $ordemdeservico->idClienteOrdemdeServico]);
        $despesaPorOS = DB::select('select distinct * from despesas  where  ativoDespesa = 1 and idOS = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        $receitasPorOS = DB::select('select distinct * from receita  where  idosreceita = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        $percentualPorOS = DB::select('select distinct * from tabelapercentual  where  idostabelapercentual = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);

        $totaldespesas = DB::select('select sum(despesas.precoReal) as totaldespesa, ordemdeservico.id from despesas, ordemdeservico where despesas.idOS = ordemdeservico.id and ordemdeservico.id = :idOrdemServico GROUP BY id', ['idOrdemServico' => $ordemdeservico->id]);
        $totalreceitas = DB::select('select  sum(r.valorreceita) as totalreceita, o.id from  receita r, ordemdeservico o where  r.idosreceita = o.id and o.id = :idOrdemServico GROUP BY id', ['idOrdemServico' => $ordemdeservico->id]);

        $qtdDespesas = DB::select('select COUNT(precoReal) as numerodespesas FROM despesas where idOS =:idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);
        $qtdReceitas = DB::select('select COUNT(valorreceita) as numeroreceitas FROM receita where idosreceita =:idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);

        return view('ordemdeservicos.show', compact('ordemdeservico', 'cliente', 'formapagamento', 'listaContas', 'listaForncedores', 'codigoDespesa','despesaPorOS','receitasPorOS','percentualPorOS','totaldespesas','totalreceitas','qtdDespesas','qtdReceitas'));
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


        $roles = OrdemdeServico::pluck('nomeFormaPagamento', 'nomeFormaPagamento')->all();
        $bancoRole = $ordemdeservico->roles->pluck('nomeFormaPagamento', 'nomeFormaPagamento')->all();

        return view('ordemdeservicos.edit', compact('ordemdeservico', 'roles', 'bancoRole','listaContas','listaForncedores','cliente', 'formapagamento', 'codigoDespesa'));

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
