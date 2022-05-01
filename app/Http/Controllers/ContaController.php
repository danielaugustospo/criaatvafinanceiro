<?php


namespace App\Http\Controllers;


use App\Conta;
use App\Despesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Receita;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Label;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:conta-list|conta-create|conta-edit|conta-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:conta-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:conta-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:conta-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Conta::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $nomeConta = $request->get('nomeConta');
                    $apelidoConta = $request->get('apelidoConta');
                    $idBanco = $request->get('idBanco');
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($nomeConta)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['nomeConta'], $request->get('nomeConta')) ? true : false;
                        });
                    }
                    if (!empty($apelidoConta)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['apelidoConta'], $request->get('apelidoConta')) ? true : false;
                        });
                    }
                    if (!empty($idBanco)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idBanco'], $request->get('idBanco')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['nomeConta']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['apelidoConta']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idBanco']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="contas/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = Conta::orderBy('id', 'DESC')->paginate(5);
            return view('contas.index', compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $banco =  DB::select('select * from banco order by id');
        // $banco = Banco::show($request->all());

        // var_dump($banco);

        return view('contas.create', compact('banco'));
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
            // 'idBanco' => 'required',
            'apelidoConta'  => 'required',

            'nomeConta' => 'required',

        ]);


        Conta::create($request->all());


        return redirect()->route('contas.index')
            ->with('success', 'Conta cadastrada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conta = Conta::find($id);
        // return view('contas.show',compact('conta'));


        // $role = Role::find($id);
        // $idBancoJoinConta ='';
        // $idBancoJoinConta = Conta::join("banco", "conta.idBanco", "=", "banco.id")
        //     ->where("conta.idbanco", $id)
        //     ->get();


        // $banco =
        //     DB::select('SELECT id, nomeBanco 
        //     FROM banco
        //         WHERE  ativoBanco = 1
        //         AND (excluidoBanco = 0)
        //         AND (id = :idBanco', ['idBanco' => $conta->idBanco]);

        $banco =  DB::select('select * from banco where id = :id', ['id' => $conta->idBanco]);


        // $banco =  DB::select('select * from banco where id = :id', ['id' => $conta->idBanco]);

        return view('contas.show', compact('conta', 'banco'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $conta = Conta::find($id);
        $roles = Conta::pluck('nomeConta', 'nomeConta')->all();
        $contaRole = $conta->roles->pluck('nomeConta', 'nomeConta')->all();

        $banco =  DB::select('select * from banco where id = :id', ['id' => $conta->idBanco]);
        $todososbancos =  DB::select('select * from banco where ativoBanco = 1 order by id = :bancoConta desc', ['bancoConta' => $conta->idBanco]);

        return view('contas.edit', compact('conta', 'roles', 'contaRole', 'banco', 'todososbancos'));

        // return view('contas.edit',compact('conta'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conta $conta)
    {
        $request->validate([
            // 'idBanco' => 'required',
            'apelidoConta'  => 'required',

            'nomeConta' => 'required',

        ]);


        $conta->update($request->all());


        return redirect()->route('contas.index')
            ->with('success', 'Conta atualizada com successo');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Conta::find($id)->delete();

        return redirect()->route('contas.index')
            ->with('success', 'Conta excluída com êxito!');
    }

    public function resumoFinanceiro(Request $request)
    {
        $receitasTotais =  DB::select("SELECT COALESCE(sum(r.valorreceita),0) as receitasTotais from receita r where pagoreceita = 'S'");
        $despesasTotais =  DB::select("SELECT COALESCE(sum(d.precoreal),0) as despesasTotais from despesas d where pago = 'S'");
        $getContas      =  DB::select("SELECT c.id id, c.nomeConta from conta c where ativoConta = 1 and excluidoConta = 0");
        $receitasPendentesPorConta =  DB::select("SELECT COALESCE(sum(r.valorreceita),0) as receitasPendentesPorConta, c.id as idConta, c.apelidoConta as agenciaPorConta from receita r, conta c where pagoreceita = 'N' and r.contareceita = c.id GROUP BY idConta, apelidoConta");

        $tamanhoArrayReceitasPendentes = count($receitasPendentesPorConta);
        $qtdReceitasPend = $tamanhoArrayReceitasPendentes;
        $tamanhoArrayGetContas = count($getContas);
        $dadosContaAReceber[0] = 0.00;
        $dadosContaAReceber[1] = 0.00;

        $dadosContaAPagar[0] = 0.00;
        $dadosContaAPagar[1] = 0.00;

        for($i=0; $i < $tamanhoArrayGetContas; $i++){
            new Conta();
            $receitasPorConta[$i] =  DB::select("SELECT COALESCE(sum(r.valorreceita),0) as receitasTotaisPorConta, c.id as idConta, c.apelidoConta as agenciaPorConta from receita r, conta c where pagoreceita = 'S' and r.contareceita = c.id and c.id = :idConta GROUP BY idConta, apelidoConta", ['idConta' => $getContas[$i]->id]);
            $propridadesDasContas[$i] = $receitasPorConta[$i];
            if ((sizeof($propridadesDasContas[$i]) != 0) || (sizeof($propridadesDasContas[$i]) != null)){
                $dadosConta[$i] = [ $propridadesDasContas[$i][0]->agenciaPorConta,number_format($propridadesDasContas[$i][0]->receitasTotaisPorConta, 2, ',', '.')];
            }
        }
        // var_dump($propridadesDasContas[1][0]);
        // exit;
        // $dadosContaAReceber[0] = 4.0;
        //SALDO DAS CONTAS
        // for ($i = 0; $i < $tamanhoArrayGetContas; $i++) {
        //     new Conta();
        //     $receitasPorConta[$i] =  DB::select("SELECT COALESCE(sum(r.valorreceita),0) as receitasTotaisPorConta, c.id as idConta, c.apelidoConta as agenciaPorConta from receita r, conta c where pagoreceita = 'S' and r.contareceita = c.id and c.id = :idConta GROUP BY idConta, apelidoConta", ['idConta' => $getContas[$i]->id]);
        //     $propridadesDasContas[$i] = $receitasPorConta[$i];


        //     if ((sizeOf($receitasPorConta[$i]) == 0) || (sizeOf($receitasPorConta[$i]) == null)) {
        //         // var_dump($receitasPorConta[$i]);
        //         // exit;
        //         $propridadesDasContas[$i]->receitasTotaisPorConta = 0.00;
        //         $propridadesDasContas[$i]->agenciaPorConta = 0;
        //         $dadosConta[$i] = 0.00;
               

        //     }
        //     else{

        //         var_dump($propridadesDasContas[$i]);
               
        //         // $propridadesDasContas[$i]->receitasTotaisPorConta  = $receitasPorConta[$i]->receitasTotaisPorConta;
        //         // $propridadesDasContas[$i]->agenciaPorConta = $receitasPorConta[$i]->agenciaPorConta;
        //         // $dadosConta[$i] = 0.00;

        //     } 
        //         // $propridadesDasContas = $receitasPorConta[$i];
        //         // $dadosConta[$i] = [$propridadesDasContas[$i]->agenciaPorConta, number_format($propridadesDasContas[$i]->receitasTotaisPorConta, 2, ',', '.')];
        //     // 
        //     // $propridadesDasContas[$i]->agenciaPorConta = $receitasPendentesPorConta[$i]->agenciaPorConta;
        //     // $propridadesDasContas[$i]->receitasPendentesPorConta =  number_format($propridadesDasContasAReceber[$i]->receitasPendentesPorConta, 2, ',', '.');
        // }
        // exit;

        // var_dump($propridadesDasContas);
        // exit;

        if ($tamanhoArrayGetContas == 0) {
            $receitasPorConta[0] =  0;
            $receitasPorConta[1] =  0;
            $propridadesDasContas[0] = $receitasPorConta[0];
            $propridadesDasContas[1] = $receitasPorConta[1];
            $dadosConta[$i] = [$propridadesDasContas[0], $propridadesDasContas[1]];
        }

        // if ($tamanhoArrayGetContas = 0){
        //     $tamanhoArrayGetContas = -5;
        // }

        //CONTAS A RECEBER
        for ($i = 0; $i < $tamanhoArrayReceitasPendentes; $i++) {
            new Conta();
            $propridadesDasContasAReceber = $receitasPendentesPorConta;


            if (($tamanhoArrayReceitasPendentes == 0) || ($tamanhoArrayReceitasPendentes = null)) {
                $propridadesDasContasAReceber[$i] = 0.00;
                $dadosContaAReceber[$i] = 0.00;
                // $dadosContaAReceber[0] = 0.00;
                // $dadosContaAReceber[1] = 0.00;

            }
            $propridadesDasContasAReceber[$i]->agenciaPorConta = $receitasPendentesPorConta[$i]->agenciaPorConta;
            $propridadesDasContasAReceber[$i]->receitasPendentesPorConta =  number_format($propridadesDasContasAReceber[$i]->receitasPendentesPorConta, 2, ',', '.');


            // $dadosContaAReceber = [$propridadesDasContasAReceber[$i]->agenciaPorConta, $propridadesDasContasAReceber[$i]->receitasPendentesPorConta];
            $dadosContaAReceber = $propridadesDasContasAReceber;
        }

        // var_dump($propridadesDasContasAReceber);

        //CONTAS A PAGAR
        for ($i = 0; $i < $tamanhoArrayGetContas; $i++) {
            new Conta();
            $despesasPendentesPorConta[$i] =  DB::select("SELECT COALESCE(sum(d.precoreal),0) as despesasPendentesPorConta, c.id as idConta, c.apelidoConta as agenciaPorConta from despesas d, conta c where d.pago = 'N' and d.conta = c.id and c.id = :idConta GROUP BY idConta, apelidoConta", ['idConta' => $getContas[$i]->id]);
            $propridadesDasContasAPagar = $despesasPendentesPorConta[$i];
            $tamanhoArrayDespesasPendetes = count($propridadesDasContasAPagar);


            if ($tamanhoArrayDespesasPendetes == 0) {
                $propridadesDasContasAPagar[$i] = 0.00;
                $dadosContaAPagar[$i] = 0.00;
            } else {
                $propridadesDasContasAPagar = $despesasPendentesPorConta[$i][0];
                $dadosContaAPagar[$i] = [$propridadesDasContasAPagar->agenciaPorConta, number_format($propridadesDasContasAPagar->despesasPendentesPorConta, 2, ',', '.')];
            }
        }

        $tamanhoArrayReceita = count($receitasTotais);
        if ($tamanhoArrayReceita == 0) {
            $getArrayTotalReceitas = 0.00;
        } else {
            $getArrayTotalReceitas = $receitasTotais[0]->receitasTotais;
        }

        $tamanhoArrayDespesa = count($despesasTotais);
        if ($tamanhoArrayDespesa == 0) {
            $getArrayTotalDespesa = 0.00;
        } else {
            $getArrayTotalDespesa = $despesasTotais[0]->despesasTotais;
        }


        bcscale(2);
        $saldo = bcsub($getArrayTotalReceitas, $getArrayTotalDespesa);
        $saldo = number_format($saldo, 2, ',', '.');

        $contasAtuais =  DB::select("select id, nomeConta from conta c where ativoConta = 1 and excluidoConta = 0");


        $data = Conta::orderBy('id', 'DESC')->paginate(5);

        return view('contacorrente.resumofinanceiro', compact('data', 'saldo', 'contasAtuais', 'dadosConta', 'dadosContaAReceber', 'dadosContaAPagar', 'qtdReceitasPend'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tabelaContasAReceber(Request $request)
    {

        $posts = DB::table('receita')

            ->join('conta', 'contareceita', 'conta.id')
            ->join('ordemdeservico', 'idosreceita', 'ordemdeservico.id')
            ->join('clientes', 'ordemdeservico.idClienteOrdemdeServico', 'clientes.id')

            ->select([
                'receita.datapagamentoreceita as vencimento', 'receita.idosreceita as idOS', 'receita.nfreceita as notaFiscal', 'receita.valorreceita as preco',
                'clientes.nomeCliente as nomeCliente',
                'ordemdeservico.eventoOrdemdeServico as evento',
                'conta.apelidoConta as agencia'
            ])

            ->where('receita.pagoreceita', '=', 'N');

        return Datatables::of($posts)
            ->filter(function ($query) use ($request) {
                if ($request->has('buscaData')) {
                    $query->where('datapagamentoreceita', 'like', "%{$request->get('buscaData')}%");
                }

                if ($request->has('buscaOS')) {
                    $query->where('idosreceita', 'like', "%{$request->get('buscaOS')}%");
                }

                if ($request->has('buscaCliente')) {
                    $query->where('nomeCliente', 'like', "%{$request->get('buscaCliente')}%");
                }
                if ($request->has('buscaEvento')) {
                    $query->where('eventoOrdemdeServico', 'like', "%{$request->get('buscaEvento')}%");
                }

                if ($request->has('buscaValor')) {
                    $query->where('valorreceita', 'like', "%{$request->get('buscaValor')}%");
                }
                if ($request->has('buscaConta')) {
                    $query->where('apelidoConta', 'like', "%{$request->get('buscaConta')}%");
                }
                if ($request->has('buscaNF')) {
                    $query->where('nfreceita', 'like', "%{$request->get('buscaNF')}%");
                }
                if (($request->buscaDataInicio != null) && ($request->buscaDataFim != null)) {
                    $query->whereDate('datapagamentoreceita', ">", "{$request->buscaDataInicio}")
                        ->whereDate('datapagamentoreceita', "<", "{$request->buscaDataFim}");
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function tabelaContasAPagar(Request $request)
    {
        $contasAPagar = DB::table('despesas')

            ->join('conta', 'despesas.conta', 'conta.id')
            ->join('ordemdeservico', 'idOS', 'ordemdeservico.id')
            ->join('clientes', 'ordemdeservico.idClienteOrdemdeServico', 'clientes.id')

            ->select([
                'despesas.vencimento', 'despesas.idOS', 'despesas.notaFiscal', 'despesas.precoReal',
                'clientes.nomeCliente',
                'ordemdeservico.eventoOrdemdeServico',
                'conta.apelidoConta'
            ])

            ->where('despesas.pago', '=', 'N');


        return Datatables::of($contasAPagar)
            ->filter(function ($query) use ($request) {
                if ($request->has('buscaData')) {
                    $query->where('vencimento', 'like', "%{$request->get('buscaData')}%");
                }

                if ($request->has('buscaOS')) {
                    $query->where('idOS', 'like', "%{$request->get('buscaOS')}%");
                }

                if ($request->has('buscaCliente')) {
                    $query->where('nomeCliente', 'like', "%{$request->get('buscaCliente')}%");
                }
                if ($request->has('buscaEvento')) {
                    $query->where('eventoOrdemdeServico', 'like', "%{$request->get('buscaEvento')}%");
                }

                if ($request->has('buscaValor')) {
                    $query->where('precoReal', 'like', "%{$request->get('buscaValor')}%");
                }
                if ($request->has('buscaConta')) {
                    $query->where('apelidoConta', 'like', "%{$request->get('buscaConta')}%");
                }
                if ($request->has('buscaNF')) {
                    $query->where('notaFiscal', 'like', "%{$request->get('buscaNF')}%");
                }
                if (($request->buscaDataInicio != null) && ($request->buscaDataFim != null)) {
                    $query->whereDate('vencimento', ">", "{$request->buscaDataInicio}")
                        ->whereDate('vencimento', "<", "{$request->buscaDataFim}");
                }
            })
            ->addIndexColumn()
            ->make(true);
    }





    public function contasAReceber(Request $request)
    {
        if ($request->ajax()) {

            $data = Conta::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $nomeConta = $request->get('nomeConta');
                    $apelidoConta = $request->get('apelidoConta');
                    $idBanco = $request->get('idBanco');
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($nomeConta)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['nomeConta'], $request->get('nomeConta')) ? true : false;
                        });
                    }
                    if (!empty($apelidoConta)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['apelidoConta'], $request->get('apelidoConta')) ? true : false;
                        });
                    }
                    if (!empty($idBanco)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idBanco'], $request->get('idBanco')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['nomeConta']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['apelidoConta']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idBanco']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="contasAReceber/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = Conta::orderBy('id', 'DESC')->paginate(5);
            return view('contacorrente.contasAReceber', compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }

    public function contasAPagar(Request $request)
    {
        if ($request->ajax()) {

            $data = Conta::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $nomeConta = $request->get('nomeConta');
                    $apelidoConta = $request->get('apelidoConta');
                    $idBanco = $request->get('idBanco');
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($nomeConta)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['nomeConta'], $request->get('nomeConta')) ? true : false;
                        });
                    }
                    if (!empty($apelidoConta)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['apelidoConta'], $request->get('apelidoConta')) ? true : false;
                        });
                    }
                    if (!empty($idBanco)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idBanco'], $request->get('idBanco')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['nomeConta']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['apelidoConta']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idBanco']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="contasAPagar/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = Conta::orderBy('id', 'DESC')->paginate(5);
            return view('contacorrente.contasAPagar', compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }
    public function extratoConta(Request $request)
    {
        // $consulta = $this->consultaExtratoConta();
        $contaSelecionada = $request->get('conta');
        $datainicial = $request->get('datainicial');
        $datafinal = $request->get('datafinal');

        $modelConta = new Conta();

        $complemento = "WHERE idconta ='".$contaSelecionada."' and dtoperacao  BETWEEN '".$datainicial."' AND '".$datafinal."'";
        $stringQueryExtratoConta = $modelConta->dadosRelatorio(null, $complemento);
        $extrato = DB::select($stringQueryExtratoConta);

        $tamExtrato = sizeof($extrato);
        if($tamExtrato > 0 && $tamExtrato != null){
            $tamExtrato = $tamExtrato - 1;
    
            $conta   = $extrato[0]->conta;
                       
            $saldoFinal     = $extrato[$tamExtrato]->saldo;
            $saldoInicial   = $extrato[0]->saldo - $extrato[0]->valorreceita;

        }
        else{
            $conta   = 'Indefinido';
            $saldoInicial   = 0;
            $saldoFinal     = 0;
        }

        return view('contacorrente.extratoConta', compact('contaSelecionada','datainicial','datafinal','conta','saldoInicial','saldoFinal'));
    }

    public function tabelaExtratoConta(Request $request)
    {

        $consulta = $this->consultaExtratoConta();
        

        return Datatables::of($consulta)
            ->filter(function ($query) use ($request) {

                $buscaData = $request->get('buscaData');

                if ($request->has('buscaData')) {
                    // $query->where('datapagamentoreceita', "{$request->get('buscaData')}");
                    $query->where('datapagamentoreceita', 'like', "%{$buscaData}%");
                }

                if ($request->has('buscaOS')) {
                    $query->where('idosreceita', 'like', "%{$request->get('buscaOS')}%");
                }

                if ($request->has('buscaValor')) {
                    $query->where('valorreceita', 'like', "%{$request->get('buscaValor')}%");
                }

                if ($request->has('buscaConta')) {
                    $query->where('apelidoConta', 'like', "%{$request->get('buscaConta')}%");
                }

                if (($request->buscaDataInicio != null) && ($request->buscaDataFim != null)) {
                    $query->whereDate('datapagamentoreceita', ">", "{$request->buscaDataInicio}")
                        ->whereDate('datapagamentoreceita', "<", "{$request->buscaDataFim}");
                }
            })

            ->addIndexColumn()
            ->make(true);
    }

    public function consultaExtratoConta()
    {

        $tabelaDespesas = DB::table('despesas')
            ->join('conta', 'despesas.conta', 'conta.id')

            ->select(['despesas.id', 'despesas.vencimento', 'conta.apelidoConta', 'despesas.precoReal', 'despesas.descricaoDespesa', 'despesas.idOS', 'despesas.pago as pagoreceita']);
        // ->where('despesas.pago', '=', "S");

        $tabelaReceitas = DB::table('receita')
            ->join('conta', 'receita.contareceita', 'conta.id')

            ->select(['receita.id', 'receita.datapagamentoreceita', 'conta.apelidoConta', 'receita.valorreceita', 'receita.descricaoReceita', 'receita.idosreceita', 'receita.pagoreceita'])
            // ->where('receita.pagoreceita', '=', "S")
            ->unionAll($tabelaDespesas);
        // ->get();

        $consulta = DB::table(DB::raw("({$tabelaReceitas->toSql()}) as x"))
            ->select(['id', 'datapagamentoreceita', 'apelidoConta', 'valorreceita', 'descricaoReceita', 'idosreceita', 'pagoreceita'])
            ->where(function ($consulta) {
                $consulta->where('pagoreceita', '=', 'S')
                    ->orWhere('pagoreceita', '=', '1');
            });
        return $consulta;
    }


}
