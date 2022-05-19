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

        $consulta = $this->consultaIndexReceita();
        
        if ($request->ajax()) {

            return Datatables::of($consulta)
                ->addIndexColumn()
                ->addColumn('action', function($consulta) {

                $btnVisualizar = '<div class="row col-sm-12">
                    <a href="receita/' .  $consulta->id . '" class="edit btn btn-primary btn-lg"  title="Visualizar Receita">Visualizar</a>
                </div>';

                return $btnVisualizar;
                })

                ->rawColumns(['action'])
                ->make(true);
        }        else {
            $data = Receita::orderBy('id', 'DESC')->paginate(5);
            return view('receita.index', compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }


    public function tabelaReceitas(Request $request){

        $consulta = $this->consultaIndexReceita();

        return Datatables::of($consulta)
        ->filter(function ($query) use ($request) {


            if (($request->has('id')) && ($request->id != NULL)) {
                $query->where('receita.id', '=', "{$request->get('id')}");
            }
            if (($request->has('valorreceita')) && ($request->valorreceita != NULL)) {
                $query->where('valorreceita', '=', "{$request->get('valorreceita')}");
            }
            if (($request->has('datapagamentoreceita')) && ($request->datapagamentoreceita != NULL)) {
                $query->where('datapagamentoreceita', '=', "{$request->get('datapagamentoreceita')}");
            }

            if (($request->has('contareceita')) && ($request->contareceita != NULL)) {
                $query->where('contareceita', '=', "{$request->get('contareceita')}");
            }
            if (($request->has('idosreceita')) && ($request->idosreceita != NULL)) {
                $query->where('idosreceita', '=', "{$request->get('idosreceita')}");
            }
            if (($request->has('vencimento')) && ($request->vencimento != NULL)) {
                $query->where('vencimento', '=', "{$request->get('vencimento')}");
            }
        })
        ->addIndexColumn()
        ->addColumn('action', function($consulta) {

        $btnVisualizar = '<div class="row col-sm-12">
            <a href="receita/' .  $consulta->id . '" class="edit btn btn-primary btn-lg" title="Visualizar Receita">Visualizar</a>
        </div>';

        return $btnVisualizar;
        })
    
        ->rawColumns(['action'])
        ->make(true);

    }

    public function consultaIndexReceita()
    {

        $consulta = DB::table('receita')
        ->join('conta', 'receita.contareceita', 'conta.id')
        ->leftJoin('clientes', 'receita.idclientereceita', 'clientes.id')
        ->leftJoin('formapagamento', 'receita.idformapagamentoreceita', 'formapagamento.id')


        ->select(['receita.id', 'receita.idosreceita', 'receita.idclientereceita',  'clientes.id as idDoCliente','clientes.razaosocialCliente', 'receita.idformapagamentoreceita', 'formapagamento.nomeFormaPagamento', 'receita.datapagamentoreceita',
        'receita.dataemissaoreceita', 'receita.valorreceita', 'receita.pagoreceita', 'conta.id as idDaConta','conta.apelidoConta','receita.contareceita', 'receita.descricaoreceita', 'receita.registroreceita',
        'receita.nfreceita']);

        // $consulta1 = DB::select("SELECT receita.id,  receita.idosreceita ,  receita.idclientereceita ,  clientes.id as idDoCliente,clientes.razaosocialCliente,  receita.idformapagamentoreceita ,  receita.datapagamentoreceita ,
        // receita.dataemissaoreceita ,  receita.valorreceita ,  receita.pagoreceita ,  conta.id as idDaConta ,conta.nomeConta , receita.contareceita ,  receita.descricaoreceita ,  receita.registroreceita ,
        // receita.nfreceita   from receita 
        //  inner join `conta` on `receita`.`contareceita` = `conta`.`id` 
        //  left join `clientes` on `receita`.`idclientereceita` = `clientes`.`id`");
        
        return $consulta;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaContas = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1');
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
        $listaContas = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1 order by id = :idConta', ['idConta' => $receita->contareceita]);

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
        $listaContas = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1 order by id = :idConta', ['idConta' => $receita->contareceita]);


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
         //   'dataemissaoreceita'        => 'required',
            'valorreceita'              => 'required',
            'pagoreceita'               => 'required',
            'contareceita'              => 'required',
            // 'descricaoreceita'          => 'required',
          //  'registroreceita'           => 'required',
           // 'nfreceita'                 => 'required',
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
