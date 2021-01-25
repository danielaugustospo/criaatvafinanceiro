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
        $data = Conta::orderBy('id', 'DESC')->paginate(5);
        return view('contacorrente.resumofinanceiro', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }
}
