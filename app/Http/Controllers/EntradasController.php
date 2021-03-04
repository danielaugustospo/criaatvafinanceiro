<?php


namespace App\Http\Controllers;


use App\Entradas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;


class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:entradas-list|entradas-create|entradas-edit|entradas-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:entradas-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:entradas-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:entradas-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Entradas::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $descricaoentrada = $request->get('descricaoentrada');
                    $qtdeEntrada = $request->get('qtdeEntrada');
                    $idbenspatrimoniais = $request->get('idbenspatrimoniais');
                    $valorunitarioentrada = $request->get('valorunitarioentrada');

                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($descricaoentrada)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['descricaoentrada'], $request->get('descricaoentrada')) ? true : false;
                        });
                    }
                    if (!empty($qtdeEntrada)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['qtdeEntrada'], $request->get('qtdeEntrada')) ? true : false;
                        });
                    }
                    if (!empty($idbenspatrimoniais)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['idbenspatrimoniais'], $request->get('idbenspatrimoniais')) ? true : false;
                        });
                    }
                    if (!empty($valorunitarioentrada)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['valorunitarioentrada'], $request->get('valorunitarioentrada')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::contains(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['descricaoentrada']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['qtdeEntrada']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['idbenspatrimoniais']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['valorunitarioentrada']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="entradas/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {

            $data = Entradas::orderBy('id', 'DESC')->paginate(5);
            return view('entradas.index', compact('data'))
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
        // $banco =  DB::select('select * from banco');

        return view('entradas.create');
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

            'descricaoentrada'      => 'required|min:3',
            'idbenspatrimoniais'    => 'required',
            'qtdeEntrada' => 'required',
            'ativoentrada'   => 'required',
            'excluidoentrada'  => 'required'


        ]);


        Entradas::create($request->all());


        return redirect()->route('entradas.index')
            ->with('success', 'Entrada criada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entradas = Entradas::find($id);
        $selectBensPatrimoniais = DB::select('SELECT * FROM bensPatrimoniais where ativadobenspatrimoniais = 1 order by id ='.$entradas->idbenspatrimoniais .' desc');

        return view('entradas.show', compact('entradas','selectBensPatrimoniais'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entradas = Entradas::find($id);
        $selectBensPatrimoniais = DB::select('SELECT * FROM bensPatrimoniais where ativadobenspatrimoniais = 1 order by id ='.$entradas->idbenspatrimoniais .' desc');

        return view('entradas.edit', compact('entradas','selectBensPatrimoniais'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'descricaoentrada'      => 'required|min:3',
            'idbenspatrimoniais'    => 'required',
            'qtdeEntrada'           => 'required',
            'ativoentrada'          => 'required',
            'excluidoentrada'       => 'required'
        ]);

        $entradas = Entradas::find($id);
        $entradas->descricaoentrada         = $request->input('descricaoentrada');
        $entradas->idbenspatrimoniais       = $request->input('idbenspatrimoniais');
        $entradas->qtdeEntrada              = $request->input('qtdeEntrada');
        $entradas->ativoentrada             = $request->input('ativoentrada');
        $entradas->excluidoentrada          = $request->input('excluidoentrada');
        $entradas->save();

        // $entradas->update($request->all());


        return redirect()->route('entradas.index')
            ->with('success', 'Entrada atualizada com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Entradas::find($id)->delete();

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada excluída com êxito!');
    }
}
