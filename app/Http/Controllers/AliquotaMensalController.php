<?php


namespace App\Http\Controllers;


use App\AliquotaMensal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use App\Providers\FormatacoesServiceProvider;


class AliquotaMensalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:aliquotamensal-list|aliquotamensal-create|aliquotamensal-edit|aliquotamensal-delete', ['only' => ['index','show']]);
         $this->middleware('permission:aliquotamensal-create', ['only' => ['create','store']]);
         $this->middleware('permission:aliquotamensal-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:aliquotamensal-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = AliquotaMensal::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $idconta =          $request->get('idconta');
                    $mes =              $request->get('mes');
                    $dasSemFatorR =     $request->get('dasSemFatorR');
                    $issSemFatorR =     $request->get('issSemFatorR');
                    $reciboSemFatorR =  $request->get('reciboSemFatorR');
                    $dasComFatorR =     $request->get('dasComFatorR');
                    $issComFatorR =     $request->get('issComFatorR');
                    $reciboComFatorR =  $request->get('reciboComFatorR');

                    
                    
                    if (!empty($idconta)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idconta'], $request->get('idconta')) ? true : false;
                        });
                    }
                    if (!empty($mes)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['mes'], $request->get('mes')) ? true : false;
                        });
                    }
                    if (!empty($dasSemFatorR)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['dasSemFatorR'], $request->get('dasSemFatorR')) ? true : false;
                        });
                    }
                    if (!empty($issSemFatorR)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['issSemFatorR'], $request->get('issSemFatorR')) ? true : false;
                        });
                    }
                    if (!empty($reciboSemFatorR)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['reciboSemFatorR'], $request->get('reciboSemFatorR')) ? true : false;
                        });
                    }
                    if (!empty($dasComFatorR)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['dasComFatorR'], $request->get('dasComFatorR')) ? true : false;
                        });
                    }
                    if (!empty($issComFatorR)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['issComFatorR'], $request->get('issComFatorR')) ? true : false;
                        });
                    }
                    if (!empty($reciboComFatorR)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['reciboComFatorR'], $request->get('reciboComFatorR')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idconta']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['mes']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['dasSemFatorR']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['issSemFatorR']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['reciboSemFatorR']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['dasComFatorR']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['issComFatorR']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['reciboComFatorR']), Str::lower($request->get('search')))) {
                                return true;
                            } 
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="aliquotamensal/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {

        $data = AliquotaMensal::orderBy('id','DESC')->paginate(5);
        return view('aliquotamensal.index',compact('data'))
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
        // $dadosaliquotamensal =  DB::select('select * from aliquotamensal;');
        $readonlyOuNao = FormatacoesServiceProvider::campoReadOnly(null,'editavel');

        return view('aliquotamensal.create', compact('readonlyOuNao'));
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

            'idconta'           => 'required',
            'mes'               => 'required',
            'dasSemFatorR'      => 'required',
            'issSemFatorR'      => 'required',
            'reciboSemFatorR'   => 'required',
            'dasComFatorR'      => 'required',
            'issComFatorR'      => 'required',
            'reciboComFatorR'   => 'required',

        ]);


        AliquotaMensal::create($request->all());


        return redirect()->route('aliquotamensal.index')
                        ->with('success','Alíquota Mensal criada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\AliquotaMensal  $aliquotamensal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dadosaliquotamensal = AliquotaMensal::find($id);
        $selectContaSetada = DB::select('select * from conta order by id= '. $dadosaliquotamensal->idconta .' desc;');

        $readonlyOuNao = FormatacoesServiceProvider::campoReadOnly(null,'editavel');

        return view('aliquotamensal.show',compact('dadosaliquotamensal', 'selectContaSetada', 'readonlyOuNao'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AliquotaMensal  $aliquotamensal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dadosaliquotamensal = AliquotaMensal::find($id);
        $readonlyOuNao = FormatacoesServiceProvider::campoReadOnly(null,'editavel');
        $selectContaSetada = DB::select('select * from conta order by id= '. $dadosaliquotamensal->idconta .' desc;');


        return view('aliquotamensal.edit',compact('dadosaliquotamensal', 'selectContaSetada', 'readonlyOuNao'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AliquotaMensal  $aliquotamensal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([

            'idconta'           => 'required',
            'mes'               => 'required',
            'dasSemFatorR'      => 'required',
            'issSemFatorR'      => 'required',
            'reciboSemFatorR'   => 'required',
            'dasComFatorR'      => 'required',
            'issComFatorR'      => 'required',
            'reciboComFatorR'   => 'required',
        ]);

        $aliquotamensal = AliquotaMensal::find($id);
        $aliquotamensal->idconta          = $request->input('idconta');
        $aliquotamensal->mes              = $request->input('mes');
        $aliquotamensal->dasSemFatorR     = $request->input('dasSemFatorR');
        $aliquotamensal->issSemFatorR     = $request->input('issSemFatorR');
        $aliquotamensal->reciboSemFatorR  = $request->input('reciboSemFatorR');
        $aliquotamensal->dasComFatorR     = $request->input('dasComFatorR');
        $aliquotamensal->issComFatorR     = $request->input('issComFatorR');
        $aliquotamensal->reciboComFatorR  = $request->input('reciboComFatorR');
        $aliquotamensal->save();


        return redirect()->route('aliquotamensal.index')
                        ->with('success','Alíquota Mensal atualizada com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AliquotaMensal  $aliquotamensal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        AliquotaMensal::find($id)->delete();

        return redirect()->route('aliquotamensal.index')
                        ->with('success','Alíquota Mensal excluída com êxito!');
    }
}
