<?php


namespace App\Http\Controllers;

use App\Estoque;
use App\Saidas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use App\Providers\FormatacoesServiceProvider;


class SaidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:saidas-list|saidas-create|saidas-edit|saidas-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:saidas-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:saidas-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:saidas-delete', ['only' => ['destroy']]);
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
            $idsaida = $request->get('id');
            settype($idsaida, "integer");
            $this->show($idsaida);

            $saida = Saidas::where('id', $idsaida)->where('excluidosaida', 0)->get();
            if (count($saida) == 1) {
                header("Location: saidas/$idsaida");
                exit();
            } else {
                return redirect()->route('saidas.index')
                    ->with('warning', 'A retirada ' . $idsaida . ' é um dado excluído, ou uma retirada inexistente, não podendo ser acessada');
            }
        }
        $validacoesPesquisa = $this->validaPesquisa($request);

        $saida       = $validacoesPesquisa[0];
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

        return view($rota, compact('saida', 'valor', 'dtinicio', 'dtfim', 'coddespesa', 'fornecedor', 'ordemservico', 'conta', 'notafiscal', 'cliente', 'fixavariavel', 'pago'));
    }


    public function apisaida(Request $request)
    {
        // TODO: Montar filtro genérico de despesas

        // $descricao = $this->montaFiltrosConsulta($request);
        $descricao = '';
        $listaDespesas = DB::select('SELECT s.*, 
        DATEDIFF(CURDATE(), s.dataretirada) AS qtddiasemprestado,
         b.nomeBensPatrimoniais 
            FROM  saidas s 
            LEFT JOIN benspatrimoniais b on s.idbenspatrimoniais = b.id
            WHERE s.excluidosaida = 0' . $descricao);

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

        $rotaRetorno = 'saidas.index';
        if ($request->get('tpRel') ==  'fornecedor') :
            $rotaRetorno = 'relatorio.fornecedor.index';
        endif;

        return $rotaRetorno;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('saidas.create');
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

            // 'descricaosaida'            => 'required',
            // 'idbenspatrimoniais'        => 'required',
            'portadorsaida'             => 'required',
            // 'ordemdeservico'             => 'required',
            // 'datapararetiradasaida'     => 'required',
            // 'dataretiradasaida'         => 'required', 
            // 'dataretornoretiradasaida'  => 'required',
            // 'ocorrenciasaida'           => 'required',
            // 'ativadosaida'              => 'required',    
            // 'excluidosaida'             => 'required'
        ]);

            $salvaSaidas = Saidas::create([
                'codbarras'             => $request->codbarras,
                'descricaosaida'        => $request->descricaosaida,
                'idbenspatrimoniais'    => $request->idbenspatrimoniais,
                'excluidosaida'         => $request->excluidosaida,
                'portador'              => $request->portadorsaida,
                'ordemdeservico'        => $request->ordemdeservico,
                'datapararetirada'      => $request->datapararetiradasaida,
                'dataretirada'          => $request->dataretiradasaida,
                'datapararetorno'       => $request->dataretornoretiradasaida,
                'ocorrencia'            => $request->ocorrenciasaida,
            ]);
            if($salvaSaidas){
            Estoque::where('codbarras', $request->codbarras)
                ->where('ativadoestoque', '1')
                ->update(['ativadoestoque' =>  0]);

            }
            else{
                return redirect()->route('saidas.index')->with('error', 'Saída criada com êxito, mas item não foi retirado do estoque');
            }
            $id = $salvaSaidas->id;
            $mensagemExito = 'Saída de material lançada com êxito.';

            if($request->tpRetorno == 'visualiza'){
                $rotaRetorno = 'saidas.show';
                $visualiza = 1;
                $saidas = Saidas::find($id);

            }
            elseif($request->tpRetorno == 'novo'){  
                $rotaRetorno = 'saidas.create';
                $visualiza = 0;
            }
            else{
                $rotaRetorno = 'saidas.index';
                $visualiza = null;
            }
     
            if($visualiza == 1){
                $saidas = Saidas::find($id);
                $bensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais where ativadobenspatrimoniais = 1 order by id =' . $saidas->idbenspatrimoniais . ' desc');
        
                return view('saidas.show', compact('saidas', 'bensPatrimoniais'));
            }
            elseif($visualiza == 0){
                return redirect()->route($rotaRetorno)->with('success', $mensagemExito);
            }
            else{
                return redirect()->route($rotaRetorno);
            }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saidas = Saidas::find($id);
        $bensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais WHERE ativadobenspatrimoniais = 1 order by id =' . $saidas->idbenspatrimoniais . ' desc');

        return view('saidas.show', compact('saidas', 'bensPatrimoniais'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saidas = Saidas::find($id);
        $bensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais WHERE ativadobenspatrimoniais = 1 order by id =' . $saidas->idbenspatrimoniais . ' desc');

        return view('saidas.edit', compact('saidas', 'bensPatrimoniais'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nomesaida'                 => 'required',
            'descricaosaida'            => 'required',
            'idbenspatrimoniais'        => 'required',
            'portadorsaida'             => 'required',
            'ordemdeservico'             => 'required',
            'datapararetiradasaida'     => 'required',
            // 'dataretiradasaida'         => 'required', 
            'dataretornoretiradasaida'  => 'required',
            'ocorrenciasaida'           => 'required',
            // 'ativadosaida'              => 'required',    
            'excluidosaida'             => 'required'
        ]);

        $saidas = Saidas::find($id);
        $saidas->nomesaida                  = $request->input('nomesaida');
        $saidas->descricaosaida             = $request->input('descricaosaida');
        $saidas->idbenspatrimoniais         = $request->input('idbenspatrimoniais');
        $saidas->portadorsaida              = $request->input('portadorsaida');
        $saidas->ordemdeservico              = $request->input('ordemdeservico');
        $saidas->datapararetiradasaida      = $request->input('datapararetiradasaida');
        $saidas->dataretiradasaida          = $request->input('dataretiradasaida');
        $saidas->dataretornoretiradasaida   = $request->input('dataretornoretiradasaida');
        $saidas->ocorrenciasaida            = $request->input('ocorrenciasaida');
        // $saidas->ativadosaida               = $request->input('ativadosaida');
        $saidas->excluidosaida              = $request->input('excluidosaida');
        $saidas->save();

        // $saidas->update($request->all());

        return redirect()->route('saidas.index')
            ->with('success', 'Saída atualizada com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Saidas::find($id)->delete();

        return redirect()->route('saidas.index')
            ->with('success', 'Saída excluído com êxito!');
    }
}
