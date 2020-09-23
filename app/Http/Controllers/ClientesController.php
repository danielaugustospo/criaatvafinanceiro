<?php


namespace App\Http\Controllers;


use App\Clientes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:cliente-list|cliente-create|cliente-edit|cliente-delete', ['only' => ['index','show']]);
         $this->middleware('permission:cliente-create', ['only' => ['create','store']]);
         $this->middleware('permission:cliente-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:cliente-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $listaClientes = Clientes::orderBy('id','DESC')->paginate(5);
        return view('clientes.index',compact('listaClientes'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $todososbancos =  DB::select('select distinct * from banco where ativoBanco = 1;');

        return view('clientes.create', compact('todososbancos'));
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
            'nomeCliente'                       => 'required',
            'contatoCliente'                    => 'required',
            'razaosocialCliente'                => 'required',
            'siteCliente'                       => 'required',
            'cepCliente'                        => 'required',
            'enderecoCliente'                   => 'required',
            'bairroCliente'                     => 'required',
            'cidadeCliente'                     => 'required',
            'estadoCliente'                     => 'required',
            'telefone1Cliente'                  => 'required',
            'telefone2Cliente'                  => 'required',
            'cnpjCliente'                       => 'required',
            'inscEstadualCliente'               => 'required',
            'cpfCliente'                        => 'required',
            'identidadeCliente'                 => 'required',
            'emailCliente'                      => 'required',
            'dataCadastroCliente'               => 'required',
            'bancoCliente'                      => 'required',
            'nrcontaCliente'                    => 'required',
            'agenciaCliente'                    => 'required',
            'bancoFavorecidoCliente'            => 'required',
            'nomefavorecidoCliente'             => 'required',
            'cpffavorecidoCliente'              => 'required',
            'contacorrentefavorecidoCliente'    => 'required',
            // 'nrcontafavorecidoCliente'          => 'required',
            'agenciafavorecidoCliente'          => 'required',
            'ativoCliente'                      => 'required',
            'excluidoCliente'                   => 'required',
        ]);


        Clientes::create($request->all());


        return redirect()->route('clientes.index')
                        ->with('success','Cliente cadastrado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Clientes  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Clientes::find($id);
        $todososbancosCliente =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoCliente]);
        $todososbancosFavorecidoCliente =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoFavorecidoCliente]);

        return view('clientes.show',compact('cliente','todososbancosCliente','todososbancosFavorecidoCliente'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clientes  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Clientes::find($id);
        $roles = Clientes::pluck('nomeCliente','nomeCliente')->all();
        $clienteRole = $cliente->roles->pluck('nomeCliente','nomeCliente')->all();
        $todososbancosCliente =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoCliente]);
        $todososbancosFavorecidoCliente =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoFavorecidoCliente]);


        return view('clientes.edit',compact('cliente','roles','clienteRole','todososbancosCliente','todososbancosFavorecidoCliente'));

        // return view('clientes.edit',compact('cliente'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $cliente)
    {
         request()->validate([

            'nomeCliente'                       => 'required',
            'contatoCliente'                    => 'required',
            'razaosocialCliente'                => 'required',
            'siteCliente'                       => 'required',
            'cepCliente'                        => 'required',
            'enderecoCliente'                   => 'required',
            'bairroCliente'                     => 'required',
            'cidadeCliente'                     => 'required',
            'estadoCliente'                     => 'required',
            'telefone1Cliente'                  => 'required',
            'telefone2Cliente'                  => 'required',
            'cnpjCliente'                       => 'required',
            'inscEstadualCliente'               => 'required',
            'cpfCliente'                        => 'required',
            'identidadeCliente'                 => 'required',
            'emailCliente'                      => 'required',
            'dataCadastroCliente'               => 'required',
            'bancoCliente'                      => 'required',
            'nrcontaCliente'                    => 'required',
            'agenciaCliente'                    => 'required',
            'bancoFavorecidoCliente'            => 'required',
            'nomefavorecidoCliente'             => 'required',
            'cpffavorecidoCliente'              => 'required',
            'contacorrentefavorecidoCliente'    => 'required',
            // 'nrcontafavorecidoCliente'          => 'required',
            'agenciafavorecidoCliente'          => 'required',
            'ativoCliente'                      => 'required',
            'excluidoCliente'                   => 'required',
        ]);


        $cliente->update($request->all());


        return redirect()->route('clientes.index')
                        ->with('success','Cliente atualizado com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Clientes::find($id)->delete();

        return redirect()->route('clientes.index')
                        ->with('success','Cliente excluído com êxito!');
    }
}
