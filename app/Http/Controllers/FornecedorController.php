<?php


namespace App\Http\Controllers;


use App\Fornecedores;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:fornecedor-list|fornecedor-create|fornecedor-edit|fornecedor-delete', ['only' => ['index','show']]);
         $this->middleware('permission:fornecedor-create', ['only' => ['create','store']]);
         $this->middleware('permission:fornecedor-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:fornecedor-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $listaFornecedores = Fornecedores::orderBy('id','DESC')->paginate(5);
        return view('fornecedores.index',compact('listaFornecedores'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function basicLaratableData()
    {
        return Laratables::recordsOf(Fornecedores::class);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $todososbancos =  DB::select('select distinct * from banco');

        return view('fornecedores.create', compact('todososbancos'));
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

            'nomeFornecedor'          => 'required|min:1',
            'contatoFornecedor'       => 'required|min:1',
            'razaosocialFornecedor'   => 'required|min:1',
            'siteFornecedor'          => 'required|min:1',
            'cepFornecedor'           => 'required|min:1',
            'enderecoFornecedor'      => 'required|min:1',
            'bairroFornecedor'        => 'required|min:1',
            'cidadeFornecedor'        => 'required|min:1',
            'estadoFornecedor'        => 'required|min:1',
            'telefone1Fornecedor'     => 'required|min:1',
            'telefone2Fornecedor'     => 'required|min:1',
            'cnpjFornecedor'          => 'required|min:1|cnpj',
            'inscEstadualFornecedor'  => 'required|min:1',
            'cpfFornecedor'           => 'required|min:1|cpf|unique:fornecedores',
            'identidadeFornecedor'    => 'required|min:1',
            'emailFornecedor'         => 'required|min:5',
            'dataCadastroFornecedor'  => 'required|min:1',
            'bancoFornecedor'         => 'required|min:1',
            'nrcontaFornecedor'       => 'required|min:1',
            'agenciaFornecedor'       => 'required|min:1',
            'chavePix1Fornecedor'     => 'required|min:1',
            'chavePix2Fornecedor'     => 'required|min:1',
            'chavePix3Fornecedor'     => 'required|min:1',
            'chavePix4Fornecedor'     => 'required|min:1',

            'ativoFornecedor' => 'required|min:1',
            'excluidoFornecedor' => 'required|min:1',

        ]);



        Fornecedores::create($request->all());


        return redirect()->route('fornecedores.index')
                        ->with('success','Fornecedor cadastrado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Fornecedores  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fornecedor = Fornecedores::find($id);
        $todososbancos = DB::select('select * from banco order by id = :idBancoFornecedor asc', ['idBancoFornecedor' => $fornecedor->bancoFornecedor]);

        return view('fornecedores.show',compact('fornecedor','todososbancos'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fornecedores  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fornecedor = Fornecedores::find($id);

        $todososbancos = DB::select('select * from banco order by id = :idBancoFornecedor desc', ['idBancoFornecedor' => $fornecedor->bancoFornecedor]);
        // $roles = Fornecedores::pluck('nomeFornecedor','nomeFornecedor')->all();
        // $fornecedorRole = $fornecedor->roles->pluck('nomeFornecedor','nomeFornecedor')->all();

        return view('fornecedores.edit',compact('fornecedor','todososbancos'));

        // return view('fornecedores.edit',compact('fornecedor'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fornecedores  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedores $fornecedor)
    {
         request()->validate([

            'nomeFornecedor'                        => 'required|min:1',
            'contatoFornecedor'                     => 'required|min:1',
            'razaosocialFornecedor'                 => 'required|min:1',
            'siteFornecedor'                        => 'required|min:1',
            'cepFornecedor'                         => 'required|min:1',
            'enderecoFornecedor'                    => 'required|min:1',
            'bairroFornecedor'                      => 'required|min:1',
            'cidadeFornecedor'                      => 'required|min:1',
            'estadoFornecedor'                      => 'required|min:1',
            'telefone1Fornecedor'                   => 'required|min:1',
            'telefone2Fornecedor'                   => 'required|min:1',
            'cnpjFornecedor'                        => 'required|min:1|cnpj',
            'inscEstadualFornecedor'                => 'required|min:1',
            'cpfFornecedor'                         => 'required|min:1|cpf',
            'identidadeFornecedor'                  => 'required|min:1',
            'emailFornecedor'                       => 'required|min:5',
            'dataCadastroFornecedor'                => 'required|min:1',
            'bancoFornecedor'                       => 'required|min:1',
            'nrcontaFornecedor'                     => 'required|min:1',
            'agenciaFornecedor'                     => 'required|min:1',
            'chavePix1Fornecedor'                   => 'required|min:1',
            'chavePix2Fornecedor'                   => 'required|min:1',
            'chavePix3Fornecedor'                   => 'required|min:1',
            'chavePix4Fornecedor'                   => 'required|min:1',

            // 'bancoFavorecidoFornecedor'             => 'required|min:1',
            // 'nomefavorecidoFornecedor'              => 'required|min:1',
            // 'cpffavorecidoFornecedor'               => 'required|min:1',
            // 'contacorrentefavorecidoFornecedor'     => 'required|min:1',
            // 'agenciafavorecidoFornecedor'           => 'required|min:1',
            'ativoFornecedor'                       => 'required|min:1',
            'excluidoFornecedor'                    => 'required|min:1',

        ]);


        $fornecedor->update($request->all());


        return redirect()->route('fornecedores.index')
                        ->with('success','Fornecedor atualizado com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fornecedores  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Fornecedores::find($id)->delete();

        return redirect()->route('fornecedores.index')
                        ->with('success','Fornecedor excluído com êxito!');
    }

}
