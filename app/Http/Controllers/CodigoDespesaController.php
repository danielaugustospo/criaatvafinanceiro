<?php


namespace App\Http\Controllers;


use App\CodigoDespesa;
use App\Despesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CodigoDespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:codigodespesa-list|codigodespesa-create|codigodespesa-edit|codigodespesa-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:codigodespesa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:codigodespesa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:codigodespesa-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = CodigoDespesa::where('excluidoCodigoDespesa', 0)->latest()->with('grupoDespesa')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $despesaCodigoDespesa = $request->get('despesaCodigoDespesa');
                    $idGrupoCodigoDespesa = $request->get('idGrupoCodigoDespesa');

                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($despesaCodigoDespesa)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['despesaCodigoDespesa'], $request->get('despesaCodigoDespesa')) ? true : false;
                        });
                    }
                    if (!empty($idGrupoCodigoDespesa)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idGrupoCodigoDespesa'], $request->get('idGrupoCodigoDespesa')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['despesaCodigoDespesa']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idGrupoCodigoDespesa']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="codigodespesas/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    if (Auth::user()->can('codigodespesa-edit')) {
                        $btnVisualizar .= '<a href="codigodespesas/' . $row['id'] . '/edit" class="ml-2 edit btn btn-primary btn-sm">Editar</a>';
                    }
                    return $btnVisualizar;
                })

                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = CodigoDespesa::with('grupoDespesa')->orderBy('id', 'DESC')->paginate(5);
            return view('codigodespesas.index', compact('data'))
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
        $validator = Validator::make($request->all(), [
            'despesaCodigoDespesa' => [
                'required',
                function ($attribute, $value, $fail) {
                    $similarDespesas = CodigoDespesa::where('despesaCodigoDespesa', 'LIKE', $value . '%')->count();
                    if ($similarDespesas > 0) {
                        $fail('O código de despesa fornecido é muito semelhante a um já existente no banco de dados.');
                    }
                }
            ],
            'idGrupoCodigoDespesa'  => 'required',
            'ativoCodigoDespesa'    => 'required',
            'excluidoCodigoDespesa' => 'required',
        ], [
            'despesaCodigoDespesa.required'   => 'O campo Código de Despesa é obrigatório.',
            'idGrupoCodigoDespesa.required'   => 'O campo ID do Grupo de Despesa é obrigatório.',
            'ativoCodigoDespesa.required'     => 'O campo Ativo é obrigatório.',
            'excluidoCodigoDespesa.required'  => 'O campo Excluído é obrigatório.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        CodigoDespesa::create($request->all());

        return redirect()->route('codigodespesas.index')
            ->with('success', 'Código de Despesa cadastrado com êxito.');
    }

    public function salvarmodal(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'despesaCodigoDespesa' => [
                'required',
                function ($attribute, $value, $fail) {
                    $similarDespesas = CodigoDespesa::where('despesaCodigoDespesa', 'LIKE', $value . '%')->count();
                    if ($similarDespesas > 0) {
                        $fail('O código de despesa fornecido é muito semelhante a um já existente no banco de dados.');
                    }
                }
            ],
            'idGrupoCodigoDespesa'  => 'required',
            'ativoCodigoDespesa'    => 'required',
            'excluidoCodigoDespesa' => 'required',
        ], [
            'despesaCodigoDespesa.required'   => 'O campo Código de Despesa é obrigatório.',
            'idGrupoCodigoDespesa.required'   => 'O campo ID do Grupo de Despesa é obrigatório.',
            'ativoCodigoDespesa.required'     => 'O campo Ativo é obrigatório.',
            'excluidoCodigoDespesa.required'  => 'O campo Excluído é obrigatório.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        CodigoDespesa::create($request->all());

        return view('codigodespesas.camposmodal')
            ->with('mensagem', 'Código de Despesa cadastrado com êxito.');
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
        return view('codigodespesas.show', compact('codigodespesa'));
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

        return view('codigodespesas.edit', compact('codigodespesa'));
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
            'despesaCodigoDespesa' => 'required',
            'idGrupoCodigoDespesa' => 'required',
            'ativoCodigoDespesa' => 'required',
            'excluidoCodigoDespesa' => 'required',
        ]);


        $codigodespesa->update($request->all());


        return redirect()->route('codigodespesas.index')
            ->with('success', 'Código de Despesa atualizado com êxito');
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
            ->with('success', 'Código de Despesa excluído com êxito!');
    }

    public function replaceCodigoDespesa(Request $request)
    {
        $nomeCodigoDespesa = $request->codigoDespesa;
        $rotaRetorno   = 'codigodespesas.index';
    
        // Obter todos os registros do codigoDespesa com o mesmo nome
        $registros = CodigoDespesa::where('despesaCodigoDespesa', $nomeCodigoDespesa)->orderBy('id')->get();
        if ($registros->count() <= 1) {
            // Se houver menos de dois registros, não é necessário fazer nenhuma operação
            $mensagemExito = 'Não há duplicidades para remover.';
            return redirect()->route($rotaRetorno)->with('success',  $mensagemExito);
        }
        
        DB::beginTransaction();
        
        try {
            // Guardar o primeiro ID em uma variável separada
            $idPrincipal = $registros->first()->id;
            
            // Guardar os IDs adicionais em uma outra variável
            $outrosIds = $registros->slice(1)->pluck('id')->toArray();
            foreach ($outrosIds as $idCodigoDespesas) {

                $despesas = Despesa::where('despesaCodigoDespesas', $idCodigoDespesas)->get();
                foreach ($despesas as $despesa) {
                    if (!is_null($despesa)) {
                        $despesa->despesaCodigoDespesas = (int)$idPrincipal;
                        $despesa->save();                    
                    }
                }
                
                $codigoDespesa = CodigoDespesa::find($idCodigoDespesas);
                $codigoDespesa->ativoCodigoDespesa = 0;
                $codigoDespesa->excluidoCodigoDespesa = 1;
                $codigoDespesa->save();
            }
            
            DB::commit();
            $mensagemExito = 'Duplicidades removidas com êxito.';
            return redirect()->route($rotaRetorno)->with('success',  $mensagemExito);
            
        } catch (\Exception $e) {
            DB::rollBack();
            var_dump($e->getMessage());
            var_dump($e->getLine());
            exit;

            $mensagemExito = 'Ocorreu um erro ao remover as duplicidades.';
            return redirect()->route($rotaRetorno)->with('error',  $mensagemExito);
        }
    }

}
