<?php


namespace App\Http\Controllers;


use App\TabelaPercentual;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;



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

        if ($request->ajax()) {

            $data = TabelaPercentual::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $nometabelapercentual = $request->get('nometabelapercentual');
                    $percentualtabelapercentual = $request->get('percentualtabelapercentual');
                    $pgtabelapercentual = $request->get('pgtabelapercentual');
                    $idostabelapercentual = $request->get('idostabelapercentual');

                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($nometabelapercentual)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['nometabelapercentual'], $request->get('nometabelapercentual')) ? true : false;
                        });
                    }
                    if (!empty($percentualtabelapercentual)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['percentualtabelapercentual'], $request->get('percentualtabelapercentual')) ? true : false;
                        });
                    }
                    if (!empty($pgtabelapercentual)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['pgtabelapercentual'], $request->get('pgtabelapercentual')) ? true : false;
                        });
                    }
                    if (!empty($idostabelapercentual)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['idostabelapercentual'], $request->get('idostabelapercentual')) ? true : false;
                        });
                    }
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::contains(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['nometabelapercentual']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['percentualtabelapercentual']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['pgtabelapercentual']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['idostabelapercentual']), Str::lower($request->get('search')))) {
                                return true;
                            } 
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="tabelapercentual/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = TabelaPercentual::orderBy('id','DESC')->paginate(5);
            return view('tabelapercentual.index',compact('data'))
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
     * @param  \App\TabelaPercentual  $tabelapercentual
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
     * @param  \App\TabelaPercentual  $tabelapercentual
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tabelapercentual = TabelaPercentual::find($id);
        $listaOS = DB::select('SELECT id, servicoOrdemdeServico, eventoOrdemdeServico FROM ordemdeservico WHERE ativoOrdemdeServico = 1 order by id ='. $tabelapercentual->idostabelapercentual .' desc');

        return view('tabelapercentual.edit',compact('tabelapercentual','listaOS'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TabelaPercentual  $tabelapercentual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TabelaPercentual $tabelapercentual)
    {
         request()->validate([
            'nometabelapercentual' => 'required',
            'percentualtabelapercentual' => 'required',
            'pgtabelapercentual' => 'required',
            'idostabelapercentual' => 'required',
        ]);


        $tabelapercentual->update($request->all());


        return redirect()->route('tabelapercentual.index')
                        ->with('success','Tabela percentual atualizado com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TabelaPercentual  $tabelapercentual
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        TabelaPercentual::find($id)->delete();

        return redirect()->route('tabelapercentual.index')
                        ->with('success','Tabela percentual excluída com êxito!');
    }
}
