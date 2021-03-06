<?php


namespace App\Http\Controllers;


use App\Fornecedores;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Freshbitsweb\Laratables\Laratables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;

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
    {        if ($request->ajax()) {

        $data = Fornecedores::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                $id                     = $request->get('id');
                $nomeFornecedor         = $request->get('nomeFornecedor');
                $razaosocialFornecedor  = $request->get('razaosocialFornecedor');
                $cnpjFornecedor         = $request->get('cnpjFornecedor');
                $cpfFornecedor          = $request->get('cpfFornecedor');
                $telefone1Fornecedor    = $request->get('telefone1Fornecedor');
                $telefone2Fornecedor    = $request->get('telefone2Fornecedor');
                $nrcontaFornecedor      = $request->get('nrcontaFornecedor');
                $agenciaFornecedor      = $request->get('agenciaFornecedor');
                $chavePix1Fornecedor    = $request->get('chavePix1Fornecedor');
                $chavePix2Fornecedor    = $request->get('chavePix2Fornecedor');
                $bancoFornecedor        = $request->get('bancoFornecedor');
                if (!empty($id)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['id'], $request->get('id')) ? true : false;
                    });
                }
                if (!empty($nomeFornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['nomeFornecedor'], $request->get('nomeFornecedor')) ? true : false;
                    });
                }
                if (!empty($razaosocialFornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['razaosocialFornecedor'], $request->get('razaosocialFornecedor')) ? true : false;
                    });
                }
                if (!empty($cnpjFornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['cnpjFornecedor'], $request->get('cnpjFornecedor')) ? true : false;
                    });
                }
                if (!empty($cpfFornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['cpfFornecedor'], $request->get('cpfFornecedor')) ? true : false;
                    });
                }
                if (!empty($telefone1Fornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['telefone1Fornecedor'], $request->get('telefone1Fornecedor')) ? true : false;
                    });
                }
                if (!empty($telefone2Fornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['telefone2Fornecedor'], $request->get('telefone2Fornecedor')) ? true : false;
                    });
                }
                if (!empty($nrcontaFornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['nrcontaFornecedor'], $request->get('nrcontaFornecedor')) ? true : false;
                    });
                }
                if (!empty($agenciaFornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['agenciaFornecedor'], $request->get('agenciaFornecedor')) ? true : false;
                    });
                }
                if (!empty($chavePix1Fornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['chavePix1Fornecedor'], $request->get('chavePix1Fornecedor')) ? true : false;
                    });
                }
                if (!empty($chavePix2Fornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['chavePix2Fornecedor'], $request->get('chavePix2Fornecedor')) ? true : false;
                    });
                }
                if (!empty($bancoFornecedor)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['bancoFornecedor'], $request->get('bancoFornecedor')) ? true : false;
                    });
                }

                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                        if (Str::contains(Str::lower($row['id']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['nomeFornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['razaosocialFornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['cnpjFornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['cpfFornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['telefone1Fornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['telefone2Fornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['nrcontaFornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['agenciaFornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['chavePix1Fornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['chavePix2Fornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['bancoFornecedor']), Str::lower($request->get('search')))) {
                            return true;
                        }
                        return false;
                    });
                }
            })
            ->addColumn('action', function ($row) {

                $btnVisualizar = '<a href="fornecedores/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                return $btnVisualizar;
            })
            ->rawColumns(['action'])
            ->make(true);
    } else {


        $listaFornecedores = Fornecedores::orderBy('id','DESC')->paginate(5);
        return view('fornecedores.index',compact('listaFornecedores'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $precoReal = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('fornecedores.create', compact('precoReal','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));
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
        $bancos = DB::select('select * from banco order by id = :idBancoFornecedor asc', ['idBancoFornecedor' => $fornecedor->bancoFornecedor]);

        $precoReal = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        return view('fornecedores.show',compact('fornecedor','bancos','precoReal','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));
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

        $bancos = DB::select('select * from banco order by id = :idBancoFornecedor asc', ['idBancoFornecedor' => $fornecedor->bancoFornecedor]);
        $precoReal = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        // $todososbancos = DB::select('select * from banco order by id = :idBancoFornecedor desc', ['idBancoFornecedor' => $fornecedor->bancoFornecedor]);
        // $roles = Fornecedores::pluck('nomeFornecedor','nomeFornecedor')->all();
        // $fornecedorRole = $fornecedor->roles->pluck('nomeFornecedor','nomeFornecedor')->all();

        return view('fornecedores.edit',compact('fornecedor', 'bancos','precoReal','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));

        // return view('fornecedores.edit',compact('fornecedor'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fornecedores  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        $fornecedor = Fornecedores::find($id);

        $fornecedor->nomeFornecedor                       =  $request->input('nomeFornecedor');
        $fornecedor->contatoFornecedor                    =  $request->input('contatoFornecedor');
        $fornecedor->razaosocialFornecedor                =  $request->input('razaosocialFornecedor');
        $fornecedor->siteFornecedor                       =  $request->input('siteFornecedor');
        $fornecedor->cepFornecedor                        =  $request->input('cepFornecedor');
        $fornecedor->enderecoFornecedor                   =  $request->input('enderecoFornecedor');
        $fornecedor->bairroFornecedor                     =  $request->input('bairroFornecedor');
        $fornecedor->cidadeFornecedor                     =  $request->input('cidadeFornecedor');
        $fornecedor->estadoFornecedor                     =  $request->input('estadoFornecedor');
        $fornecedor->telefone1Fornecedor                  =  $request->input('telefone1Fornecedor');
        $fornecedor->telefone2Fornecedor                  =  $request->input('telefone2Fornecedor');
        $fornecedor->cnpjFornecedor                       =  $request->input('cnpjFornecedor');
        $fornecedor->inscEstadualFornecedor               =  $request->input('inscEstadualFornecedor');
        $fornecedor->cpfFornecedor                        =  $request->input('cpfFornecedor');
        $fornecedor->identidadeFornecedor                 =  $request->input('identidadeFornecedor');
        $fornecedor->emailFornecedor                      =  $request->input('emailFornecedor');
        $fornecedor->dataCadastroFornecedor               =  $request->input('dataCadastroFornecedor');
        $fornecedor->bancoFornecedor                      =  $request->input('bancoFornecedor');
        $fornecedor->nrcontaFornecedor                    =  $request->input('nrcontaFornecedor');
        $fornecedor->agenciaFornecedor                    =  $request->input('agenciaFornecedor');
        $fornecedor->chavePix1Fornecedor                  =  $request->input('chavePix1Fornecedor');
        $fornecedor->chavePix2Fornecedor                  =  $request->input('chavePix2Fornecedor');
        $fornecedor->chavePix3Fornecedor                  =  $request->input('chavePix3Fornecedor');
        $fornecedor->chavePix4Fornecedor                  =  $request->input('chavePix4Fornecedor');
        // $fornecedor->bancoFavorecidoFornecedor            =  $request->input('bancoFavorecidoFornecedor');
        // $fornecedor->nomefavorecidoFornecedor             =  $request->input('nomefavorecidoFornecedor');
        // $fornecedor->cpffavorecidoFornecedor              =  $request->input('cpffavorecidoFornecedor');
        // $fornecedor->contacorrentefavorecidoFornecedor    =  $request->input('contacorrentefavorecidoFornecedor');
        // $fornecedor->agenciafavorecidoFornecedor          =  $request->input('agenciafavorecidoFornecedor');
        $fornecedor->ativoFornecedor                      =  $request->input('ativoFornecedor');
        $fornecedor->excluidoFornecedor                   =  $request->input('excluidoFornecedor');

        $fornecedor->save();


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
