<?php


namespace App\Http\Controllers;


use App\Despesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1' );
        return view('despesas.create',compact('listaContas'));
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
        return view('despesas.show',compact('banco'));
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
        $roles = Despesa::pluck('nomeBanco','nomeBanco')->all();
        $bancoRole = $despesa->roles->pluck('nomeBanco','nomeBanco')->all();

        return view('despesas.edit',compact('banco','roles','bancoRole'));

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
            'nomeBanco' => 'required',
            'codigoBanco' => 'required',
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
