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
         $this->middleware('permission:estoque-list|estoque-create|estoque-edit|estoque-delete', ['only' => ['index','show']]);
         $this->middleware('permission:estoque-create', ['only' => ['create','store']]);
         $this->middleware('permission:estoque-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:estoque-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Estoque::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $nomeestoque = $request->get('nomeestoque');
                    $descricaoestoque = $request->get('descricaoestoque');
                    $idbenspatrimoniais = $request->get('idbenspatrimoniais');

                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($nomeestoque)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['nomeestoque'], $request->get('nomeestoque')) ? true : false;
                        });
                    }
                    if (!empty($descricaoestoque)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['descricaoestoque'], $request->get('descricaoestoque')) ? true : false;
                        });
                    }
                    if (!empty($idbenspatrimoniais)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idbenspatrimoniais'], $request->get('idbenspatrimoniais')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['nomeestoque']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['descricaoestoque']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idbenspatrimoniais']), Str::lower($request->get('search')))) {
                                return true;
                            } 
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="estoque/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {

        $data = Estoque::orderBy('id','DESC')->paginate(5);
        return view('estoque.index',compact('data'))
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

            'nomeestoque'      => 'required|min:3',
            'idbenspatrimoniais'    => 'required',
            'descricaoestoque' => 'required',
            'ativadoestoque'   => 'required',
            'excluidoestoque'  => 'required'


        ]);


        Estoque::create($request->all());


        return redirect()->route('estoque.index')
                        ->with('success','Estoque criado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estoque = Estoque::find($id);
        $bempatrimonial = DB::select('SELECT * from benspatrimoniais where ativadobenspatrimoniais = 1 order by id = '.$estoque->idbenspatrimoniais.' desc');
        return view('estoque.show',compact('estoque','bempatrimonial'));
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
        $bempatrimonial = DB::select('SELECT * from benspatrimoniais where ativadobenspatrimoniais = 1 order by id = '.$estoque->idbenspatrimoniais.' desc');

        // $roles = Estoque::pluck('nomeFuncionario','nomeFuncionario')->all();
        // $estoqueRole = $estoque->roles->pluck('nomeFuncionario','nomeFuncionario')->all();

        return view('estoque.edit',compact('estoque','bempatrimonial'));

        // return view('estoque.edit',compact('estoque'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $request->validate([
            'nomeestoque'      => 'required|min:3',
            'idbenspatrimoniais'    => 'required',
            'descricaoestoque' => 'required',
            'ativadoestoque'   => 'required',
            'excluidoestoque'  => 'required'
        ]);


        // $estoque->update($request->all());
        $estoque = Estoque::find($id);
        $estoque->nomeestoque = $request->input('nomeestoque');
        $estoque->idbenspatrimoniais = $request->input('idbenspatrimoniais');
        $estoque->descricaoestoque = $request->input('descricaoestoque');
        $estoque->ativadoestoque = $request->input('ativadoestoque');
        $estoque->excluidoestoque = $request->input('excluidoestoque');
        $estoque->save();


        return redirect()->route('estoque.index')
                        ->with('success','Estoque atualizado com sucesso');
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
                        ->with('success','Estoque excluído com êxito!');
    }
}
