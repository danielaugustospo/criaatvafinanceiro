<?php


namespace App\Http\Controllers;


use App\Receita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;

class ReceitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:receita-list|receita-create|receita-edit|receita-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:receita-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:receita-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:receita-delete', ['only' => ['destroy']]);


        $this->acao =  request()->segment(count(request()->segments()));

        if ($this->acao == 'create') {
            $this->valorInput = " ";
            $this->valorSemCadastro = "0";
            $this->variavelReadOnlyNaView = "";
            $this->variavelDisabledNaView = "";
        } 
        elseif ($this->acao == 'edit') {
            $this->variavelReadOnlyNaView = "";
            $this->variavelDisabledNaView = "";
            $this->valorInput = null;
            $this->valorSemCadastro = null;
        } 
        elseif ($this->acao != 'edit' && $this->acao != 'create') {
            $this->variavelReadOnlyNaView = "readonly";
            $this->variavelDisabledNaView = 'disabled';
            $this->valorInput = null;
            $this->valorSemCadastro = null;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Receita::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $valorreceita = $request->get('valorreceita');
                    $datapagamentoreceita = $request->get('datapagamentoreceita');
                    $contareceita = $request->get('contareceita');
                    $idosreceita = $request->get('idosreceita');
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($valorreceita)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['valorreceita'], $request->get('valorreceita')) ? true : false;
                        });
                    }
                    if (!empty($datapagamentoreceita)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['datapagamentoreceita'], $request->get('datapagamentoreceita')) ? true : false;
                        });
                    }
                    if (!empty($contareceita)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['contareceita'], $request->get('contareceita')) ? true : false;
                        });
                    }
                    if (!empty($idosreceita)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idosreceita'], $request->get('idosreceita')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['valorreceita']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['datapagamentoreceita']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['contareceita']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idosreceita']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="receita/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = Receita::orderBy('id', 'DESC')->paginate(5);
            return view('receita.index', compact('data'))
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
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1');
        $todasOSAtivas = DB::select('SELECT * FROM ordemdeservico WHERE ativoOrdemdeServico = 1');
        $todosClientesAtivos = DB::select('SELECT * from clientes where ativoCliente = 1');

        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');

        $valorReceita = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('receita.create', compact('listaContas', 'todasOSAtivas', 'todosClientesAtivos', 'formapagamento', 'valorInput', 'valorReceita', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $receita = new Receita();
        $request->validate([


            'idformapagamentoreceita'   => 'required',
            'datapagamentoreceita'      => 'required',
            'dataemissaoreceita'        => 'required',
            'valorreceita'              => 'required',
            'pagoreceita'               => 'required',
            'contareceita'              => 'required',
            // 'descricaoreceita'          => 'required',
            'registroreceita'           => 'required',
            'nfreceita'                 => 'required',
            'idosreceita'               => 'required',
            'idclientereceita'          => 'required',


        ]);
        $valorMonetario                  = $request->get('valorreceita');
        $quantia = $this->validaValores($valorMonetario);

        $receita->idformapagamentoreceita       = $request->get('idformapagamentoreceita');
        $receita->datapagamentoreceita          = $request->get('datapagamentoreceita');
        $receita->dataemissaoreceita            = $request->get('dataemissaoreceita');
        $receita->valorreceita                  = $quantia;
        $receita->pagoreceita                   = $request->get('pagoreceita');
        $receita->contareceita                  = $request->get('contareceita');
        $receita->descricaoreceita               = $request->get('descricaoreceita');
        $receita->registroreceita               = $request->get('registroreceita');
        // $receita->emissaoreceita                = $request->get('emissaoreceita');
        $receita->nfreceita                     = $request->get('nfreceita');
        $receita->idosreceita                   = $request->get('idosreceita');
        $receita->idclientereceita              = $request->get('idclientereceita');

        $receita->save();


        return redirect()->route('receita.index')
            ->with('success', 'Receita cadastrada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receita = Receita::find($id);
        $todasOSAtivas = DB::select('SELECT * FROM ordemdeservico WHERE ativoOrdemdeServico = 1 order by id = :idosreceita desc', ['idosreceita' => $receita->idosreceita]);
        $todosClientesAtivos = DB::select('SELECT * from clientes where ativoCliente = 1 order by id = :idclientereceita desc', ['idclientereceita' => $receita->idclientereceita]);
        $formapagamento = DB::select('SELECT * FROM formapagamento WHERE (ativoFormaPagamento = 1 and excluidoFormaPagamento = 0) ORDER BY id = :idFormaPagamento desc', ['idFormaPagamento' => $receita->idformapagamentoreceita]);
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1 order by id = :idConta', ['idConta' => $receita->contareceita]);

        $valorMonetario = $receita->valorreceita;
        $valorReceita = $this->validaValoresParaView($valorMonetario);


        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('receita.show', compact('receita', 'todasOSAtivas', 'todosClientesAtivos', 'formapagamento', 'listaContas', 'valorReceita', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receita = Receita::find($id);
        $todasOSAtivas = DB::select('SELECT * FROM ordemdeservico WHERE ativoOrdemdeServico = 1 order by id = :idosreceita desc', ['idosreceita' => $receita->idosreceita]);
        $todosClientesAtivos = DB::select('SELECT * from clientes where ativoCliente = 1 order by id = :idclientereceita desc', ['idclientereceita' => $receita->idclientereceita]);


        $formapagamento = DB::select('SELECT * FROM formapagamento WHERE (ativoFormaPagamento = 1 and excluidoFormaPagamento = 0) ORDER BY id = :idFormaPagamento desc', ['idFormaPagamento' => $receita->idformapagamentoreceita]);
        $listaContas = DB::select('select id,agenciaConta, numeroConta from conta where ativoConta = 1 order by id = :idConta', ['idConta' => $receita->contareceita]);


        $valorMonetario = $receita->valorreceita;
        $valorReceita = $this->validaValoresParaView($valorMonetario);

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('receita.edit', compact('receita', 'todasOSAtivas', 'todosClientesAtivos', 'formapagamento', 'listaContas', 'valorReceita', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receita $receita)
    {
        request()->validate([
            'idformapagamentoreceita'   => 'required',
            'datapagamentoreceita'      => 'required',
            'dataemissaoreceita'        => 'required',
            'valorreceita'              => 'required',
            'pagoreceita'               => 'required',
            'contareceita'              => 'required',
            // 'descricaoreceita'          => 'required',
            'registroreceita'           => 'required',
            'nfreceita'                 => 'required',
            // 'idosreceita'               => 'required'
        ]);


        $valorMonetario                  = $request->get('valorreceita');
        $quantia = $this->validaValores($valorMonetario);
        
        $receita->id                            = $request->get('id');
        $receita->idformapagamentoreceita       = $request->get('idformapagamentoreceita');
        $receita->datapagamentoreceita          = $request->get('datapagamentoreceita');
        $receita->dataemissaoreceita            = $request->get('dataemissaoreceita');
        $receita->valorreceita                  = $quantia;
        $receita->pagoreceita                   = $request->get('pagoreceita');
        $receita->contareceita                  = $request->get('contareceita');
        $receita->descricaoreceita               = $request->get('descricaoreceita');
        $receita->registroreceita               = $request->get('registroreceita');
        // $receita->emissaoreceita                = $request->get('emissaoreceita');
        $receita->nfreceita                     = $request->get('nfreceita');
        // $receita->idosreceita                   = $request->get('idosreceita');

        DB::update("UPDATE receita
        SET idformapagamentoreceita = '$receita->idformapagamentoreceita', 
        datapagamentoreceita        = '$receita->datapagamentoreceita',           
        dataemissaoreceita          = '$receita->dataemissaoreceita',             
        valorreceita                = '$receita->valorreceita',                   
        pagoreceita                 = '$receita->pagoreceita',                    
        contareceita                = '$receita->contareceita',                   
        descricaoreceita             = '$receita->descricaoreceita',                
        registroreceita             = '$receita->registroreceita',                
        nfreceita                   = '$receita->nfreceita'                      
        -- idosreceita                 = '$receita->idosreceita'                  
        WHERE id                    = '$receita->id'"
        );

        // $receita->update();


        return redirect()->route('receita.index')
            ->with('success', 'Receita atualizada com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Receita::find($id)->delete();

        return redirect()->route('receita.index')
            ->with('success', 'Receita excluída com êxito!');
    }

    public function validaValores($valorMonetario)
    {
        $SemPonto  = str_replace('.', '', $valorMonetario);
        $SemVirgula  = str_replace(',', '.', $SemPonto);
        $valorMonetario = $SemVirgula;
        return $valorMonetario;
    }
    public function validaValoresParaView($valorMonetario)
    {
        $ComPonto  = str_replace('', '.', $valorMonetario);
        $ComVirgula  = str_replace('.', ',', $ComPonto);
        $valorMonetario = $ComVirgula;
        return $valorMonetario;
    }
}
