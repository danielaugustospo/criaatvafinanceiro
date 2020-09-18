<?php


namespace App\Http\Controllers;


use App\TabelaPercentual;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Freshbitsweb\Laratables\Laratables;



class TabelaPercentualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:tabelapercentual-list|tabelapercentual-create|tabelapercentual-edit|tabelapercentual-delete', ['only' => ['index','show']]);
         $this->middleware('permission:tabelapercentual-create', ['only' => ['create','store']]);
         $this->middleware('permission:tabelapercentual-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tabelapercentual-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = TabelaPercentual::orderBy('id','DESC')->paginate(5);
        return view('tabelapercentual.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


    }

    public function basicLaratableData()
    {
        return Laratables::recordsOf(TabelaPercentual::class);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $todasOSAtivas = DB::select('SELECT * FROM ordemdeservico WHERE ativoOrdemdeServico = 1');

        return view('tabelapercentual.create', compact('todasOSAtivas'));
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

            'nometabelapercentual'          => 'required',
            'percentualtabelapercentual'    => 'required',
            'pgtabelapercentual'            => 'required',
            'idostabelapercentual'          => 'required',


        ]);


        TabelaPercentual::create($request->all());


        return redirect()->route('tabelapercentual.index')
                        ->with('success','Tabela percentual cadastrada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\TabelaPercentual  $banco
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tabelapercentual = TabelaPercentual::find($id);
        return view('tabelapercentual.show',compact('tabelapercentual'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TabelaPercentual  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tabelapercentual = TabelaPercentual::find($id);
        // $roles = TabelaPercentual::pluck('nomeBanco','nomeBanco')->all();
        // $bancoRole = $banco->roles->pluck('nomeBanco','nomeBanco')->all();

        return view('tabelapercentual.edit',compact('tabelapercentual'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TabelaPercentual  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TabelaPercentual $banco)
    {
         request()->validate([
            'nomeBanco' => 'required',
            'codigoBanco' => 'required',
        ]);


        $banco->update($request->all());


        return redirect()->route('tabelapercentual.index')
                        ->with('success','Tabela percentual atualizado com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TabelaPercentual  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        TabelaPercentual::find($id)->delete();

        return redirect()->route('tabelapercentual.index')
                        ->with('success','Tabela percentual excluído com êxito!');
    }
}
