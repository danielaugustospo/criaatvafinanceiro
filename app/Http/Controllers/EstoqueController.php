<?php


namespace App\Http\Controllers;


use App\Estoque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:estoque-list|estoque-create|estoque-edit|estoque-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:estoque-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:estoque-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:estoque-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Estoque::orderBy('id', 'DESC')->paginate(5);
        return view('estoque.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function apiestoque()
    {
                            $estoque = Estoque::select('estoque.id', 'estoque.idbenspatrimoniais', 
                            \DB::raw('SUM(estoque.quantidade) as quantidade'), 'estoque.descricao', 'benspatrimoniais.nomeBensPatrimoniais')
                            ->leftJoin('benspatrimoniais', 'estoque.idbenspatrimoniais', '=', 'benspatrimoniais.id')
                            ->where('estoque.quantidade', '>', 0)
                            ->where('ativadoestoque', 1)
                            ->whereNull('estoque.deleted_at')
                            ->groupBy('estoque.idbenspatrimoniais')
                            ->get();

        return $estoque;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estoque.create');
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

            'codbarras'                     => 'required|min:3',
            'nomematerial'                  => 'required',
            'descricao'                     => 'required',
            'idbenspatrimoniais'            => 'required',
            'ativadoestoque'                => 'required',
            'excluidoestoque'               => 'required'
        ]);

        Estoque::create($request->all());
        return redirect()->route('estoque.index')
            ->with('success', 'Entrada manual no estoque lançada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estoque = Estoque::with('bensPatrimoniais')->find($id);
        $bempatrimonial = DB::select('SELECT * from benspatrimoniais where ativadobenspatrimoniais = 1 order by id = ' . $estoque->idbenspatrimoniais . ' desc');
        return view('estoque.show', compact('estoque', 'bempatrimonial'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estoque = Estoque::find($id);
        $bempatrimonial = DB::select('SELECT * from benspatrimoniais where ativadobenspatrimoniais = 1 order by id = ' . $estoque->idbenspatrimoniais . ' desc');

        return view('estoque.edit', compact('estoque', 'bempatrimonial'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            // 'codbarras'                     => 'required|min:3',
            // 'nomematerial'                  => 'required',
            // 'descricao'                     => 'required',
            'idbenspatrimoniais'            => 'required',
            'ativadoestoque'                => 'required',
            'excluidoestoque'               => 'required'

        ]);

        $estoque = Estoque::find($id);
        $estoque->nomematerial          = $request->input('nomeestoque');
        // $estoque->codbarras             = $request->input('codbarras');
        $estoque->idbenspatrimoniais    = $request->input('idbenspatrimoniais');
        $estoque->descricao             = $request->input('descricaoestoque');
        $estoque->ativadoestoque        = $request->input('ativadoestoque');
        $estoque->excluidoestoque       = $request->input('excluidoestoque');
        $estoque->save();


        return redirect()->route('estoque.index')
            ->with('success', 'Item do estoque atualizado com sucesso');
    }

    public function verificaSeExisteNoEstoque(Request $request){
        $pesquisa = $request->codbarras; // get data to check

        $temNoEstoque = Estoque::where('codbarras', $pesquisa)->get();
        $contador = $temNoEstoque->count();
        if ($contador > 0){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }
        // if($temNoEstoque){ return true; }
        // else{ return false; }
        
        // passing your where condition to check
        // return $model->where($where)->get()->count() > 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Estoque::find($id)->delete();

        return redirect()->route('estoque.index')
            ->with('success', 'Item do estoque excluído com êxito!');
    }
}
