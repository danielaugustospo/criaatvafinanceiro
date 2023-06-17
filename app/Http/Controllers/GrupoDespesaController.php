<?php


namespace App\Http\Controllers;

use App\CodigoDespesa;
use App\Despesa;
use App\GrupoDespesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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
         $this->middleware('permission:grupodespesa-edit', ['only' => ['edit','update', 'replaceGrupoDespesa']]);
         $this->middleware('permission:grupodespesa-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = GrupoDespesa::where('excluidoDespesa', 0)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $grupoDespesa = $request->get('grupoDespesa');
                    $excluidoDespesa = '0';
                    
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($grupoDespesa)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['grupoDespesa'], $request->get('grupoDespesa')) ? true : false;
                        });
                    }
                    if (!empty($excluidoDespesa)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['excluidoDespesa'], $this->excluidoDespesa) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['grupoDespesa']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['excluidoDespesa']), Str::lower($request->get('search')))) {
                                return true;
                            } 
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="grupodespesas/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    if (Auth::user()->can('grupodespesa-edit')) {
                        $btnVisualizar .= '<a href="grupodespesas/' . $row['id'] . '/edit" class="ml-2 edit btn btn-primary btn-sm">Editar</a>';
                    }
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('grupodespesas.index')
            ->with('error', 'Ocorreu um erro na solicitação. Tente novamente');
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

        $validator = Validator::make($request->all(), [
        'grupoDespesa'      => 'required|unique:grupodespesas',
        'ativoDespesa'      => 'required',
        'excluidoDespesa'   => 'required',
        ],[
            'grupoDespesa.unique'               => 'O Grupo de Despesa fornecido é muito semelhante a um já existente no banco de dados.',
            'idGrupoCodigoDespesa.required'     => 'O campo Grupo de Despesa é obrigatório',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        GrupoDespesa::create($request->all());

        return redirect()->route('grupodespesas.index')
                        ->with('success','Grupo de Despesa cadastrado com êxito.');
    }

    public function salvarmodalgrupodespesa(Request $request)
    {
        $request->validate(['grupoDespesa' => 'required']);
        GrupoDespesa::create($request->all());
        return view('grupodespesas.campos')
        ->with('mensagem','Grupo de Despesa cadastrado com êxito.');
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

    public function replaceGrupoDespesa(Request $request)
    {
        $nomeGrupoDespesa = $request->grupoDespesa;
    
        // Obter todos os registros do grupoDespesa com o mesmo nome
        $registros = GrupoDespesa::where('grupoDespesa', $nomeGrupoDespesa)->orderBy('id')->get();
        if ($registros->count() <= 1) {
            // Se houver menos de dois registros, não é necessário fazer nenhuma operação
            $mensagemExito = 'Não há duplicidades para remover.';
            $rotaRetorno   = 'grupodespesas.index';
            return redirect()->route($rotaRetorno)->with('success',  $mensagemExito);
        }
        
        DB::beginTransaction();
        
        try {
            // Guardar o primeiro ID em uma variável separada
            $idPrincipal = $registros->first()->id;
            
            // Guardar os IDs adicionais em uma outra variável
            $outrosIds = $registros->slice(1)->pluck('id')->toArray();
            foreach ($outrosIds as $idGrupo) {
                $codigoDespesa = CodigoDespesa::where('idGrupoCodigoDespesa', $idGrupo)->first();
                if (!is_null($codigoDespesa)) {
                    $codigoDespesa->idGrupoCodigoDespesa = (int)$idPrincipal;
                    $codigoDespesa->save();                    
                }
                $grupoDespesa = GrupoDespesa::find($idGrupo);
                $grupoDespesa->ativoDespesa = 0;
                $grupoDespesa->excluidoDespesa = 1;
                $grupoDespesa->save();
            }
            
            DB::commit();
            $mensagemExito = 'Duplicidades removidas com êxito.';
            $rotaRetorno   = 'grupodespesas.index';
            return redirect()->route($rotaRetorno)->with('success',  $mensagemExito);
            
        } catch (\Exception $e) {
            DB::rollBack();
            var_dump($e->getMessage());
            var_dump($e->getLine());

            $mensagemExito = 'Ocorreu um erro ao remover as duplicidades.';
            $rotaRetorno   = 'grupodespesas.index';
            return redirect()->route($rotaRetorno)->with('error',  $mensagemExito);
        }
    }
    
}
