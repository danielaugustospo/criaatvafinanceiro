<?php


namespace App\Http\Controllers;


use App\Saidas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;

class SaidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:saidas-list|saidas-create|saidas-edit|saidas-delete', ['only' => ['index','show']]);
         $this->middleware('permission:saidas-create', ['only' => ['create','store']]);
         $this->middleware('permission:saidas-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:saidas-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        if ($request->ajax()) {

        $data = Saidas::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                $id                             = $request->get('id');
                $nomesaida                      = $request->get('nomesaida');
                $descricaosaida                 = $request->get('descricaosaida');
                $idbenspatrimoniais             = $request->get('idbenspatrimoniais');
                $portadorsaida                  = $request->get('portadorsaida');
                $datapararetiradasaida          = $request->get('datapararetiradasaida');
                $dataretiradasaida              = $request->get('dataretiradasaida');
                $dataretornoretiradasaida       = $request->get('dataretornoretiradasaida');
                $ocorrenciasaida                = $request->get('ocorrenciasaida');
                if (!empty($id)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['id'], $request->get('id')) ? true : false;
                    });
                }
                if (!empty($nomesaida)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['nomesaida'], $request->get('nomesaida')) ? true : false;
                    });
                }
                if (!empty($descricaosaida)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['descricaosaida'], $request->get('descricaosaida')) ? true : false;
                    });
                }
                if (!empty($idbenspatrimoniais)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['idbenspatrimoniais'], $request->get('idbenspatrimoniais')) ? true : false;
                    });
                }
                if (!empty($portadorsaida)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['portadorsaida'], $request->get('portadorsaida')) ? true : false;
                    });
                }
                if (!empty($datapararetiradasaida)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['datapararetiradasaida'], $request->get('datapararetiradasaida')) ? true : false;
                    });
                }
                if (!empty($dataretiradasaida)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['dataretiradasaida'], $request->get('dataretiradasaida')) ? true : false;
                    });
                }
                if (!empty($dataretornoretiradasaida)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['dataretornoretiradasaida'], $request->get('dataretornoretiradasaida')) ? true : false;
                    });
                }
                if (!empty($ocorrenciasaida)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['ocorrenciasaida'], $request->get('ocorrenciasaida')) ? true : false;
                    });
                }

                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                        if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['nomesaida']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['descricaosaida']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['idbenspatrimoniais']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['portadorsaida']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['datapararetiradasaida']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['dataretiradasaida']), Str::lower($request->get('search')))) {
                            return true;
                        }
                        else if (Str::is(Str::lower($row['dataretornoretiradasaida']), Str::lower($request->get('search')))) {
                            return true;
                        }
                        else if (Str::is(Str::lower($row['ocorrenciasaida']), Str::lower($request->get('search')))) {
                            return true;
                        }
                        return false;
                    });
                }
            })
            ->addColumn('action', function ($row) {

                $btnVisualizar = '<a href="saidas/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                return $btnVisualizar;
            })
            ->rawColumns(['action'])
            ->make(true);
    } else {

        $data = Saidas::orderBy('id','DESC')->paginate(5);
        return view('saidas.index',compact('data'))
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
        return view('saidas.create');
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

            'nomesaida'                 => 'required', 
            'descricaosaida'            => 'required',    
            'idbenspatrimoniais'        => 'required',    
            'portadorsaida'             => 'required', 
            'datapararetiradasaida'     => 'required', 
            // 'dataretiradasaida'         => 'required', 
            'dataretornoretiradasaida'  => 'required',  
            'ocorrenciasaida'           => 'required',
            'ativadosaida'              => 'required',    
            'excluidosaida'             => 'required'    



        ]);


        Saidas::create($request->all());


        return redirect()->route('saidas.index')
                        ->with('success','Saída criada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saidas = Saidas::find($id);
        $bensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais WHERE ativadobenspatrimoniais = 1 order by id ='. $saidas->idbenspatrimoniais .' desc');

        return view('saidas.show',compact('saidas','bensPatrimoniais'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saidas = Saidas::find($id);
        $bensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais WHERE ativadobenspatrimoniais = 1 order by id ='. $saidas->idbenspatrimoniais .' desc');

        return view('saidas.edit',compact('saidas','bensPatrimoniais'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nomesaida'                 => 'required', 
            'descricaosaida'            => 'required',    
            'idbenspatrimoniais'        => 'required',    
            'portadorsaida'             => 'required', 
            'datapararetiradasaida'     => 'required', 
            // 'dataretiradasaida'         => 'required', 
            'dataretornoretiradasaida'  => 'required',  
            'ocorrenciasaida'           => 'required',
            'ativadosaida'              => 'required',    
            'excluidosaida'             => 'required'    
        ]);

        $saidas = Saidas::find($id);
        $saidas->nomesaida                  = $request->input('nomesaida');
        $saidas->descricaosaida             = $request->input('descricaosaida');
        $saidas->idbenspatrimoniais         = $request->input('idbenspatrimoniais');
        $saidas->portadorsaida              = $request->input('portadorsaida');
        $saidas->datapararetiradasaida      = $request->input('datapararetiradasaida');
        $saidas->dataretiradasaida          = $request->input('dataretiradasaida');
        $saidas->dataretornoretiradasaida   = $request->input('dataretornoretiradasaida');
        $saidas->ocorrenciasaida            = $request->input('ocorrenciasaida');
        $saidas->ativadosaida               = $request->input('ativadosaida');
        $saidas->excluidosaida              = $request->input('excluidosaida');
        $saidas->save();

        // $saidas->update($request->all());

        return redirect()->route('saidas.index')
                        ->with('success','Saída atualizada com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Saidas::find($id)->delete();

        return redirect()->route('saidas.index')
                        ->with('success','Saída excluído com êxito!');
    }
}
