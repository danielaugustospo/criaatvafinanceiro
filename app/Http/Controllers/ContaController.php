<?php


namespace App\Http\Controllers;


use App\Conta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


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

        $data = Conta::orderBy('id', 'DESC')->paginate(5);
        return view('contas.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function basicLaratableData()
    {
        return Laratables::recordsOf(Conta::class);
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
            'idBanco' => 'required',
            'agenciaConta'  => 'required',

            'numeroConta' => 'required',

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


        {
            $role = Role::find($id);
            // $idBancoJoinConta ='';
            // $idBancoJoinConta = Conta::join("banco", "conta.idBanco", "=", "banco.id")
            //     ->where("conta.idbanco", $id)
            //     ->get();


            $banco =
            DB::select('SELECT b.id, b.nomeBanco 
                FROM banco b
                    WHERE  b.ativoBanco = 1
                    AND b.excluidoBanco = 0
                    AND b.id = :id', ['id' => $conta->idBanco ]);

            // $banco =  DB::select('select * from banco where id = :id', ['id' => $conta->idBanco]);



            return view('contas.show', compact('conta', 'banco'));
        }
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
        $roles = Conta::pluck('numeroConta', 'numeroConta')->all();
        $contaRole = $conta->roles->pluck('numeroConta', 'numeroConta')->all();

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
            'idBanco' => 'required',
            'agenciaConta'  => 'required',

            'numeroConta' => 'required',

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
        $getContas      =  DB::select("SELECT c.id id, c.numeroConta from conta c where ativoConta = 1 and excluidoConta = 0");
        $tamanhoArrayGetContas = count($getContas);

        //SALDO DAS CONTAS
        for($i=0; $i < $tamanhoArrayGetContas; $i++){
            new Conta();
            $receitasPorConta[$i] =  DB::select("SELECT COALESCE(sum(r.valorreceita),0) as receitasTotaisPorConta, c.id as idConta, c.agenciaConta as agenciaPorConta from receita r, conta c where pagoreceita = 'S' and r.contareceita = c.id and c.id = :idConta GROUP BY idConta, agenciaConta", ['idConta' => $getContas[$i]->id]);
            $propridadesDasContas = $receitasPorConta[$i][0];
            $dadosConta[$i] = [ $propridadesDasContas->agenciaPorConta,number_format($propridadesDasContas->receitasTotaisPorConta, 2, ',', '.')];
        }

        //CONTAS A RECEBER
        for($i=0; $i < $tamanhoArrayGetContas; $i++){
            new Conta();
            $receitasPendentesPorConta[$i] =  DB::select("SELECT COALESCE(sum(r.valorreceita),0) as receitasPendentesPorConta, c.id as idConta, c.agenciaConta as agenciaPorConta from receita r, conta c where pagoreceita = 'N' and r.contareceita = c.id and c.id = :idConta GROUP BY idConta, agenciaConta", ['idConta' => $getContas[$i]->id]);
            $propridadesDasContasAReceber = $receitasPendentesPorConta[$i];
            $tamanhoArrayReceitasPendetes = count($propridadesDasContasAReceber);


            if ($tamanhoArrayReceitasPendetes == 0){$propridadesDasContasAReceber[$i] = 0.00; $dadosContaAReceber[$i] = 0.00;}
            else{ 
                $propridadesDasContasAReceber = $receitasPendentesPorConta[$i][0];
                $dadosContaAReceber[$i] = [ $propridadesDasContasAReceber->agenciaPorConta,number_format($propridadesDasContasAReceber->receitasPendentesPorConta, 2, ',', '.')];
            }
        }

        //CONTAS A PAGAR
        for($i=0; $i < $tamanhoArrayGetContas; $i++){
            new Conta();
            $despesasPendentesPorConta[$i] =  DB::select("SELECT COALESCE(sum(d.precoreal),0) as despesasPendentesPorConta, c.id as idConta, c.agenciaConta as agenciaPorConta from despesas d, conta c where d.pago = 'N' and d.conta = c.id and c.id = :idConta GROUP BY idConta, agenciaConta", ['idConta' => $getContas[$i]->id]);
            $propridadesDasContasAPagar = $despesasPendentesPorConta[$i];
            $tamanhoArrayDespesasPendetes = count($propridadesDasContasAPagar);


            if ($tamanhoArrayDespesasPendetes == 0){$propridadesDasContasAPagar[$i] = 0.00; $dadosContaAPagar[$i] = 0.00;}
            else{ 
                $propridadesDasContasAPagar = $despesasPendentesPorConta[$i][0];
                $dadosContaAPagar[$i] = [ $propridadesDasContasAPagar->agenciaPorConta,number_format($propridadesDasContasAPagar->despesasPendentesPorConta, 2, ',', '.')];
            }
        }

        $tamanhoArrayReceita = count($receitasTotais);
        if ($tamanhoArrayReceita == 0){$getArrayTotalReceitas = 0.00;}  else{ $getArrayTotalReceitas = $receitasTotais[0]->receitasTotais; }

        $tamanhoArrayDespesa = count($despesasTotais);
        if ($tamanhoArrayDespesa == 0){$getArrayTotalDespesa = 0.00;}   else{ $getArrayTotalDespesa = $despesasTotais[0]->despesasTotais; }


        bcscale(2);
        $saldo = bcsub($getArrayTotalReceitas, $getArrayTotalDespesa);
        $saldo = number_format($saldo, 2, ',', '.');

        $contasAtuais =  DB::select("select id, numeroConta from conta c where ativoConta = 1 and excluidoConta = 0");


        $data = Conta::orderBy('id', 'DESC')->paginate(5);

        return view('contacorrente.resumofinanceiro', compact('data', 'saldo','contasAtuais','dadosConta','dadosContaAReceber','dadosContaAPagar'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

        

    }
}
