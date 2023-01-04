<?php


namespace App\Http\Controllers;


use App\Clientes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;

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
    
         $this->acao =  request()->segment(count(request()->segments()));
         $this->valorInput = null;
         $this->valorSemCadastro = null;
 
         if ($this->acao == 'create'){
             $this->valorInput = "";
             $this->valorSemCadastro = "0";
             $this->variavelReadOnlyNaView = "";        
             $this->variavelDisabledNaView = "";
   
         } 
         elseif ($this->acao == 'edit'){
             $this->variavelReadOnlyNaView = "";        
             $this->variavelDisabledNaView = "";
   
         } 
         elseif ($this->acao != 'edit' && $this->acao != 'create'){
             $this->variavelReadOnlyNaView = "readonly";        
             $this->variavelDisabledNaView = 'disabled';
 
         }
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

        $data = Clientes::latest()->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                $id = $request->get('id');
                $nomeCliente = $request->get('nomeCliente');
                $razaosocialCliente = $request->get('razaosocialCliente');
                $cnpjCliente = $request->get('cnpjCliente');
                $contatoCliente = $request->get('contatoCliente');
                $telefone1Cliente = $request->get('telefone1Cliente');
                if (!empty($id)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['id'], $request->get('id')) ? true : false;
                    });
                }
                if (!empty($nomeCliente)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['nomeCliente'], $request->get('nomeCliente')) ? true : false;
                    });
                }
                if (!empty($razaosocialCliente)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['razaosocialCliente'], $request->get('razaosocialCliente')) ? true : false;
                    });
                }
                if (!empty($cnpjCliente)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['cnpjCliente'], $request->get('cnpjCliente')) ? true : false;
                    });
                }
                if (!empty($contatoCliente)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['contatoCliente'], $request->get('contatoCliente')) ? true : false;
                    });
                }
                if (!empty($telefone1Cliente)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::is($row['telefone1Cliente'], $request->get('telefone1Cliente')) ? true : false;
                    });
                }


                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                        if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['nomeCliente']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['razaosocialCliente']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['cnpjCliente']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['contatoCliente']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::is(Str::lower($row['telefone1Cliente']), Str::lower($request->get('search')))) {
                            return true;
                        } 

                        return false;
                    });
                }
            })
            ->addColumn('action', function ($row) {

                $btnVisualizar = '<a href="clientes/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>
                                <a href="clientes/' . $row['id'] . '/edit" class="edit btn btn-secondary btn-sm">Editar</a>';
                return $btnVisualizar;
            })
            ->rawColumns(['action'])
            ->make(true);
    } else {
        

        $data = Clientes::orderBy('id','DESC')->paginate(5);
        return view('clientes.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}

    public function listaClientes()
    {
        return Clientes::all();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $todososbancos1 =  DB::select('select distinct * from banco where ativoBanco = 1;');
        $todososbancos2 =  $todososbancos1;
        $todososbancos3 =  $todososbancos1;
        
        $precoReal = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;


        return view('clientes.create', compact('todososbancos1','todososbancos2','todososbancos3','precoReal','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));
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
            // 'nomeCliente'                       => 'required',
            // 'contatoCliente'                    => 'required',
            'razaosocialCliente'                => 'required',
            // 'siteCliente'                       => 'required',
            // 'cepCliente'                        => 'required',
            // 'enderecoCliente'                   => 'required',
            // 'bairroCliente'                     => 'required',
            // 'cidadeCliente'                     => 'required',
            // 'estadoCliente'                     => 'required',
            // 'telefone1Cliente'                  => 'required',
            // 'telefone2Cliente'                  => 'required',
            // 'cnpjCliente'                       => 'required',
            // 'inscEstadualCliente'               => 'required',
            // 'cpfCliente'                        => 'required',
            // 'identidadeCliente'                 => 'required',
            // 'emailCliente'                      => 'required',
            // 'dataCadastroCliente'               => 'required',
            // 'bancoCliente'                      => 'required',
            // 'nrcontaCliente'                    => 'required',
            // 'agenciaCliente'                    => 'required',
            // 'bancoFavorecidoCliente'            => 'required',
            // 'nomefavorecidoCliente'             => 'required',
            // 'cpffavorecidoCliente'              => 'required',
            // 'contacorrentefavorecidoCliente'    => 'required',
            // 'nrcontafavorecidoCliente'          => 'required',
            // 'agenciafavorecidoCliente'          => 'required',
            // 'ativoCliente'                      => 'required',
            // 'excluidoCliente'                   => 'required',
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
        $todososbancos1 =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoCliente1]);
        $todososbancos2 =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoCliente2]);
        $todososbancos3 =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoCliente3]);
        $todososbancosFavorecidoCliente =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoFavorecidoCliente]);

        $precoReal = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('clientes.show',compact('cliente','todososbancos1', 'todososbancos2', 'todososbancos3', 'todososbancosFavorecidoCliente', 'valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));
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
        $todososbancos1 =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoCliente1]);
        $todososbancos2 =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoCliente2]);
        $todososbancos3 =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoCliente3]);
        $todososbancosFavorecidoCliente =  DB::select('select distinct * from banco where ativoBanco = 1 order by id = :idbancoSelecionado desc',['idbancoSelecionado' => $cliente->bancoFavorecidoCliente]);

        $precoReal = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('clientes.edit',compact('cliente','roles','clienteRole','todososbancos1', 'todososbancos2', 'todososbancos3','todososbancosFavorecidoCliente', 'valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));

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

            // 'nomeCliente'                       => 'required',
            // 'contatoCliente'                    => 'required',
            'razaosocialCliente'                   => 'required',
            // 'siteCliente'                       => 'required',
            // 'cepCliente'                        => 'required',
            // 'enderecoCliente'                   => 'required',
            // 'bairroCliente'                     => 'required',
            // 'cidadeCliente'                     => 'required',
            // 'estadoCliente'                     => 'required',
            // 'telefone1Cliente'                  => 'required',
            // 'telefone2Cliente'                  => 'required',
            // 'cnpjCliente'                       => 'required',
            // 'inscEstadualCliente'               => 'required',
            // 'cpfCliente'                        => 'required',
            // 'identidadeCliente'                 => 'required',
            // 'emailCliente'                      => 'required',
            // 'dataCadastroCliente'               => 'required',
            // 'bancoCliente'                      => 'required',
            // 'nrcontaCliente'                    => 'required',
            // 'agenciaCliente'                    => 'required',
            // 'bancoFavorecidoCliente'            => 'required',
            // 'nomefavorecidoCliente'             => 'required',
            // 'cpffavorecidoCliente'              => 'required',
            // 'contacorrentefavorecidoCliente'    => 'required',
            // 'nrcontafavorecidoCliente'          => 'required',
            // 'agenciafavorecidoCliente'          => 'required',
            // 'ativoCliente'                      => 'required',
            // 'excluidoCliente'                   => 'required',
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
