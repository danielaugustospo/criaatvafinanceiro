<?php


namespace App\Http\Controllers;

use App\BensPatrimoniais;
use App\Entradas;
use App\Enums\StatusEnumBensPatrimoniais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Estoque;
use App\Saidas;
use App\Enums\StatusEnumSaidas;


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

        $this->listaBensPatrimoniais = BensPatrimoniais::where('statusbenspatrimoniais', StatusEnumBensPatrimoniais::VISIVEL_PARA_TODOS)->get();
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

            $despesas = Entradas::where('id', $identrada)->get();
            if (count($despesas) == 1) {
                header("Location: entradas/$identrada");
                exit();
            } else {
                return redirect()->route('entradas.index')
                    ->with('warning', 'Entradas ' . $identrada . ' é um dado excluído, ou uma entrada inexistente, não podendo ser acessada');
            }
        }
        $validacoesPesquisa     = $this->validaPesquisa($request);

        $codbarras              = $validacoesPesquisa[0];
        $nomeBensPatrimoniais   = $validacoesPesquisa[1];
        $descricaoentrada       = $validacoesPesquisa[2];
        $dtinicio               = $validacoesPesquisa[3];
        $dtfim                  = $validacoesPesquisa[4];
        $tipoEntrada            = $validacoesPesquisa[5];

        $rota = $this->verificaRelatorio($request);


        $entradas      = new Entradas();
        $listaEntradas = $entradas->listaEntradas()->get();


        return view($rota, compact('codbarras', 'listaEntradas', 'nomeBensPatrimoniais', 'descricaoentrada', 'dtinicio', 'dtfim', 'tipoEntrada'));
    }


    public function apientrada(Request $request)
    {
        // TODO: Montar filtro genérico de despesas

        $descricao = $this->montaFiltrosConsulta($request);
        // $descricao = '';
        $listaEntradas = DB::select('SELECT e.*, b.nomeBensPatrimoniais, es.codbarras,
        CASE
        WHEN e.dtdevolucao IS NULL THEN "NOVO"
        ELSE "DEVOLUÇÃO"
        END as tipo
            FROM  entradas e 
            LEFT JOIN estoque es on e.id_estoque = es.id
            LEFT JOIN benspatrimoniais b on es.idbenspatrimoniais = b.id
            WHERE e.deleted_at IS NULL' . $descricao);

        return $listaEntradas;
    }

    private function montaFiltrosConsulta($request)
    {
        $descricao = "";
        $verificaInputCampos = 0;

        if ($request->codbarras) :              $descricao .= " AND es.codbarras like  '%$request->codbarras%'";
            $verificaInputCampos++;
        endif;
        if ($request->nomeBensPatrimoniais) :   $descricao .= " AND b.nomeBensPatrimoniais like  '%$request->nomeBensPatrimoniais%'";
            $verificaInputCampos++;
        endif;
        if ($request->descricaoentrada) :       $descricao .= " AND e.descricaoentrada like  '%$request->descricaoentrada%'";
            $verificaInputCampos++;
        endif;
        if ($request->tipoEntrada) :
            if ($request->tipoEntrada == 'NOVO') :
                $descricao .= " AND e.dtdevolucao IS NULL ";
                $verificaInputCampos++;
            elseif ($request->tipoEntrada == 'DEVOLUÇÃO') :
                $descricao .= " AND e.dtdevolucao IS NOT NULL ";
                $verificaInputCampos++;
            else :
                $descricao .= " ";
            endif;
        endif;
        if ($request->dtfim) :        $datafim    = $request->dtfim;
        elseif ($verificaInputCampos == 0) : $datafim = date('Y-m-t');
        endif;
        if ($request->dtinicio) :     $descricao .= " AND e.created_at BETWEEN  '$request->dtinicio' and '$datafim'";
        elseif ($verificaInputCampos == 0) :   $datainicio = date('Y-m') . '-01';
            $descricao .= " AND e.created_at BETWEEN  '$datainicio' and '$datafim'";
        endif;
        return $descricao;
    }

    private function validaPesquisa($request)
    {

        if ($request->get('codbarras')) :     $codbarras = $request->get('codbarras');
        else : $codbarras = '';
        endif;
        if ($request->get('nomeBensPatrimoniais')) :     $nomeBensPatrimoniais = $request->get('nomeBensPatrimoniais');
        else : $nomeBensPatrimoniais = '';
        endif;
        if ($request->get('descricaoentrada')) :     $descricaoentrada = $request->get('descricaoentrada');
        else : $descricaoentrada = '';
        endif;
        if ($request->get('dtinicio')) :     $dtinicio = $request->get('dtinicio');
        else : $dtinicio = '';
        endif;
        if ($request->get('dtfim')) :        $dtfim = $request->get('dtfim');
        else : $dtfim = '';
        endif;
        if ($request->get('tipoEntrada')) :        $tipoEntrada = $request->get('tipoEntrada');
        else : $tipoEntrada = '';
        endif;

        $solicitacaoArray = array($codbarras, $nomeBensPatrimoniais, $descricaoentrada, $dtinicio, $dtfim, $tipoEntrada);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $listaInventarioaDevolver = Estoque::select(
            'estoque.*',
            \DB::raw('
            SUM(
                CASE
                    WHEN (estoque.quantidadeinicial -
                        IFNULL((SELECT SUM(quantidade_saida) FROM saidas s WHERE s.id_estoque = estoque.id AND s.datapararetorno IS not NULL), 0) -
                        IFNULL((SELECT SUM(quantidade_entrada) FROM entradas en WHERE en.id_estoque = estoque.id), 0)) < 0
                    THEN -1 * (estoque.quantidadeinicial -
                        IFNULL((SELECT SUM(quantidade_saida) FROM saidas s WHERE s.id_estoque = estoque.id AND s.datapararetorno IS not NULL), 0) -
                        IFNULL((SELECT SUM(quantidade_entrada) FROM entradas en WHERE en.id_estoque = estoque.id), 0))
                    ELSE (estoque.quantidadeinicial -
                        IFNULL((SELECT SUM(quantidade_saida) FROM saidas s WHERE s.id_estoque = estoque.id AND s.datapararetorno IS not NULL), 0) -
                        IFNULL((SELECT SUM(quantidade_entrada) FROM entradas en WHERE en.id_estoque = estoque.id), 0))
                END
            ) AS totalADevolver'
            )
        )
        ->where('ativadoestoque', 1)
        ->with('bensPatrimoniais')
        ->groupBy('idbenspatrimoniais')
        ->get();

        $listaBensPatrimoniais = $this->listaBensPatrimoniais;

        $tipoEntrada = $request->metodo;
        $ultimoId    = Estoque::max('id');
        // $novaEntrada = "CRIAATVA" . str_pad(($ultimoId !== null ? ++$ultimoId : 1), 5, "0", STR_PAD_LEFT);

        return view('entradas.create', compact('listaBensPatrimoniais', 'tipoEntrada', 'listaInventarioaDevolver'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoEntrada = $request->query('metodo');
        $tipoEntrada = $request->metodo;
        $salvaEntradas = null; // Inicialize a variável fora do loop
        if ($tipoEntrada == 'novo') {

            $qtdeEntrada    = ($request->input('porcionavel') == '0') ? 1 : $request->input('qtdeEntrada');
            $mensagemExito  = 'Item lançado no estoque com êxito.';
            $metodo         = 'novo';

            $request->validate([
                // 'codbarras'             => 'required | unique:estoque',
                'idbenspatrimoniais'    => 'required',
            ]);
            $salvaEstoque  = Estoque::create([
                // 'nomematerial'          => $request->input('nomematerial'),
                // 'codbarras'             => $request->input('codbarras'),
                'idbenspatrimoniais'    => $request->input('idbenspatrimoniais'),
                'descricao'             => $request->input('descricaoentrada'),
                'quantidadeinicial'     => $qtdeEntrada,
                'quantidade'            => $qtdeEntrada,
                'ativadoestoque'        => 1
            ]);

            $salvaEntradas = Entradas::create([
                'descricaoentrada'      => $request->input('descricaoentrada'),
                'id_estoque'            => $salvaEstoque->id,
                'quantidade_entrada'    => $qtdeEntrada,
            ]);
        } elseif ($tipoEntrada == 'devolucao') {
            $mensagemExito  = 'Devolução lançada com êxito.';
            $metodo         = 'devolucao';
            $salvaEntradas  = $this->lancaDevolucao($request);
        }
        if (!is_null($salvaEntradas)) {
            $id = $salvaEntradas->id;
        } else {
            // Trate o caso em que $salvaEntradas não foi definido
            // Por exemplo, redirecione com uma mensagem de erro
            return redirect()->route('entradas.index')->with('error', 'Erro ao salvar devolução');
        }

        if ($request->tpRetorno == 'visualiza') {
            // $rotaRetorno = 'entradas.show';
            // $visualiza = 1;
            // $metodo = null;
            // $entradas = Entradas::find($id);


            $rotaRetorno = 'entradas.index';
            $visualiza = null;
            $metodo = null;
        } elseif ($request->tpRetorno == 'novo') {
            $rotaRetorno = 'entradas.create';
            $visualiza = 0;
        } else {
            $rotaRetorno = 'entradas.index';
            $visualiza = null;
            $metodo = null;
        }

        if ($visualiza == 1) {
            // return redirect()->route($rotaRetorno, ['id' => $id])->with('success', $mensagemExito);
            $propriedadesEntradas = Entradas::where('id', $id)->with('estoque.bensPatrimoniais')->first();
            if ($propriedadesEntradas->dtdevolucao) {
                $tipoEntrada = 'devolucao';
            } else {
                $tipoEntrada = 'novo';
            }

            $listaBensPatrimoniais = $this->listaBensPatrimoniais;

            $selectBensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais where statusbenspatrimoniais = 1 order by id =' . $propriedadesEntradas->id . ' desc');

            return view('entradas.show', compact('listaBensPatrimoniais', 'propriedadesEntradas', 'tipoEntrada', 'selectBensPatrimoniais'));
        } elseif ($visualiza == 0) {
            return redirect()->route($rotaRetorno, compact("metodo", 'tipoEntrada'))->with('success', $mensagemExito);
        } else {
            return redirect()->route($rotaRetorno);
        }
    }

    public function lancaDevolucao($request)
    {
        $request->validate(['idbenspatrimoniais' => 'required']);

        $quantidadeRetorno  = (!is_null($request->quantidade_retorno)) ? $request->quantidade_retorno : 1;
        $dadosSaida         = Saidas::with('estoque')
            ->whereHas('estoque', function ($query) use ($request) {
                $query->where('idbenspatrimoniais', $request->idbenspatrimoniais);
            })
            ->where(function ($query) {
                $query->where('status', StatusEnumSaidas::NA_RUA)
                    ->orWhere('status', StatusEnumSaidas::DEVOLUCAO_PARCIAL);
            })
            ->whereNotNull('datapararetorno')
            ->get();

        $itemEstoque = Estoque::where('idbenspatrimoniais', $request->idbenspatrimoniais)->whereRaw('quantidadeinicial > quantidade')->get();
        if ($itemEstoque->isEmpty()) {
            return redirect()->route('saidas.index')->with('error', 'Não há item para devolução');
        }

        foreach ($dadosSaida as $saida) {
            foreach ($itemEstoque as $item) {

                if ($quantidadeRetorno > 0) { //62

                    $qtdAdevolverPorItem    = $item->quantidadeinicial - $item->quantidade;
                    $verificaValorDeRetorno = $quantidadeRetorno - $qtdAdevolverPorItem;

                    if ($verificaValorDeRetorno < 0) {
                        $valorNegativo = abs($verificaValorDeRetorno);
                        $qtdAdevolverPorItem = $qtdAdevolverPorItem - $valorNegativo;
                    }

                    if ($qtdAdevolverPorItem > 0) {

                        $salvaEntradas = Entradas::create([
                            'descricaoentrada'    => $request->descricaoentrada,
                            'id_estoque'          => $item->id,
                            'quantidade_entrada'  => $qtdAdevolverPorItem,
                            'dtdevolucao'         => $request->dtdevolucao,
                            'quemdevolveu'        => $request->quemdevolveu,
                            'ocorrenciadevolucao' => $request->ocorrenciadevolucao,
                            'id_saida'            => $saida->id,
                        ]);

                        
                        $lancaEstoque = DB::table('estoque')
                            ->where('id', $item->id)
                            ->update([
                                'quantidade' => \DB::raw("quantidade + $qtdAdevolverPorItem")
                            ]);
                    }
                }
                $quantidadeRetorno = $quantidadeRetorno - $qtdAdevolverPorItem;
            }
            $entradas = Entradas::where('id_saida', $saida->id)
                ->selectRaw('SUM(quantidade_entrada) as total_quantidade')
                ->first();

            if ($entradas) {
                $totalSaidasPorEntrada = $entradas->total_quantidade;                          
            } else {
                $totalSaidasPorEntrada = 0;
            }

            if (($totalSaidasPorEntrada - $saida->quantidade_saida) < 1) {
                $saida->update(['status' => StatusEnumSaidas::DEVOLVIDO]);
            } else {
                $saida->update(['status' => StatusEnumSaidas::DEVOLUCAO_PARCIAL]);
            }
        }

        if ($quantidadeRetorno > 0) {
            return redirect()->route('saidas.index')->with('error', 'Não há estoque suficiente');
        }
        return $salvaEntradas;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listaBensPatrimoniais = $this->listaBensPatrimoniais;

        $propriedadesEntradas = Entradas::where('id', $id)->with('estoque.bensPatrimoniais')->first();

        if (isset($propriedadesEntradas->dtdevolucao)) {
            $tipoEntrada = 'devolucao';
        } else {
            $tipoEntrada = 'novo';
        }

        $selectBensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais where statusbenspatrimoniais = 1 order by id');

        return view('entradas.show', compact('listaBensPatrimoniais', 'propriedadesEntradas', 'tipoEntrada', 'selectBensPatrimoniais'));
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
        $selectBensPatrimoniais = DB::select('SELECT * FROM bensPatrimoniais where statusbenspatrimoniais = 1 order by id =' . $entradas->idbenspatrimoniais . ' desc');

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
            'qtdeEntrada'           => 'required',
            // 'ativoentrada'          => 'required',
        ]);

        $entradas = Entradas::find($id);
        $entradas->descricaoentrada         = $request->input('descricaoentrada');
        $entradas->qtdeEntrada              = $request->input('qtdeEntrada');
        // $entradas->ativoentrada             = $request->input('ativoentrada');
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
