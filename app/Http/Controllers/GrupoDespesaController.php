<?php


namespace App\Http\Controllers;


use App\GrupoDespesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class GrupoDespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:grupodespesa-list|grupodespesa-create|grupodespesa-edit|grupodespesa-delete', ['only' => ['index','show']]);
         $this->middleware('permission:grupodespesa-create', ['only' => ['create','store']]);
         $this->middleware('permission:grupodespesa-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:grupodespesa-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = GrupoDespesa::orderBy('id','DESC')->paginate(5);
        return view('grupodespesas.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function basicLaratableData()
    {
        return Laratables::recordsOf(GrupoDespesa::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupodespesas = DB::select('select * from grupodespesas  where  ativoDespesa = 1');

        return view('grupodespesas.create', compact('grupodespesas'));
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
        'grupoDespesa'      => 'required',
        'ativoDespesa'      => 'required',
        'excluidoDespesa'   => 'required',
        ]);


        GrupoDespesa::create($request->all());


        return redirect()->route('grupodespesas.index')
                        ->with('success','Grupo de Despesa cadastrado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\GrupoDespesa  $grupodespesa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupodespesa = GrupoDespesa::find($id);
        return view('grupodespesas.show',compact('grupodespesa'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GrupoDespesa  $grupodespesa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupodespesa = GrupoDespesa::find($id);
        // $roles = GrupoDespesa::pluck('nomeBanco','nomeBanco')->all();

        return view('grupodespesas.edit',compact('grupodespesa'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GrupoDespesa  $grupodespesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrupoDespesa $grupodespesa)
    {
         request()->validate([
            'grupoDespesa'      => 'required',
            'ativoDespesa'      => 'required',
            'excluidoDespesa'   => 'required',
            ]);


        $grupodespesa->update($request->all());


        return redirect()->route('grupodespesas.index')
                        ->with('success','Grupo de Despesa atualizado com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GrupoDespesa  $grupodespesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        GrupoDespesa::find($id)->delete();

        return redirect()->route('grupodespesas.index')
                        ->with('success','Grupo de Despesa excluído com êxito!');
    }
}
