<?php


namespace App\Http\Controllers;

use App\Despesa;
use App\OrdemdeServico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


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


            $despesa->save();

            return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $salvaOS->id . ' e Despesa n°' . $despesa->id . ' cadastrados com êxito.');
        } else if ($temDespesa === '0') {

            return redirect()->route('ordemdeservicos.index')
                ->with('success', 'Ordem de Serviço n°' . $salvaOS->id . ' cadastrada com êxito. Nenhuma despesa foi associada a esta OS.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\OrdemdeServico  $ordemdeservico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');
        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');

        $ordemdeservico = OrdemdeServico::find($id);

        // $cliente = DB::select('select id, nomeCliente from clientes where ativoCliente = 1');

        $cliente = DB::select('select distinct id, nomeCliente from clientes  where  ativoCliente = 1 and id = :clienteOrdemServico', ['clienteOrdemServico' => $ordemdeservico->idClienteOrdemdeServico]);
        $despesaPorOS = DB::select('select distinct * from despesas  where  ativoDespesa = 1 and idOS = :idOrdemServico', ['idOrdemServico' => $ordemdeservico->id]);


        return view('ordemdeservicos.show', compact('ordemdeservico', 'cliente', 'formapagamento', 'listaContas', 'listaForncedores', 'codigoDespesa','despesaPorOS'));
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
        $roles = OrdemdeServico::pluck('nomeFormaPagamento', 'nomeFormaPagamento')->all();
        $bancoRole = $ordemdeservico->roles->pluck('nomeFormaPagamento', 'nomeFormaPagamento')->all();

        return view('ordemdeservicos.edit', compact('ordemdeservico', 'roles', 'bancoRole'));

        // return view('ordemdeservicos.edit',compact('ordemdeservico'));
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
        request()->validate([
            'nomeFormaPagamento'             => 'required|min:3',
            'idClienteOrdemdeServico'        => 'required|min:3',
            'dataVendaOrdemdeServico'        => 'required|min:3',
            'valorTotalOrdemdeServico'       => 'required|min:3',
            'valorProjetoOrdemdeServico'     => 'required|min:3',
            'valorOrdemdeServico'            => 'required|min:3',
            'dataOrdemdeServico'             => 'required|min:3',
            'clienteOrdemdeServico'          => 'required|min:3',
            'eventoOrdemdeServico'           => 'required|min:3',
            'servicoOrdemdeServico'          => 'required|min:3',
            'obsOrdemdeServico'              => 'required|min:3',
            // 'dataCriacaoOrdemdeServico'      => 'required|min:3',
            'dataExclusaoOrdemdeServico'     => 'required|min:3',

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
