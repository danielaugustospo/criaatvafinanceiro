<?php


namespace App\Http\Controllers;


use App\Entradas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use App\Providers\FormatacoesServiceProvider;
use App\Estoque;


class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:entradas-list|entradas-create|entradas-edit|entradas-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:entradas-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:entradas-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:entradas-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $consulta = $this->consultaIndexDespesa();
        if ($request->get('id')) {
            $identrada = $request->get('id');
            settype($identrada, "integer");
            $this->show($identrada);

            $despesas = Entradas::where('id', $identrada)->where('excluidoentrada', 0)->get();
            if (count($despesas) == 1) {
                header("Location: entradas/$identrada");
                exit();
            } else {
                return redirect()->route('entradas.index')
                    ->with('warning', 'Entradas ' . $identrada . ' é um dado excluído, ou uma entrada inexistente, não podendo ser acessada');
            }
        }
        $validacoesPesquisa = $this->validaPesquisa($request);

        $despesas       = $validacoesPesquisa[0];
        $valor          = $validacoesPesquisa[1];
        $dtinicio       = $validacoesPesquisa[2];
        $dtfim          = $validacoesPesquisa[3];
        $coddespesa     = $validacoesPesquisa[4];
        $fornecedor     = $validacoesPesquisa[5];
        $ordemservico   = $validacoesPesquisa[6];
        $conta          = $validacoesPesquisa[7];
        $notafiscal     = $validacoesPesquisa[8];
        $cliente        = $validacoesPesquisa[9];
        $fixavariavel   = $validacoesPesquisa[10];
        $pago           = $validacoesPesquisa[11];

        $rota = $this->verificaRelatorio($request);

        return view($rota, compact('despesas', 'valor', 'dtinicio', 'dtfim', 'coddespesa', 'fornecedor', 'ordemservico', 'conta', 'notafiscal', 'cliente', 'fixavariavel', 'pago'));
    }


    public function apientrada(Request $request)
    {
        // TODO: Montar filtro genérico de despesas

        // $descricao = $this->montaFiltrosConsulta($request);
        $descricao = '';
        $listaDespesas = DB::select('SELECT e.*, b.nomeBensPatrimoniais 
            FROM  entradas e 
            LEFT JOIN benspatrimoniais b on e.idbenspatrimoniais = b.id
            WHERE e.excluidoentrada = 0' . $descricao);

        return $listaDespesas;
    }

    private function montaFiltrosConsulta($request)
    {
        $descricao = "";
        $verificaInputCampos = 0;
        if ($request->despesas) :     $descricao .= " AND d.descricaoDespesa like  '%$request->despesas%'";
            $verificaInputCampos++;
        endif;

        if ($request->coddespesa) :   $descricao .= " AND c.despesaCodigoDespesa like  '%$request->coddespesa%'";
            $verificaInputCampos++;
        endif;
        if ($request->fornecedor) :   $descricao .= " AND f.razaosocialFornecedor like  '%$request->fornecedor%'";
            $verificaInputCampos++;
        endif;
        if ($request->ordemservico) : $descricao .= " AND d.idOS = '$request->ordemservico'";
            $verificaInputCampos++;
        endif;
        if ($request->valor) :        $descricao .= " AND d.precoReal = '$request->valor'";
            $verificaInputCampos++;
        endif;
        if ($request->conta) :        $descricao .= " AND cc.apelidoConta = '$request->conta'";
            $verificaInputCampos++;
        endif;
        if ($request->prolabore) : $descricao .= " AND (fun.nomeFuncionario != '') and (c.id = 33)";
            $verificaInputCampos++;
        endif;
        if ($request->reembolso) : $descricao .= " AND d.reembolsado != '0'";
            $verificaInputCampos++;
        endif;


        if ($request->notafiscal) : $descricao  .= " AND d.notaFiscal = '$request->notafiscal'";
            $verificaInputCampos++;
        endif;
        if ($request->cliente) : $descricao     .= " AND os.idClienteOrdemdeServico = '$request->cliente'";
            $verificaInputCampos++;
        endif;
        if ($request->fixavariavel) : $descricao .= " AND d.despesaFixa = '$request->fixavariavel'";
            $verificaInputCampos++;
        endif;
        if ($request->pago) :        $descricao .= " AND d.pago = '$request->pago'";
            $verificaInputCampos++;
        endif;


        if ($request->dtfim) :        $datafim    = $request->dtfim;
        elseif ($verificaInputCampos == 0) : $datafim = date('Y-m-t');
        endif;

        if ($request->dtinicio) :     $descricao .= " AND d.vencimento BETWEEN  '$request->dtinicio' and '$datafim'";
        elseif ($verificaInputCampos == 0) :   $datainicio = date('Y-m') . '-01';
            $descricao .= " AND d.vencimento BETWEEN  '$datainicio' and '$datafim'";
        endif;
        return $descricao;
    }

    private function validaPesquisa($request)
    {
        if ($request->get('despesas')) :     $despesas = $request->get('despesas');
        else : $despesas = '';
        endif;
        if ($request->get('valor')) :        $valor = FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valor'));
        else : $valor = '';
        endif;
        if ($request->get('dtinicio')) :     $dtinicio = $request->get('dtinicio');
        else : $dtinicio = '';
        endif;
        if ($request->get('dtfim')) :        $dtfim = $request->get('dtfim');
        else : $dtfim = '';
        endif;
        if ($request->get('coddespesa')) :   $coddespesa = $request->get('coddespesa');
        else : $coddespesa = '';
        endif;
        if ($request->get('fornecedor')) :   $fornecedor = $request->get('fornecedor');
        else : $fornecedor = '';
        endif;
        if ($request->get('ordemservico')) : $ordemservico = $request->get('ordemservico');
        else : $ordemservico = '';
        endif;
        if ($request->get('conta')) :        $conta = $request->get('conta');
        else : $conta = '';
        endif;
        if ($request->get('notafiscal')) :    $notafiscal = $request->get('notafiscal');
        else : $notafiscal = '';
        endif;
        if ($request->get('cliente')) :       $cliente = $request->get('cliente');
        else : $cliente = '';
        endif;
        if ($request->get('fixavariavel')) :  $fixavariavel = $request->get('fixavariavel');
        else : $fixavariavel = '';
        endif;
        if ($request->get('pago')) :        $pago = $request->get('pago');
        else : $pago = '';
        endif;

        $solicitacaoArray = array($despesas, $valor, $dtinicio, $dtfim, $coddespesa, $fornecedor, $ordemservico, $conta, $notafiscal, $cliente, $fixavariavel, $pago);
        return $solicitacaoArray;
    }

    private function verificaRelatorio($request)
    {

        $rotaRetorno = 'entradas.index';
        if ($request->get('tpRel') ==  'fornecedor') :
            $rotaRetorno = 'relatorio.fornecedor.index';
        endif;

        return $rotaRetorno;
    }

    // public function consultaIndexEntrada()
    // {

    //     $consulta = DB::select('SELECT e.*, b.nomeBensPatrimoniais 
    //         FROM  entradas e 
    //         LEFT JOIN benspatrimoniais b on e.idbenspatrimoniais = b.id
    //         WHERE e.excluidoentrada = 0');

    //     return $consulta;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $banco =  DB::select('select * from banco');
        $tipoEntrada = $request->metodo;

        return view('entradas.create', compact('tipoEntrada'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tipoentrada = $request->metodo;

        if ($tipoentrada == 'novo') {
            $request->validate([
                'codbarras'             => 'required',
                'idbenspatrimoniais'    => 'required',
            ]);
            Entradas::create($request->all());

            return redirect()->route('entradas.index')->with('success', 'Entrada criada com êxito.');
        } 
        elseif ($tipoentrada == 'devolucao') {

            $request->validate([
                'codbarras'      => 'required',
            ]);

            $salvaEntradas = Entradas::create([
                'codbarras' => $request->codbarras,
            ]);

            $affected = DB::table('estoque')
            ->where('id', $request->codbarras)
            ->where('ativadoestoque', 0)
            ->where('excluidoestoque', 0)
            ->update(['ativadoestoque' => 1]);

                return redirect()->route('estoque.index')
                    ->with('success', 'Devolução lançada com êxito.');

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entradas = Entradas::find($id);
        $selectBensPatrimoniais = DB::select('SELECT * FROM bensPatrimoniais where ativadobenspatrimoniais = 1 order by id =' . $entradas->idbenspatrimoniais . ' desc');

        return view('entradas.show', compact('entradas', 'selectBensPatrimoniais'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entradas = Entradas::find($id);
        $selectBensPatrimoniais = DB::select('SELECT * FROM bensPatrimoniais where ativadobenspatrimoniais = 1 order by id =' . $entradas->idbenspatrimoniais . ' desc');

        return view('entradas.edit', compact('entradas', 'selectBensPatrimoniais'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'descricaoentrada'      => 'required|min:3',
            'idbenspatrimoniais'    => 'required',
            'qtdeEntrada'           => 'required',
            // 'ativoentrada'          => 'required',
            'excluidoentrada'       => 'required'
        ]);

        $entradas = Entradas::find($id);
        $entradas->descricaoentrada         = $request->input('descricaoentrada');
        $entradas->idbenspatrimoniais       = $request->input('idbenspatrimoniais');
        $entradas->qtdeEntrada              = $request->input('qtdeEntrada');
        // $entradas->ativoentrada             = $request->input('ativoentrada');
        $entradas->excluidoentrada          = $request->input('excluidoentrada');
        $entradas->save();

        // $entradas->update($request->all());


        return redirect()->route('entradas.index')
            ->with('success', 'Entrada atualizada com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Entradas::find($id)->delete();

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada excluída com êxito!');
    }
}
