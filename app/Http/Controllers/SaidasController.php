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

        $codbarras               = $validacoesPesquisa[0];
        $descricaosaida          = $validacoesPesquisa[1];
        $nomeBensPatrimoniais      = $validacoesPesquisa[2];
        $portador                = $validacoesPesquisa[3];
        $ordemdeservico          = $validacoesPesquisa[4];
        $dataretiradainicial     = $validacoesPesquisa[5];
        $dataretiradafinal       = $validacoesPesquisa[6];
        $datapararetornoinicial  = $validacoesPesquisa[7];
        $datapararetornofinal    = $validacoesPesquisa[8];

        $rota = $this->verificaRelatorio($request);

        return view($rota, compact('codbarras', 'descricaosaida', 'nomeBensPatrimoniais', 'portador', 'ordemdeservico', 'dataretiradainicial', 'dataretiradafinal', 'datapararetornoinicial', 'datapararetornofinal'));
    }


    public function apisaida(Request $request)
    {
        // TODO: Montar filtro genérico de despesas

        $descricao = $this->montaFiltrosConsulta($request);
        // $descricao = '';
        $listaDespesas = DB::select("SELECT s.*, 
        DATEDIFF(CURDATE(), s.dataretirada) AS qtddiasemprestado,
        CASE
    	WHEN DATEDIFF(CURDATE(), s.datapararetorno) = 0 THEN 'Devolver hoje'
    	WHEN DATEDIFF(CURDATE(), s.datapararetorno)  > 0 THEN  CONCAT(DATEDIFF(CURDATE(), s.datapararetorno), ' dia(s) atrasado')
    	WHEN DATEDIFF(CURDATE(), s.datapararetorno) < 0 THEN  CONCAT(DATEDIFF(CURDATE(), s.datapararetorno ) * (-1), ' dia(s) restante(s)')
    	ELSE 'Sem contagem disponível'
		END as qtddiaspararetorno,
         b.nomeBensPatrimoniais 
            FROM  saidas s 
            LEFT JOIN estoque e on s.codbarras = e.codbarras
            LEFT JOIN benspatrimoniais b on e.idbenspatrimoniais = b.id
            WHERE s.excluidosaida = 0" . $descricao);

        return $listaDespesas;
    }

    private function montaFiltrosConsulta($request)
    {

  
        $descricao = "";
        $verificaInputCampos = 0;
        if ($request->codbarras) :     $descricao .= " AND s.codbarras =  '$request->codbarras'";
            $verificaInputCampos++;
        endif;
        if ($request->descricaosaida) :     $descricao .= " AND s.descricaosaida LIKE  '%$request->descricaosaida%'";
            $verificaInputCampos++;
        endif;
        if ($request->descricaosaida) :     $descricao .= " AND s.descricaosaida LIKE  '%$request->descricaosaida%'";
            $verificaInputCampos++;
        endif;
        if ($request->nomeBensPatrimoniais) :     $descricao .= " AND b.nomeBensPatrimoniais LIKE  '%$request->nomeBensPatrimoniais%'";
            $verificaInputCampos++;
        endif;
        if ($request->portador) :     $descricao .= " AND s.portador LIKE  '%$request->portador%'";
            $verificaInputCampos++;
        endif;
        if ($request->ordemdeservico) :     $descricao .= " AND s.ordemdeservico LIKE  '%$request->ordemdeservico%'";
            $verificaInputCampos++;
        endif;

        if ($request->dataretiradafinal) :        $dataretiradafinal    = $request->dataretiradafinal;
        elseif ($verificaInputCampos == 0) : $dataretiradafinal = date('Y-m-t');
        endif;

        if ($request->dataretiradainicial) :     $descricao .= " AND s.dataretirada BETWEEN  '$request->dataretiradainicial' and '$dataretiradafinal'";
        elseif ($verificaInputCampos == 0) :   $dataretiradainicial = date('Y-m') . '-01';
            $descricao .= " AND s.dataretirada BETWEEN  '$dataretiradainicial' and '$dataretiradafinal'";
        endif;

        if ($request->datapararetornofinal) :        $datapararetornofinal    = $request->datapararetornofinal;
        elseif ($verificaInputCampos == 0) : $datapararetornofinal = date('Y-m-t');
        endif;

        if ($request->datapararetornoinicial) :     $descricao .= " AND s.datapararetorno BETWEEN  '$request->datapararetornoinicial' and '$datapararetornofinal'";
        elseif ($verificaInputCampos == 0) :   $datapararetornoinicial = date('Y-m') . '-01';
            $descricao .= " AND s.datapararetorno BETWEEN  '$datapararetornoinicial' and '$datapararetornofinal'";
        endif;
        return $descricao;
    }

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
            // 'ocorrencia'           => 'required',
            // 'ativadosaida'              => 'required',    
            // 'excluidosaida'             => 'required'
        ]);

            $salvaSaidas = Saidas::create([
                'codbarras'             => $request->codbarras,
                'descricaosaida'        => $request->descricaosaida,
                // 'idbenspatrimoniais'    => $request->idbenspatrimoniais,
                'excluidosaida'         => $request->excluidosaida,
                'portador'              => $request->portadorsaida,
                'ordemdeservico'        => $request->ordemdeservico,
                'datapararetirada'      => $request->datapararetiradasaida,
                'dataretirada'          => $request->dataretiradasaida,
                'datapararetorno'       => $request->dataretornoretiradasaida,
                'ocorrencia'            => $request->ocorrencia,
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
                $bensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais where ativadobenspatrimoniais = 1 order by id desc');
        
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
            LEFT JOIN estoque e on s.codbarras = e.codbarras
            LEFT JOIN benspatrimoniais b on e.idbenspatrimoniais = b.id
            WHERE s.id = $id and s.excluidosaida = 0");

        return view('saidas.show', compact('saidas', 'listaSaidas'));
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
            LEFT JOIN estoque e on s.codbarras = e.codbarras
            LEFT JOIN benspatrimoniais b on e.idbenspatrimoniais = b.id
            WHERE s.id = $id and s.excluidosaida = 0");

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
        $saidas->ocorrencia                 = $request->input('ocorrencia');
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
