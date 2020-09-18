<?php


namespace App\Http\Controllers;


use App\Despesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Freshbitsweb\Laratables\Laratables;


class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:despesa-list|despesa-create|despesa-edit|despesa-delete', ['only' => ['index','show']]);
         $this->middleware('permission:despesa-create', ['only' => ['create','store']]);
         $this->middleware('permission:despesa-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:despesa-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Despesa::orderBy('id','DESC')->paginate(5);
        return view('despesas.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function basicLaratableData()
    {
        return Laratables::recordsOf(Despesa::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1' );
        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');
        $todasOSAtivas = DB::select('SELECT x.* FROM `dbo.financeirocriaatvahm`.ordemdeservico x
        WHERE ativoOrdemdeServico = 1');

        return view('despesas.create',compact('listaContas','codigoDespesa','listaForncedores','formapagamento','todasOSAtivas'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'idCodigoDespesas'          => 'required',
            'idOS'                      => 'required',
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



        Despesa::create($request->all());


        return redirect()->route('despesas.index')
                        ->with('success','Despesa cadastrada com êxito.');
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

        $listaContas  = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1 order by id = :conta desc', ['conta' => $despesa->conta] );

        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1 order by id = :codigoCadastrado desc', ['codigoCadastrado' => $despesa->idCodigoDespesas] );
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 order by id = :idFormaPagamento desc',['idFormaPagamento' => $despesa->idFormaPagamento]);
        $todasOSAtivas = DB::select('SELECT x.* FROM `dbo.financeirocriaatvahm`.ordemdeservico x
        WHERE ativoOrdemdeServico = 1 order by id = :idOS desc',['idOS' => $despesa->idOS]);

        return view('despesas.show',compact('despesa','listaContas','codigoDespesa','listaForncedores','formapagamento','todasOSAtivas'));
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

        $listaContas  = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1 order by id = :conta desc', ['conta' => $despesa->conta] );

        $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1 order by id = :codigoCadastrado desc', ['codigoCadastrado' => $despesa->idCodigoDespesas] );
        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 order by id = :idFormaPagamento desc',['idFormaPagamento' => $despesa->idFormaPagamento]);
        $todasOSAtivas = DB::select('SELECT x.* FROM `dbo.financeirocriaatvahm`.ordemdeservico x
        WHERE ativoOrdemdeServico = 1 order by id = :idOS desc',['idOS' => $despesa->idOS]);

        return view('despesas.edit',compact('despesa','listaContas','codigoDespesa','listaForncedores','formapagamento','todasOSAtivas'));

        // return view('despesas.edit',compact('banco'));
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
            'idCodigoDespesas'          => 'required',
            'idOS'                      => 'required',
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

        $despesa->update($request->all());

        return redirect()->route('despesas.index')
                        ->with('success','Despesa atualizada com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Despesa::find($id)->delete();

        return redirect()->route('despesas.index')
                        ->with('success','Despesa excluída com êxito!');
    }
}
