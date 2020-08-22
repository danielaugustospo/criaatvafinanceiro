<?php


namespace App\Http\Controllers;


use App\Funcionario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:funcionario-list|funcionario-create|funcionario-edit|funcionario-delete', ['only' => ['index','show']]);
         $this->middleware('permission:funcionario-create', ['only' => ['create','store']]);
         $this->middleware('permission:funcionario-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:funcionario-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Funcionario::orderBy('id','DESC')->paginate(5);
        return view('funcionarios.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $todosorgaosrg = DB::select('select * from orgaorg');
        $todososbancos =  DB::select('select distinct * from bancos');
        return view('funcionarios.create', compact('todosorgaosrg','todososbancos'));
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
            'nomeFuncionario' => 'required|min:3',
            'cpfFuncionario'  => 'required',

            'cepFuncionario' => 'required',
            'enderecoFuncionario' => 'required',
            'bairroFuncionario' => 'required',
            'cidadeFuncionario' => 'required',
            'ufFuncionario' => 'required',
            'celularFuncionario' => 'required',
            'telresidenciaFuncionario' => 'required',
            'contatoemergenciaFuncionario' => 'required',
            'emailFuncionario' => 'required',
            'redesocialFuncionario' => 'required',
            'facebookFuncionario' => 'required',
            'telegramFuncionario' => 'required',
            'rgFuncionario' => 'required',
            'orgaoRGFuncionario' => 'required',
            'expedicaoRGFuncionario' => 'required',
            'tituloFuncionario' => 'required',
            'maeFuncionario' => 'required',
            'paiFuncionario' => 'required',
            'profissaoFuncionario' => 'required',
            'cargoEmpresaFuncionario' => 'required',
            'tipocontratoFuncionario' => 'required',
            'grauescolaridadeFuncionario' => 'required',
            'descformacaoFuncionario' => 'required',
            'certficFuncionario' => 'required',
            'uncertificadoraFuncionario' => 'required',
            'anocertificacaoFuncionario' => 'required',
            'contacorrenteFuncionario' => 'required',
            'bancoFuncionario' => 'required',
            'nrcontaFuncionario' => 'required',
            'agenciaFuncionario' => 'required',
            'nomefavorecidoFuncionario' => 'required',
            'cpffavorecidoFuncionario' => 'required',
            'contacorrentefavorecidoFuncionario' => 'required',
            'bancofavorecidoFuncionario' => 'required',
            'nrcontafavorecidoFuncionario' => 'required',
            'agenciafavorecidoFuncionario' => 'required',

        ]);


        Funcionario::create($request->all());

       
        return redirect()->route('funcionarios.index')
                        ->with('success','Funcionário criado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $funcionario = Funcionario::find($id);
        return view('funcionarios.show',compact('funcionario'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcionario = Funcionario::find($id);
        $roles = Funcionario::pluck('nomeFuncionario','nomeFuncionario')->all();
        $funcionarioRole = $funcionario->roles->pluck('nomeFuncionario','nomeFuncionario')->all();

        $bancoselecionado = DB::select('select distinct * from bancos  where codigoBanco = :bancoFuncionario', ['bancoFuncionario' => $funcionario->bancoFuncionario]);
        $banconaoselecionado = DB::select('select distinct * from bancos  where codigoBanco != :bancoFuncionario', ['bancoFuncionario' => $funcionario->bancoFuncionario]);

        return view('funcionarios.edit',compact('funcionario','roles','funcionarioRole','bancoselecionado','banconaoselecionado'));

        // return view('funcionarios.edit',compact('funcionario'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


        $funcionario->update($request->all());


        return redirect()->route('funcionarios.index')
                        ->with('success','Funcionário atualizado com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Funcionario::find($id)->delete();

        return redirect()->route('funcionarios.index')
                        ->with('success','Funcionário excluído com êxito!');
    }
}
