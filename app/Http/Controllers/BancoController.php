<?php


namespace App\Http\Controllers;


use App\Banco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
// use Freshbitsweb\Laratables\Laratables;



class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:banco-list|banco-create|banco-edit|banco-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:banco-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:banco-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:banco-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Banco::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $nomeBanco = $request->get('nomeBanco');
                    $codigoBanco = $request->get('codigoBanco');
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($nomeBanco)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['nomeBanco'], $request->get('nomeBanco')) ? true : false;
                        });
                    }
                    if (!empty($codigoBanco)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['codigoBanco'], $request->get('codigoBanco')) ? true : false;
                        });
                    }
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['nomeBanco']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['codigoBanco']), Str::lower($request->get('search')))) {
                                return true;
                            } 
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="bancos/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = Banco::orderBy('id', 'DESC')->paginate(5);

            return view('bancos.index', compact('data'))
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
        return view('bancos.create');
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
            'nomeBanco' => 'required|min:3',
            'codigoBanco'  => 'required',

        ]);


        Banco::create($request->all());


        return redirect()->route('bancos.index')
            ->with('success', 'Banco cadastrado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banco = Banco::find($id);
        return view('bancos.show', compact('banco'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banco = Banco::find($id);
        $roles = Banco::pluck('nomeBanco', 'nomeBanco')->all();
        $bancoRole = $banco->roles->pluck('nomeBanco', 'nomeBanco')->all();

        return view('bancos.edit', compact('banco', 'roles', 'bancoRole'));

        // return view('bancos.edit',compact('banco'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banco $banco)
    {
        request()->validate([
            'nomeBanco' => 'required',
            'codigoBanco' => 'required',
        ]);


        $banco->update($request->all());


        return redirect()->route('bancos.index')
            ->with('success', 'Banco atualizado com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Banco::find($id)->delete();

        return redirect()->route('bancos.index')
            ->with('success', 'Banco excluído com êxito!');
    }
}
