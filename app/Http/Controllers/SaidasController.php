<?php


namespace App\Http\Controllers;

use App\Estoque;
use App\Saidas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Enums\StatusEnumSaidas;

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

            $saida = Saidas::where('id', $idsaida)->where('deleted_at', null)->get();
            if (count($saida) == 1) {
                header("Location: saidas/$idsaida");
                exit();
            } else {
                return redirect()->route('saidas.index')
                    ->with('warning', 'A retirada ' . $idsaida . ' é um dado excluído, ou uma retirada inexistente, não podendo ser acessada');
            }
        }
        $validacoesPesquisa = $this->validaPesquisa($request);

        $codbarras               = $validacoesPesquisa[0];
        $descricaosaida          = $validacoesPesquisa[1];
        $nomeBensPatrimoniais    = $validacoesPesquisa[2];
        $portador                = $validacoesPesquisa[3];
        $ordemdeservico          = $validacoesPesquisa[4];
        $dataretiradainicial     = $validacoesPesquisa[5];
        $dataretiradafinal       = $validacoesPesquisa[6];
        $datapararetornoinicial  = $validacoesPesquisa[7];
        $datapararetornofinal    = $validacoesPesquisa[8];

        $saidas         = new Saidas();
        $listaSaidas    = $saidas->listaSaidas()->get();
        $listaInventario = DB::select('SELECT e.*,b.nomeBensPatrimoniais FROM estoque e LEFT JOIN benspatrimoniais b on e.idbenspatrimoniais = b.id where ativadoestoque = 1  and  deleted_at IS NULL');

        $rota = $this->verificaRelatorio($request);

        return view($rota, compact('codbarras', 'descricaosaida', 'nomeBensPatrimoniais', 'portador', 'ordemdeservico', 'dataretiradainicial', 'dataretiradafinal', 'datapararetornoinicial', 'datapararetornofinal', 'listaSaidas', 'listaInventario'));
    }


    public function apisaida(Request $request)
    {
    
        $listaSaidas = Saidas::select('saidas.*', 'estoque.codbarras', 'b.nomeBensPatrimoniais',
            DB::raw('DATEDIFF(CURDATE(), saidas.dataretirada) AS qtddiasemprestado'),
            DB::raw("CASE
                WHEN (saidas.status = ". StatusEnumSaidas::DEVOLVIDO .") THEN 'DEVOLVIDO'
                WHEN DATEDIFF(CURDATE(), saidas.datapararetorno) = 0 THEN 'Devolver hoje'
                WHEN DATEDIFF(CURDATE(), saidas.datapararetorno) > 0 THEN CONCAT(DATEDIFF(CURDATE(), saidas.datapararetorno), ' dia(s) atrasado')
                WHEN DATEDIFF(CURDATE(), saidas.datapararetorno) < 0 THEN CONCAT(DATEDIFF(CURDATE(), saidas.datapararetorno) * (-1), ' dia(s) restante(s)')
                ELSE 'Sem contagem disponível'
            END as qtddiaspararetorno"))
            ->leftJoin('estoque', 'saidas.id_estoque', '=', 'estoque.id')
            ->leftJoin('benspatrimoniais as b', 'estoque.idbenspatrimoniais', '=', 'b.id')
            ->whereNull('saidas.deleted_at')
            ->where('estoque.ativadoestoque', 1)
            ->where('estoque.deleted_at', null)
            ->when($request->codbarras, function ($query, $codbarras) {
                return $query->where('estoque.codbarras', $codbarras);
            })
            ->when($request->descricaosaida, function ($query, $descricaosaida) {
                return $query->where('saidas.descricaosaida', 'LIKE', '%' . $descricaosaida . '%');
            })
            ->when($request->nomeBensPatrimoniais, function ($query, $nomeBensPatrimoniais) {
                return $query->where('b.nomeBensPatrimoniais', 'LIKE', '%' . $nomeBensPatrimoniais . '%');
            })
            ->when($request->portador, function ($query, $portador) {
                return $query->where('saidas.portador', 'LIKE', '%' . $portador . '%');
            })
            ->when($request->ordemdeservico, function ($query, $ordemdeservico) {
                return $query->where('saidas.ordemdeservico', 'LIKE', '%' . $ordemdeservico . '%');
            })
            ->when($request->dataretiradafinal, function ($query, $dataretiradafinal) use ($request) {
                if (!$request->dataretiradainicial) {
                    $dataretiradainicial = date('Y-m') . '-01';
                } else {
                    $dataretiradainicial = $request->dataretiradainicial;
                }
                return $query->whereBetween('saidas.dataretirada', [$dataretiradainicial, $dataretiradafinal]);
            })
            ->when($request->datapararetornofinal, function ($query, $datapararetornofinal) use ($request) {
                if (!$request->datapararetornoinicial) {
                    $datapararetornoinicial = date('Y-m') . '-01';
                } else {
                    $datapararetornoinicial = $request->datapararetornoinicial;
                }
                return $query->whereBetween('saidas.datapararetorno', [$datapararetornoinicial, $datapararetornofinal]);
            })
            ->get();
    
        return $listaSaidas;
    }
    
    

    // private function montaFiltrosConsulta($request)
    // {

    //     $descricao = "";
    //     $verificaInputCampos = 0;
    //     if ($request->codbarras) :     $descricao .= " AND estoque.codbarras =  '$request->codbarras'";
    //         $verificaInputCampos++;
    //     endif;
    //     if ($request->descricaosaida) :     $descricao .= " AND saidas.descricaosaida LIKE  '%$request->descricaosaida%'";
    //         $verificaInputCampos++;
    //     endif;
    //     if ($request->descricaosaida) :     $descricao .= " AND saidas.descricaosaida LIKE  '%$request->descricaosaida%'";
    //         $verificaInputCampos++;
    //     endif;
    //     if ($request->nomeBensPatrimoniais) :     $descricao .= " AND b.nomeBensPatrimoniais LIKE  '%$request->nomeBensPatrimoniais%'";
    //         $verificaInputCampos++;
    //     endif;
    //     if ($request->portador) :     $descricao .= " AND saidas.portador LIKE  '%$request->portador%'";
    //         $verificaInputCampos++;
    //     endif;
    //     if ($request->ordemdeservico) :     $descricao .= " AND saidas.ordemdeservico LIKE  '%$request->ordemdeservico%'";
    //         $verificaInputCampos++;
    //     endif;

    //     if ($request->dataretiradafinal) :        $dataretiradafinal    = $request->dataretiradafinal;
    //     elseif ($verificaInputCampos == 0) : $dataretiradafinal = date('Y-m-t');
    //     endif;

    //     if ($request->dataretiradainicial) :     $descricao .= " AND saidas.dataretirada BETWEEN  '$request->dataretiradainicial' and '$dataretiradafinal'";
    //     elseif ($verificaInputCampos == 0) :   $dataretiradainicial = date('Y-m') . '-01';
    //         $descricao .= " AND saidas.dataretirada BETWEEN  '$dataretiradainicial' and '$dataretiradafinal'";
    //     endif;

    //     if ($request->datapararetornofinal) :        $datapararetornofinal    = $request->datapararetornofinal;
    //     elseif ($verificaInputCampos == 0) : $datapararetornofinal = date('Y-m-t');
    //     endif;

    //     if ($request->datapararetornoinicial) :     $descricao .= " AND saidas.datapararetorno BETWEEN  '$request->datapararetornoinicial' and '$datapararetornofinal'";
    //     elseif ($verificaInputCampos == 0) :   $datapararetornoinicial = date('Y-m') . '-01';
    //     $descricao .= " AND saidas.datapararetorno BETWEEN  '$datapararetornoinicial' and '$datapararetornofinal'";
    //     endif;
    //     return $descricao;
    // }

    private function validaPesquisa($request)
    {   
        
        if ($request->get('codbarras')) :     $codbarras = $request->get('codbarras');
        else : $codbarras = '';
        endif;
        if ($request->get('descricaosaida')) :     $descricaosaida = $request->get('descricaosaida');
        else : $descricaosaida = '';
        endif;
        if ($request->get('nomeBensPatrimoniais')) :     $nomeBensPatrimoniais = $request->get('nomeBensPatrimoniais');
        else : $nomeBensPatrimoniais = '';
        endif;
        if ($request->get('portador')) :     $portador = $request->get('portador');
        else : $portador = '';
        endif;
        if ($request->get('ordemdeservico')) :     $ordemdeservico = $request->get('ordemdeservico');
        else : $ordemdeservico = '';
        endif;
        if ($request->get('dataretiradainicial')) :     $dataretiradainicial = $request->get('dataretiradainicial');
        else : $dataretiradainicial = '';
        endif;
        if ($request->get('dataretiradafinal')) :     $dataretiradafinal = $request->get('dataretiradafinal');
        else : $dataretiradafinal = '';
        endif;
        if ($request->get('datapararetornoinicial')) :     $datapararetornoinicial = $request->get('datapararetornoinicial');
        else : $datapararetornoinicial = '';
        endif;
        if ($request->get('datapararetornofinal')) :        $datapararetornofinal = $request->get('datapararetornofinal');
        else : $datapararetornofinal = '';
        endif;

        $solicitacaoArray = array($codbarras, $descricaosaida, $nomeBensPatrimoniais, $portador, $ordemdeservico, $dataretiradainicial, $dataretiradafinal, $datapararetornoinicial, $datapararetornofinal);
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
        $saidasModel        = new Saidas();
        $listaInventario  = $saidasModel->disponivelEmEstoque();

        return view('saidas.create', compact('listaInventario'));
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

            'portadorsaida'             => 'required',
        ]);
            $request->quantidade_saida = ($request->quantidade_saida == null) ? 1 :  $request->quantidade_saida;


            $estoqueItens = Estoque::where('idbenspatrimoniais', $request->idbenspatrimoniais)
            ->where('ativadoestoque', '1')
            ->get();
        
        if ($estoqueItens->isEmpty()) {
            return redirect()->route('saidas.index')->with('error', 'Estoque não encontrado');
        }
        
        $quantidadeSaida = $request->quantidade_saida;
        
        foreach ($estoqueItens as $estoque) {
            if ($quantidadeSaida > 0 && $estoque->quantidade > 0) {
                $quantidadeRemovida = min($quantidadeSaida, $estoque->quantidade);
        
                $salvaSaidas = Saidas::create([
                    'status' => StatusEnumSaidas::NA_RUA,
                    'id_estoque' => $estoque->id,
                    'descricaosaida' => $request->descricaosaida,
                    'quantidade_saida' => $quantidadeRemovida,
                    'portador' => $request->portadorsaida,
                    'ordemdeservico' => $request->ordemdeservico,
                    'datapararetirada' => $request->datapararetiradasaida,
                    'dataretirada' => $request->dataretiradasaida,
                    'datapararetorno' => $request->dataretornoretiradasaida,
                    'ocorrencia' => $request->ocorrencia
                ]);
        
                $estoque->update([
                    'quantidade' => \DB::raw("quantidade - $quantidadeRemovida")
                ]);
        
                $quantidadeSaida -= $quantidadeRemovida;
            }
        }
        
        if ($quantidadeSaida > 0) {
            return redirect()->route('saidas.index')->with('error', 'Não há estoque suficiente');
        }

            // $salvaSaidas = Saidas::create([
            //     'status'                => StatusEnumSaidas::NA_RUA,
            //     'id_estoque'            => $request->idbenspatrimoniais,
            //     'descricaosaida'        => $request->descricaosaida,
            //     'quantidade_saida'      => $request->quantidade_saida,
            //     'portador'              => $request->portadorsaida,
            //     'ordemdeservico'        => $request->ordemdeservico,
            //     'datapararetirada'      => $request->datapararetiradasaida,
            //     'dataretirada'          => $request->dataretiradasaida,
            //     'datapararetorno'       => $request->dataretornoretiradasaida,
            //     'ocorrencia'            => $request->ocorrencia
            // ]);
            // if($salvaSaidas){
            //     Estoque::where('id', $request->id_estoque)
            //         ->where('ativadoestoque', '1')
            //         ->update([
            //             'quantidade' => \DB::raw("quantidade - $request->quantidade_saida")
            //         ]);
            // }
            // else{
            //     return redirect()->route('saidas.index')->with('error', 'Saída criada com êxito, mas item não foi retirado do estoque');
            // }
            $mensagemExito = 'Saída de material lançada com êxito.';
            if( $salvaSaidas){
                
                $id = $salvaSaidas->id;
                if($request->tpRetorno == 'visualiza'){
                    $rotaRetorno = 'saidas.show';
                    $saidas = Saidas::where('id', $id)->with('estoque.bensPatrimoniais')->first();
                    return view('saidas.show', compact('saidas'));
    
                }
                elseif($request->tpRetorno == 'novo'){  
                    $rotaRetorno = 'saidas.create';
                    return redirect()->route($rotaRetorno)->with('success', $mensagemExito);
                }
            }

            else{
                $rotaRetorno = 'saidas.index';
                return redirect()->route($rotaRetorno)->with('success', $mensagemExito);
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
        $saidas = Saidas::where('id', $id)->with('estoque.bensPatrimoniais')->first();
        return view('saidas.show', compact('saidas'));
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

        $listaSaidas = DB::select("SELECT s.*, 
        DATEDIFF(CURDATE(), s.dataretirada) AS qtddiasemprestado,
        CASE
    	WHEN DATEDIFF(CURDATE(), s.datapararetorno) = 0 THEN 'Devolver hoje'
    	WHEN DATEDIFF(CURDATE(), s.datapararetorno)  > 0 THEN  CONCAT(DATEDIFF(CURDATE(), s.datapararetorno), ' dia(s) atrasado')
    	WHEN DATEDIFF(CURDATE(), s.datapararetorno) < 0 THEN  CONCAT(DATEDIFF(CURDATE(), s.datapararetorno ) * (-1), ' dia(s) restante(s)')
    	ELSE 'Sem contagem disponível'
		END as qtddiaspararetorno,
        b.nomeBensPatrimoniais 
            FROM  saidas s 
            LEFT JOIN estoque e on s.id_estoque = e.id
            LEFT JOIN benspatrimoniais b on e.idbenspatrimoniais = b.id
            WHERE s.id = $id and s.deleted_at IS NULL");

        return view('saidas.edit', compact('saidas', 'listaSaidas'));
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
            'ocorrencia'           => 'required',
            // 'ativadosaida'              => 'required',    
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
        $saidas->ocorrencia                 = $request->input('ocorrencia');
        // $saidas->ativadosaida               = $request->input('ativadosaida');
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
