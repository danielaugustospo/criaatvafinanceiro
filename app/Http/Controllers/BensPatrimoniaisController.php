<?php


namespace App\Http\Controllers;


use App\BensPatrimoniais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;

class BensPatrimoniaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:benspatrimoniais-list|benspatrimoniais-create|benspatrimoniais-edit|benspatrimoniais-delete', ['only' => ['index','show']]);
         $this->middleware('permission:benspatrimoniais-create', ['only' => ['create','store']]);
         $this->middleware('permission:benspatrimoniais-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:benspatrimoniais-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = BensPatrimoniais::latest()->with('unidademedida', 'tipo')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $nomeBensPatrimoniais = $request->get('nomeBensPatrimoniais');
                    $descricaoBensPatrimoniais = $request->get('descricaoBensPatrimoniais');
                    $idTipoBensPatrimoniais = $request->get('idTipoBensPatrimoniais');
                    $statusbenspatrimoniais = $request->get('statusbenspatrimoniais');
 
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($nomeBensPatrimoniais)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['nomeBensPatrimoniais'], $request->get('nomeBensPatrimoniais')) ? true : false;
                        });
                    }
                    if (!empty($descricaoBensPatrimoniais)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['descricaoBensPatrimoniais'], $request->get('descricaoBensPatrimoniais')) ? true : false;
                        });
                    }
                    if (!empty($idTipoBensPatrimoniais)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idTipoBensPatrimoniais'], $request->get('idTipoBensPatrimoniais')) ? true : false;
                        });
                    }
                    if (!empty($statusbenspatrimoniais)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['statusbenspatrimoniais'], $request->get('statusbenspatrimoniais')) ? true : false;
                        });
                    }
 
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
 
                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['nomeBensPatrimoniais']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['descricaoBensPatrimoniais']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idTipoBensPatrimoniais']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['statusbenspatrimoniais']), Str::lower($request->get('search')))) {
                                return true;
                            } 
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {
 
                    $btnVisualizar = '<a href="benspatrimoniais/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
 
        $data = BensPatrimoniais::orderBy('id','DESC')->paginate(5);
        return view('benspatrimoniais.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

     }
}


public function apibenspatrimoniais(Request $request)
{
    $data = BensPatrimoniais::with('unidademedida', 'tipo')->where('statusbenspatrimoniais',1)->get();
    return $data;
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoBensPatrimoniais =  DB::select('select distinct * from products where ativotipobenspatrimoniais = 1 and excluidotipobenspatrimoniais = 0;');

        return view('benspatrimoniais.create', compact('tipoBensPatrimoniais'));
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

            'nomeBensPatrimoniais'      => 'required|min:3',
            'idTipoBensPatrimoniais'    => 'required',
            'qtdestoqueminimo'          => 'required',
            'descricaoBensPatrimoniais' => 'required',
            'statusbenspatrimoniais'    => 'required',
            'ativadoBensPatrimoniais'   => 'required',
            'excluidoBensPatrimoniais'  => 'required',


        ]);


        BensPatrimoniais::create($request->all());


        return redirect()->route('benspatrimoniais.index')
                        ->with('success','Material cadastrado com êxito.');
    }
    public function salvarmodal(Request $request)
    {

        $request->validate([
            'nomeBensPatrimoniais'      => 'required|min:3',
            'idTipoBensPatrimoniais'    => 'required',
            'qtdestoqueminimo'          => 'required',
            'descricaoBensPatrimoniais' => 'required',
            'statusbenspatrimoniais'    => 'required',
            'ativadoBensPatrimoniais'   => 'required',
            'excluidoBensPatrimoniais'  => 'required',
        ]);
        BensPatrimoniais::create($request->all());

        return view('benspatrimoniais.camposmodal')
                        ->with('mensagem','Material cadastrado com êxito.');                        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\BensPatrimoniais  $benspatrimoniais
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $benspatrimoniais =  BensPatrimoniais::find($id);

        return view('benspatrimoniais.show',compact('benspatrimoniais'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BensPatrimoniais  $benspatrimoniais
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $benspatrimoniais = BensPatrimoniais::find($id);
        $tipoBensPatrimoniais =  DB::select('select distinct * from products where ativotipobenspatrimoniais = 1 and excluidotipobenspatrimoniais = 0;');

        return view('benspatrimoniais.edit',compact('benspatrimoniais','tipoBensPatrimoniais'));

        // return view('bensPatrimoniais.edit',compact('benspatrimoniais'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BensPatrimoniais  $benspatrimoniais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([

            'nomeBensPatrimoniais'          => 'required',
            'idTipoBensPatrimoniais'        => 'required',
            'descricaoBensPatrimoniais'     => 'required',
            // 'ativadoBensPatrimoniais'       => 'required',
            // 'excluidoBensPatrimoniais'      => 'required',
            'statusbenspatrimoniais'        => 'required',
        ]);

        $benspatrimoniais = BensPatrimoniais::find($id);
        $benspatrimoniais->nomeBensPatrimoniais         = $request->input('nomeBensPatrimoniais');
        $benspatrimoniais->idTipoBensPatrimoniais       = $request->input('idTipoBensPatrimoniais');
        $benspatrimoniais->qtdestoqueminimo             = $request->input('qtdestoqueminimo');
        $benspatrimoniais->descricaoBensPatrimoniais    = $request->input('descricaoBensPatrimoniais');
        $benspatrimoniais->statusbenspatrimoniais       = $request->input('statusbenspatrimoniais');
        $benspatrimoniais->estante                      = $request->input('estante');
        $benspatrimoniais->prateleira                   = $request->input('prateleira');
        $benspatrimoniais->unidademedida                = $request->input('unidademedida');
        $benspatrimoniais->save();


        // $benspatrimoniais->update($request->all());


        return redirect()->route('benspatrimoniais.index')
                        ->with('success','Bem Patrimonial atualizado com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BensPatrimoniais  $benspatrimoniais
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        BensPatrimoniais::find($id)->delete();

        return redirect()->route('benspatrimoniais.index')
                        ->with('success','Bem Patrimonial excluído com êxito!');
    }
}
