<?php


namespace App\Http\Controllers;


use App\FormaPagamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Str;
class FormaPagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:formapagamento-list|formapagamento-create|formapagamento-edit|formapagamento-delete', ['only' => ['index','show']]);
         $this->middleware('permission:formapagamento-create', ['only' => ['create','store']]);
         $this->middleware('permission:formapagamento-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:formapagamento-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = FormaPagamento::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $nomeFormaPagamento = $request->get('nomeFormaPagamento');

                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($nomeFormaPagamento)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['nomeFormaPagamento'], $request->get('nomeFormaPagamento')) ? true : false;
                        });
                    }


                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::contains(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['nomeFormaPagamento']), Str::lower($request->get('search')))) {
                                return true;
                            } 
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="formapagamentos/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {

        $data = FormaPagamento::orderBy('id','DESC')->paginate(5);
        return view('formapagamentos.index',compact('data'))
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
        return view('formapagamentos.create');
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
            'nomeFormaPagamento' => 'required|min:3',
            'ativoFormaPagamento'  => 'required',
            'excluidoFormaPagamento'  => 'required',

        ]);


        FormaPagamento::create($request->all());


        return redirect()->route('formapagamentos.index')
                        ->with('success','Forma de Pagamento cadastrada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\FormaPagamento  $formapagamento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formapagamento = FormaPagamento::find($id);
        return view('formapagamentos.show',compact('formapagamento'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FormaPagamento  $formapagamento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formapagamento = FormaPagamento::find($id);
        $roles = FormaPagamento::pluck('nomeFormaPagamento','nomeFormaPagamento')->all();
        $bancoRole = $formapagamento->roles->pluck('nomeFormaPagamento','nomeFormaPagamento')->all();


        return view('formapagamentos.edit',compact('formapagamento','roles','bancoRole'));

        // return view('formapagamentos.edit',compact('formapagamento'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormaPagamento  $formapagamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormaPagamento $formapagamento)
    {
         request()->validate([
            'nomeFormaPagamento' => 'required|min:3',
            'ativoFormaPagamento'  => 'required',
        ]);


        $formapagamento->update($request->all());


        return redirect()->route('formapagamentos.index')
                        ->with('success','Forma de Pagamento atualizada com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormaPagamento  $formapagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        FormaPagamento::find($id)->delete();

        return redirect()->route('formapagamentos.index')
                        ->with('success','Forma de Pagamento excluída com êxito!');
    }
}
