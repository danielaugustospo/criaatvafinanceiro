<?php


namespace App\Http\Controllers;


use App\CodigoDespesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CodigoDespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:codigodespesa-list|codigodespesa-create|codigodespesa-edit|codigodespesa-delete', ['only' => ['index','show']]);
         $this->middleware('permission:codigodespesa-create', ['only' => ['create','store']]);
         $this->middleware('permission:codigodespesa-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:codigodespesa-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = CodigoDespesa::orderBy('id','DESC')->paginate(5);
        return view('codigodespesas.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function basicLaratableData()
    {
        return Laratables::recordsOf(CodigoDespesa::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupodespesas = DB::select('select * from grupodespesas  where  ativoDespesa = 1');

        return view('codigodespesas.create', compact('grupodespesas'));
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

        'despesaCodigoDespesa'=> 'required',
        'idGrupoCodigoDespesa'=> 'required',
        'ativoCodigoDespesa'=> 'required',
        'excluidoCodigoDespesa'=> 'required',

        ]);


        CodigoDespesa::create($request->all());


        return redirect()->route('codigodespesas.index')
                        ->with('success','Código de Despesa cadastrado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\CodigoDespesa  $codigodespesa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $codigodespesa = CodigoDespesa::find($id);
        return view('codigodespesas.show',compact('codigodespesa'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CodigoDespesa  $codigodespesa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $codigodespesa = CodigoDespesa::find($id);
        // $roles = CodigoDespesa::pluck('nomeBanco','nomeBanco')->all();

        return view('codigodespesas.edit',compact('codigodespesa'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CodigoDespesa  $codigodespesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CodigoDespesa $codigodespesa)
    {
         request()->validate([
            'despesaCodigoDespesa'=> 'required',
            'idGrupoCodigoDespesa'=> 'required',
            'ativoCodigoDespesa'=> 'required',
            'excluidoCodigoDespesa'=> 'required',
        ]);


        $codigodespesa->update($request->all());


        return redirect()->route('codigodespesas.index')
                        ->with('success','Código de Despesa atualizado com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CodigoDespesa  $codigodespesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        CodigoDespesa::find($id)->delete();

        return redirect()->route('codigodespesas.index')
                        ->with('success','Código de Despesa excluído com êxito!');
    }
}
