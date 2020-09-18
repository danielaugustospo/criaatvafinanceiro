<?php


namespace App\Http\Controllers;


use App\Receita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Freshbitsweb\Laratables\Laratables;



class ReceitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:receita-list|receita-create|receita-edit|receita-delete', ['only' => ['index','show']]);
         $this->middleware('permission:receita-create', ['only' => ['create','store']]);
         $this->middleware('permission:receita-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:receita-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Receita::orderBy('id','DESC')->paginate(5);
        return view('receita.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function basicLaratableData()
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
        $listametodopagamento = DB::select('select * from formapagamento where ativoFormaPagamento = 1 and excluidoFormaPagamento = 0;');
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1' );
        $todasOSAtivas = DB::select('SELECT * FROM ordemdeservico WHERE ativoOrdemdeServico = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');

        return view('receita.create',compact('listaContas','listametodopagamento','todasOSAtivas','formapagamento'));
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


            'idformapagamentoreceita'   => 'required',
            'datapagamentoreceita'      => 'required',
            'dataemissaoreceita'        => 'required',
            'valorreceita'              => 'required',
            'pagoreceita'               => 'required',
            'contareceita'              => 'required',
            'registroreceita'           => 'required',
            'emissaoreceita'            => 'required',
            'nfreceita'                 => 'required',
            'idosreceita'               => 'required',


        ]);



        Receita::create($request->all());


        return redirect()->route('receita.index')
                        ->with('success','Receita cadastrada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receita = Receita::find($id);
        $listametodopagamento = DB::select('select * from formapagamento where ativoFormaPagamento = 1 and excluidoFormaPagamento = 0;');
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1' );

        return view('receita.show',compact('receita','listametodopagamento','listaContas'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receita = Receita::find($id);
        $todasOSAtivas = DB::select('SELECT * FROM ordemdeservico WHERE ativoOrdemdeServico = 1 order by id = :idosreceita desc',['idosreceita' => $receita->idosreceita]);


        $listametodopagamento = DB::select('select * from formapagamento where ativoFormaPagamento = 1 and excluidoFormaPagamento = 0 order by id = :idformapagamentoreceita desc',['idformapagamentoreceita' => $receita->idformapagamentoreceita]);
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1 order by id = :contareceita desc', ['contareceita' => $receita->contareceita]);


        return view('receita.edit',compact('receita','todasOSAtivas','listametodopagamento','listaContas'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receita $receita)
    {
         request()->validate([
            'idformapagamentoreceita'   => 'required',
            'datapagamentoreceita'      => 'required',
            'dataemissaoreceita'        => 'required',
            'valorreceita'              => 'required',
            'pagoreceita'               => 'required',
            'contareceita'              => 'required',
            'registroreceita'           => 'required',
            'emissaoreceita'            => 'required',
            'nfreceita'                 => 'required',
            'idosreceita'               => 'required',
        ]);


        $receita->update($request->all());


        return redirect()->route('receita.index')
                        ->with('success','Receita atualizada com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Receita::find($id)->delete();

        return redirect()->route('receita.index')
                        ->with('success','Receita excluída com êxito!');
    }
}
