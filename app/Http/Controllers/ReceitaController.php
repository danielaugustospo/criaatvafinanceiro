<?php


namespace App\Http\Controllers;


use App\Receita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use App\Providers\FormatacoesServiceProvider;
use App\Clientes;


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
        } elseif ($this->acao == 'edit') {
            $this->variavelReadOnlyNaView = "";
            $this->variavelDisabledNaView = "";
            $this->valorInput = null;
            $this->valorSemCadastro = null;
        } elseif ($this->acao != 'edit' && $this->acao != 'create') {
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
        if ($request->get('id')) {
            $idreceita = $request->get('id');
            settype($idreceita, "integer");
            $this->show($idreceita);

            $receita = Receita::where('id', $idreceita)->where('excluidoreceita', 0)->get();
            if (count($receita) == 1) {
                header("Location: receita/$idreceita");
                exit();
            } else {
                return redirect()->route('receita.index')
                    ->with('warning', 'Receita ' . $idreceita . ' é um dado excluído, ou uma receita inexistente, não podendo ser acessado');
            }
        }
        $validacoesPesquisa = $this->validaPesquisa($request);

        $receita        = $validacoesPesquisa[0];
        $valorreceita   = $validacoesPesquisa[1];
        $dtinicio       = $validacoesPesquisa[2];
        $dtfim          = $validacoesPesquisa[3];
        $ordemservico   = $validacoesPesquisa[4];
        $contareceita   = $validacoesPesquisa[5];
        $nfreceita      = $validacoesPesquisa[6];
        $cliente        = $validacoesPesquisa[7];

        $clienteObject      = Clientes::find($validacoesPesquisa[7]);
        $clienteExibicao    = null;
        
        if ($clienteObject) {
            $clienteExibicao = $clienteObject->razaosocialCliente;
        }        

        $pagoreceita    = $validacoesPesquisa[8];

        $rota = $this->verificaRelatorio($request);

        return view($rota, compact('consulta', 'receita', 'valorreceita', 'dtinicio', 'dtfim', 'ordemservico', 'contareceita', 'nfreceita', 'cliente', 'clienteExibicao',  'pagoreceita'));
    }


    public function apireceita(Request $request)
    {
        // TODO: Montar filtro genérico de receita

        $descricao = $this->montaFiltrosConsulta($request);

        $listaReceita = DB::select('SELECT distinct r.id, 
        r.idosreceita,
        r.idclientereceita,
        r.idformapagamentoreceita,
        r.datapagamentoreceita,
        r.dataemissaoreceita,
        r.valorreceita,
        r.pagoreceita,
        r.contareceita,
        r.descricaoreceita,
        r.registroreceita,
        r.nfreceita,
        r.ativoreceita,
        r.excluidoreceita,
        r.created_at,
        r.updated_at,
        cc.nomeConta,
        cc.apelidoConta,
        os.eventoOrdemdeServico,
        fpg.nomeFormaPagamento, 
       
        (CASE 
        	WHEN (r.idosreceita =  "CRIAATVA") THEN cliSemOS.razaosocialCliente
        	WHEN (r.idosreceita IS NULL) THEN cliSemOS.razaosocialCliente
        	WHEN (r.idosreceita = "") THEN cliSemOS.razaosocialCliente
        	WHEN (cli.razaosocialCliente IS NULL) THEN "CRIAATVA"
        	ELSE cli.razaosocialCliente
        END) AS razaosocialCliente 
                
        FROM receita r

        LEFT JOIN conta             AS cc   ON r.contareceita = cc.id
        LEFT JOIN ordemdeservico    AS os   ON r.idosreceita = os.id
        LEFT JOIN formapagamento    AS fpg  ON r.idformapagamentoreceita = fpg.id
        LEFT JOIN clientes          AS cli  ON os.idClienteOrdemdeServico = cli.id
        LEFT JOIN clientes          AS cliSemOS  ON r.idclientereceita = cliSemOS.id     
        
        WHERE r.excluidoreceita = 0 ' . $descricao);

        return $listaReceita;
    }

    private function montaFiltrosConsulta($request)
    {
        $descricao = "";
        $verificaInputCampos = 0;
        if ($request->receita) :     $descricao .= " AND r.descricaoreceita like  '%$request->receita%'";
            $verificaInputCampos++;
        endif;

        if ($request->ordemservico) : $descricao .= " AND r.idosreceita = '$request->ordemservico'";
            $verificaInputCampos++;
        endif;
        if ($request->valorreceita) : $descricao .= " AND r.valorreceita = '$request->valorreceita'";
            $verificaInputCampos++;
        endif;
        if ($request->contareceita) : $descricao .= " AND cc.apelidoConta = '$request->contareceita'";
            $verificaInputCampos++;
        endif;

        if ($request->nfreceita)    : $descricao  .= " AND r.nfreceita = '$request->nfreceita'";
            $verificaInputCampos++;
        endif;

        if ($request->cliente)      : $descricao     .= " AND r.idclientereceita = '$request->cliente'";
            $verificaInputCampos++;
        endif;

        if ($request->pagoreceita)  : $descricao .= " AND r.pagoreceita = '$request->pagoreceita'";
            $verificaInputCampos++;
        endif;

        if ($request->dtfim)        : $datafim    = $request->dtfim;
        elseif ($verificaInputCampos == 0) : $datafim = date('Y-m-t');
        endif;

        if ($request->dtinicio) :     $descricao .= " AND r.datapagamentoreceita BETWEEN  '$request->dtinicio' and '$datafim'";
        elseif ($verificaInputCampos == 0) :   $datainicio = date('Y-m') . '-01';
            $descricao .= " AND r.datapagamentoreceita BETWEEN  '$datainicio' and '$datafim'";
        endif;
        return $descricao;
    }

    private function validaPesquisa($request)
    {
        if ($request->get('receita')) :     $receita = $request->get('receita');
        else : $receita = '';
        endif;
        if ($request->get('valorreceita')) :        $valorreceita = FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorreceita'));
        else : $valorreceita = '';
        endif;
        if ($request->get('dtinicio')) :     $dtinicio = $request->get('dtinicio');
        else : $dtinicio = '';
        endif;
        if ($request->get('dtfim')) :        $dtfim = $request->get('dtfim');
        else : $dtfim = '';
        endif;

        if ($request->get('ordemservico')) : $ordemservico = $request->get('ordemservico');
        else : $ordemservico = '';
        endif;
        if ($request->get('contareceita')) :        $contareceita = $request->get('contareceita');
        else : $contareceita = '';
        endif;
        if ($request->get('nfreceita')) :    $nfreceita = $request->get('nfreceita');
        else : $nfreceita = '';
        endif;
        if ($request->get('cliente')) :       $cliente = $request->get('cliente');
        else : $cliente = '';
        endif;
        if ($request->get('pagoreceita')) :        $pagoreceita = $request->get('pagoreceita');
        else : $pagoreceita = '';
        endif;

        $solicitacaoArray = array($receita, $valorreceita, $dtinicio, $dtfim, $ordemservico, $contareceita, $nfreceita, $cliente,  $pagoreceita);
        return $solicitacaoArray;
    }

    private function verificaRelatorio($request)
    {

        $rotaRetorno = 'receita.index';
        if ($request->get('tpRel') ==  'fornecedor') :
            $rotaRetorno = 'relatorio.fornecedor.index';

        elseif ($request->get('tpRel') ==  'pclienteanalitico') :
            $rotaRetorno = 'relatorio.despesasporclienteanalitico.index';
        endif;

        return $rotaRetorno;
    }

    public function tabelaReceitas(Request $request)
    {

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
                if (($request->has('datapagamentoreceita')) && ($request->datapagamentoreceita != NULL)) {
                    $query->where('datapagamentoreceita', '=', "{$request->get('datapagamentoreceita')}");
                }
            })
            ->addIndexColumn()
            ->addColumn('action', function ($consulta) {

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


            ->select([
                'receita.id', 'receita.idosreceita', 'receita.idclientereceita',  'clientes.id as idDoCliente', 'clientes.razaosocialCliente', 'receita.idformapagamentoreceita', 'formapagamento.nomeFormaPagamento', 'receita.datapagamentoreceita',
                'receita.dataemissaoreceita', 'receita.valorreceita', 'receita.pagoreceita', 'conta.id as idDaConta', 'conta.apelidoConta', 'receita.contareceita', 'receita.descricaoreceita', 'receita.registroreceita',
                'receita.nfreceita'
            ]);

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
        $receita->idclientereceita              = $request->get('idclientereceita');
        $receita->dataemissaoreceita            = $request->get('dataemissaoreceita');
        $receita->valorreceita                  = $quantia;
        $receita->pagoreceita                   = $request->get('pagoreceita');
        $receita->contareceita                  = $request->get('contareceita');
        $receita->descricaoreceita               = $request->get('descricaoreceita');
        $receita->registroreceita               = $request->get('registroreceita');
        // $receita->emissaoreceita                = $request->get('emissaoreceita');
        $receita->nfreceita                     = $request->get('nfreceita');
        // $receita->idosreceita                   = $request->get('idosreceita');

        DB::update(
        "UPDATE receita
            SET 
            idformapagamentoreceita     = '$receita->idformapagamentoreceita', 
            datapagamentoreceita        = '$receita->datapagamentoreceita',           
            idclientereceita            = '$receita->idclientereceita',             
            dataemissaoreceita          = '$receita->dataemissaoreceita',             
            valorreceita                = '$receita->valorreceita',                   
            pagoreceita                 = '$receita->pagoreceita',                    
            contareceita                = '$receita->contareceita',                   
            descricaoreceita            = '$receita->descricaoreceita',                
            registroreceita             = '$receita->registroreceita',                
            nfreceita                   = '$receita->nfreceita'                      
            -- idosreceita                 = '$receita->idosreceita'                  
            WHERE id                    = '$receita->id'"
        );

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
