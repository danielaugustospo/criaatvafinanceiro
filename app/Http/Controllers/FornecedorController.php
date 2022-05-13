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
    {        
        $listaFornecedores = Fornecedores::orderBy('id','ASC')->paginate(5);
        return view('fornecedores.index',compact('listaFornecedores'));
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
        $todososbancos1 = DB::select('select * from banco');
        $todososbancos2 = $todososbancos1;
        $todososbancos3 = $todososbancos1;

        return view('fornecedores.create', compact('precoReal','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView','todososbancos1','todososbancos2','todososbancos3'));
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
            'razaosocialFornecedor'   => 'required|min:2',
        ]);

            
        Fornecedores::create($request->all());


        return redirect()->route('fornecedores.index')
                        ->with('success','Fornecedor cadastrado com êxito.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function salvarmodal(Request $request)
    {
        $request->validate([
            'razaosocialFornecedor'   => 'required|min:1',
        ]);
        Fornecedores::create($request->all());
        return view('fornecedores.camposmodal')
                        ->with('mensagem','Fornecedor cadastrado com êxito.');                        
                
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
        $todososbancos1 = DB::select('select * from banco order by codigobanco = :codigoBancoFornecedor desc', ['codigoBancoFornecedor' => $fornecedor->bancoFornecedor1]);
        $todososbancos2 = DB::select('select * from banco order by codigobanco = :codigoBancoFornecedor desc', ['codigoBancoFornecedor' => $fornecedor->bancoFornecedor2]);
        $todososbancos3 = DB::select('select * from banco order by codigobanco = :codigoBancoFornecedor desc', ['codigoBancoFornecedor' => $fornecedor->bancoFornecedor3]);

        $precoReal = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;


        return view('fornecedores.show',compact('fornecedor','todososbancos1','todososbancos2','todososbancos3','precoReal','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));
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
       
        $todososbancos1 = DB::select('select * from banco order by codigobanco = :codigoBancoFornecedor desc', ['codigoBancoFornecedor' => $fornecedor->bancoFornecedor1]);
        $todososbancos2 = DB::select('select * from banco order by codigobanco = :codigoBancoFornecedor desc', ['codigoBancoFornecedor' => $fornecedor->bancoFornecedor2]);
        $todososbancos3 = DB::select('select * from banco order by codigobanco = :codigoBancoFornecedor desc', ['codigoBancoFornecedor' => $fornecedor->bancoFornecedor3]);

        $precoReal = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;
        $todososbancos = DB::select('select * from banco');


        // $todososbancos = DB::select('select * from banco order by id = :idBancoFornecedor desc', ['idBancoFornecedor' => $fornecedor->bancoFornecedor]);
        // $roles = Fornecedores::pluck('nomeFornecedor','nomeFornecedor')->all();
        // $fornecedorRole = $fornecedor->roles->pluck('nomeFornecedor','nomeFornecedor')->all();

        return view('fornecedores.edit',compact('fornecedor', 'todososbancos1','todososbancos2','todososbancos3','precoReal','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));

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

            'razaosocialFornecedor'                 => 'required|min:1',

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
        $fornecedor->inscMunicipalFornecedor               =  $request->input('inscMunicipalFornecedor');
        $fornecedor->cpfFornecedor                        =  $request->input('cpfFornecedor');
        $fornecedor->identidadeFornecedor                 =  $request->input('identidadeFornecedor');
        $fornecedor->emailFornecedor                      =  $request->input('emailFornecedor');
        $fornecedor->dataContratoFornecedor               =  $request->input('dataContratoFornecedor');
        
        $fornecedor->bancoFornecedor1                     =  $request->input('bancoFornecedor1');
        $fornecedor->nrcontaFornecedor1                   =  $request->input('nrcontaFornecedor1');
        $fornecedor->agenciaFornecedor1                   =  $request->input('agenciaFornecedor1');
        $fornecedor->chavePixFornecedor1                  =  $request->input('chavePixFornecedor1');

        $fornecedor->bancoFornecedor2                     =  $request->input('bancoFornecedor2');
        $fornecedor->nrcontaFornecedor2                   =  $request->input('nrcontaFornecedor2');
        $fornecedor->agenciaFornecedor2                   =  $request->input('agenciaFornecedor2');
        $fornecedor->chavePixFornecedor2                  =  $request->input('chavePixFornecedor2');

        $fornecedor->bancoFornecedor3                     =  $request->input('bancoFornecedor3');
        $fornecedor->nrcontaFornecedor3                   =  $request->input('nrcontaFornecedor3');
        $fornecedor->agenciaFornecedor3                   =  $request->input('agenciaFornecedor3');
        $fornecedor->chavePixFornecedor3                  =  $request->input('chavePixFornecedor3');

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

    public function relatorioFornecedores(Request $request)
    {
        $consulta = $this->retornaConsultaRelatorio();

        if ($request->ajax()) {

        return Datatables::of($consulta)
            ->addIndexColumn()
            // ->rawColumns(['action'])
            ->make(true);
        } else {
            // $data = Conta::orderBy('id', 'DESC')->paginate(5);
            return view('fornecedores.relatorioFornecedores', compact('consulta'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }

    public function tabelaRelatorioFornecedores(Request $request)
    {
        $consulta = DB::table('despesas')
        ->join('fornecedores', 'despesas.idFornecedor', 'fornecedores.id')
        ->join('ordemdeservico', 'despesas.idOS', 'ordemdeservico.id')

        ->select(['despesas.idOS','ordemdeservico.eventoOrdemdeServico', 'despesas.descricaoDespesa', 'fornecedores.nomeFornecedor', 'fornecedores.razaosocialFornecedor', 'despesas.nRegistro', 'despesas.vencimento', 'despesas.precoReal', 'despesas.pago'])
        ->where('despesas.ativoDespesa', '=', '1');

        // ->where(function ($consulta) {
        //     $consulta->where('ativoDespesa', '=', '1')
        //      ->orWhere('excluidoDespesa', '=', '0');
        // })
        ;

        // $consulta = $this->retornaConsultaRelatorio();

        return Datatables::of($consulta)
        ->filter(function ($query) use ($request) {



            $idOS = $request->get('buscaIdOS');

            if ($request->has('buscaIdOS')) {
                $query->where('idOS', 'like', "%{$idOS}%");
            }
            if ($request->has('buscaEventoOrdemdeServico')) {
                $query->where('eventoOrdemdeServico', 'like', "%{$request->get('buscaEventoOrdemdeServico')}%");
            }
            if ($request->has('buscaDescricaoDespesa')) {
                $query->where('descricaoDespesa', 'like', "%{$request->get('buscaDescricaoDespesa')}%");
            }
            if ($request->has('buscaNomeFornecedor')) {
                $query->where('nomeFornecedor', 'like', "%{$request->get('buscaNomeFornecedor')}%");
            }
            if ($request->has('buscaRazaosocialFornecedor')) {
                $query->where('razaosocialFornecedor', 'like', "%{$request->get('buscaRazaosocialFornecedor')}%");
            }
            if ($request->has('buscaNRegistro')) {
                $query->where('nRegistro', 'like', "%{$request->get('buscaNRegistro')}%");
            }
            if ($request->has('buscaVencimento')) {
                $query->where('vencimento', 'like', "%{$request->get('buscaVencimento')}%");
            }

            if ($request->has('buscaPrecoReal')) {
                $query->where('precoReal', 'like', "%{$request->get('buscaPrecoReal')}%");
            }

            if ($request->has('buscaPago')) {
                $query->where('pago', 'like', "%{$request->get('buscaPago')}%");
            }

            // if (($request->buscaDataInicio != null) && ($request->buscaDataFim != null)) {
            //     $query->whereDate('vencimento', ">", "{$request->buscaDataInicio}")
            //         ->whereDate('vencimento', "<", "{$request->buscaDataFim}");
            // }

        })
            ->addIndexColumn()
            ->make(true);
    }

    public function retornaConsultaRelatorio()
    {
        DB::table('despesas')
        ->join('fornecedores', 'despesas.idFornecedor', 'fornecedores.id')
        ->join('ordemdeservico', 'despesas.idOS', 'ordemdeservico.id')

        ->select(['despesas.idOS','ordemdeservico.eventoOrdemdeServico', 'despesas.descricaoDespesa', 'fornecedores.nomeFornecedor', 'fornecedores.razaosocialFornecedor', 'despesas.nRegistro', 'despesas.vencimento', 'despesas.precoReal', 'despesas.pago'])
        // ->where(function ($consulta) {
        //     $consulta->where('ativoDespesa', '=', '1')
        //      ->orWhere('excluidoDespesa', '=', '0');
        // })
        ;
        

   }

}
