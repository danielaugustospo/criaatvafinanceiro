<?php


namespace App\Http\Controllers;


use App\Funcionario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:funcionario-list|funcionario-create|funcionario-edit|funcionario-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:funcionario-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:funcionario-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:funcionario-delete', ['only' => ['destroy']]);
    
        $this->acao =  request()->segment(count(request()->segments()));
        $this->valorInput = null;
        $this->valorSemCadastro = null;

        if ($this->acao == 'create'){
            $this->valorInput = " ";
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

            $data = Funcionario::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $cpfFuncionario = $request->get('cpfFuncionario');
                    $nomeFuncionario = $request->get('nomeFuncionario');
                    $celularFuncionario = $request->get('celularFuncionario');
                    $emailFuncionario = $request->get('emailFuncionario');
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($cpfFuncionario)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['cpfFuncionario'], $request->get('cpfFuncionario')) ? true : false;
                        });
                    }
                    if (!empty($nomeFuncionario)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['nomeFuncionario'], $request->get('nomeFuncionario')) ? true : false;
                        });
                    }
                    if (!empty($celularFuncionario)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['celularFuncionario'], $request->get('celularFuncionario')) ? true : false;
                        });
                    }
                    if (!empty($emailFuncionario)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['emailFuncionario'], $request->get('emailFuncionario')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['cpfFuncionario']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['nomeFuncionario']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['celularFuncionario']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['emailFuncionario']), Str::lower($request->get('search')))) {
                                return true;
                            } 
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="funcionarios/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {

        $data = Funcionario::orderBy('id', 'DESC')->paginate(5);
        return view('funcionarios.index', compact('data'))
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
        $todosorgaosrg = DB::select('select * from orgaorg');
        $todososbancos = DB::select('select distinct * from banco');
        
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;

        
        return view('funcionarios.create', compact('todosorgaosrg', 'todososbancos','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $funcionario = new Funcionario();


        $request->validate([
            'nomeFuncionario' => 'required|min:3',
            'cpfFuncionario'  => 'required|cpf|unique:funcionarios',

            'cepFuncionario'      => 'required',
            'enderecoFuncionario' => 'required',
            'bairroFuncionario'   => 'required',
            'cidadeFuncionario'   => 'required',
            'ufFuncionario'       => 'required',
            'celularFuncionario'  => 'required',
            'fotoFuncionario'     => 'required',
            'bancoFuncionario'    => 'required',




            // 'telresidenciaFuncionario' => 'required',
            // 'contatoemergenciaFuncionario' => 'required',
            // 'emailFuncionario' => 'required',
            // 'redesocialFuncionario' => 'required',
            // 'facebookFuncionario' => 'required',
            // 'telegramFuncionario' => 'required',
            // 'rgFuncionario' => 'required',
            // 'orgaoRGFuncionario' => 'required',
            // 'expedicaoRGFuncionario' => 'required',
            // 'tituloFuncionario' => 'required|titulo_eleitor',
            // 'maeFuncionario' => 'required',
            // 'paiFuncionario' => 'required',
            // 'profissaoFuncionario' => 'required',
            // 'cargoEmpresaFuncionario' => 'required',
            // 'tipocontratoFuncionario' => 'required',
            // 'grauescolaridadeFuncionario' => 'required',
            // 'descformacaoFuncionario' => 'required',
            // 'certficFuncionario' => 'required',
            // 'uncertificadoraFuncionario' => 'required',
            // 'anocertificacaoFuncionario' => 'required',
            // 'contacorrenteFuncionario' => 'required',
            // 'bancoFuncionario' => 'required',
            // 'nrcontaFuncionario' => 'required',
            // 'agenciaFuncionario' => 'required',
            // 'nomefavorecidoFuncionario' => 'required',
            // 'cpffavorecidoFuncionario' => 'required',
            // 'contacorrentefavorecidoFuncionario' => 'required',
            // 'bancofavorecidoFuncionario' => 'required',
            // 'nrcontafavorecidoFuncionario' => 'required',
            // 'agenciafavorecidoFuncionario' => 'required',

        ]);


        $funcionario->nomeFuncionario                                   = $request->get('nomeFuncionario');
        $funcionario->cpfFuncionario                                    = $request->get('cpfFuncionario');
        $funcionario->cepFuncionario                                    = $request->get('cepFuncionario');
        $funcionario->enderecoFuncionario                               = $request->get('enderecoFuncionario');
        $funcionario->bairroFuncionario                                 = $request->get('bairroFuncionario');
        $funcionario->cidadeFuncionario                                 = $request->get('cidadeFuncionario');
        $funcionario->ufFuncionario                                     = $request->get('ufFuncionario');
        $funcionario->celularFuncionario                                = $request->get('celularFuncionario');

        $funcionario->telresidenciaFuncionario                          = $request->get('telresidenciaFuncionario');
        $funcionario->contatoemergenciaFuncionario                      = $request->get('contatoemergenciaFuncionario');
        $funcionario->emailFuncionario                                  = $request->get('emailFuncionario');
        $funcionario->redesocialFuncionario                             = $request->get('redesocialFuncionario');
        $funcionario->facebookFuncionario                               = $request->get('facebookFuncionario');
        $funcionario->telegramFuncionario                               = $request->get('telegramFuncionario');
        $funcionario->rgFuncionario                                     = $request->get('rgFuncionario');
        $funcionario->orgaoRGFuncionario                                = $request->get('orgaoRGFuncionario');
        $funcionario->expedicaoRGFuncionario                            = $request->get('expedicaoRGFuncionario');
        $funcionario->tituloFuncionario                                 = $request->get('tituloFuncionario');
        $funcionario->maeFuncionario                                    = $request->get('maeFuncionario');
        $funcionario->paiFuncionario                                    = $request->get('paiFuncionario');
        $funcionario->profissaoFuncionario                              = $request->get('profissaoFuncionario');
        $funcionario->cargoEmpresaFuncionario                           = $request->get('cargoEmpresaFuncionario');
        $funcionario->tipocontratoFuncionario                           = $request->get('tipocontratoFuncionario');
        $funcionario->grauescolaridadeFuncionario                       = $request->get('grauescolaridadeFuncionario');
        $funcionario->descformacaoFuncionario                           = $request->get('descformacaoFuncionario');
        $funcionario->certficFuncionario                                = $request->get('certficFuncionario');
        $funcionario->uncertificadoraFuncionario                        = $request->get('uncertificadoraFuncionario');
        $funcionario->anocertificacaoFuncionario                        = $request->get('anocertificacaoFuncionario');
        $funcionario->contacorrenteFuncionario                          = $request->get('contacorrenteFuncionario');
        $funcionario->bancoFuncionario                                  = $request->get('bancoFuncionario');
        $funcionario->nrcontaFuncionario                                = $request->get('nrcontaFuncionario');
        $funcionario->agenciaFuncionario                                = $request->get('agenciaFuncionario');
        $funcionario->nomefavorecidoFuncionario                         = $request->get('nomefavorecidoFuncionario');
        $funcionario->cpffavorecidoFuncionario                          = $request->get('cpffavorecidoFuncionario');
        $funcionario->contacorrentefavorecidoFuncionario                = $request->get('contacorrentefavorecidoFuncionario');
        $funcionario->bancofavorecidoFuncionario                        = $request->get('bancofavorecidoFuncionario');
        $funcionario->nrcontafavorecidoFuncionario                      = $request->get('nrcontafavorecidoFuncionario');
        $funcionario->agenciafavorecidoFuncionario                      = $request->get('agenciafavorecidoFuncionario');
        $funcionario->ativoFuncionario                                  = $request->get('ativoFuncionario');
        $funcionario->excluidoFuncionario                               = $request->get('excluidoFuncionario');


        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('fotoFuncionario') && $request->file('fotoFuncionario')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->fotoFuncionario->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->fotoFuncionario->storeAs('fotosFuncionarios', $nameFile, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload) {
                return redirect()->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                //Funcionario::create($request->all());
                $funcionario->fotoFuncionario = $nameFile;
                $funcionario->save();
                return redirect()->route('funcionarios.index')
                    ->with('success', 'Funcionário criado com êxito.');
            }
            //Funcionario::create($request->all());


        }
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

        $funcionarioRole = $funcionario->roles->pluck('nomeFuncionario', 'nomeFuncionario')->all();
        $todosorgaosrg = DB::select('select * from orgaorg where ativoOrgaoRG = 1 order by id = :idOrgaoRG desc', ['idOrgaoRG' =>  $funcionario->orgaoRGFuncionario]);

        $todososbancos = DB::select('select distinct * from banco  where ativoBanco = 1 and excluidoBanco = 0 order by codigoBanco = :bancoFuncionario desc', ['bancoFuncionario' => $funcionario->bancoFuncionario]);


        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;


        return view('funcionarios.show', compact('funcionario', 'todosorgaosrg', 'todososbancos','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));
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
        $roles = Funcionario::pluck('nomeFuncionario', 'nomeFuncionario')->all();
        $funcionarioRole = $funcionario->roles->pluck('nomeFuncionario', 'nomeFuncionario')->all();
        $todosorgaosrg = DB::select('select * from orgaorg where ativoOrgaoRG = 1 order by id = :idOrgaoRG desc', ['idOrgaoRG' =>  $funcionario->orgaoRGFuncionario]);

        $todososbancos = DB::select('select distinct * from banco  where ativoBanco = 1 and excluidoBanco = 0 order by codigoBanco = :bancoFuncionario desc', ['bancoFuncionario' => $funcionario->bancoFuncionario]);

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;


        return view('funcionarios.edit', compact('funcionario', 'roles', 'funcionarioRole', 'todosorgaosrg', 'todososbancos','valorInput','valorSemCadastro','variavelReadOnlyNaView','variavelDisabledNaView'));

        // return view('funcionarios.edit',compact('funcionario'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomeFuncionario' => 'required|min:3',
            'cpfFuncionario'  => 'required|cpf',

            'cepFuncionario' => 'required',
            'enderecoFuncionario' => 'required',
            'bairroFuncionario' => 'required',
            'cidadeFuncionario' => 'required',
            'ufFuncionario' => 'required',
            'celularFuncionario' => 'required',

            // 'telresidenciaFuncionario' => 'required',
            // 'contatoemergenciaFuncionario' => 'required',
            // 'emailFuncionario' => 'required',
            // 'redesocialFuncionario' => 'required',
            // 'facebookFuncionario' => 'required',
            // 'telegramFuncionario' => 'required',
            // 'rgFuncionario' => 'required',
            // 'orgaoRGFuncionario' => 'required',
            // 'expedicaoRGFuncionario' => 'required',
            // 'tituloFuncionario' => 'required|titulo_eleitor',
            // 'maeFuncionario' => 'required',
            // 'paiFuncionario' => 'required',
            // 'profissaoFuncionario' => 'required',
            // 'cargoEmpresaFuncionario' => 'required',
            // 'tipocontratoFuncionario' => 'required',
            // 'grauescolaridadeFuncionario' => 'required',
            // 'descformacaoFuncionario' => 'required',
            // 'certficFuncionario' => 'required',
            // 'uncertificadoraFuncionario' => 'required',
            // 'anocertificacaoFuncionario' => 'required',
            // 'contacorrenteFuncionario' => 'required',
            // 'bancoFuncionario' => 'required',
            // 'nrcontaFuncionario' => 'required',
            // 'agenciaFuncionario' => 'required',
            // 'nomefavorecidoFuncionario' => 'required',
            // 'cpffavorecidoFuncionario' => 'required',
            // 'contacorrentefavorecidoFuncionario' => 'required',
            // 'bancofavorecidoFuncionario' => 'required',
            // 'nrcontafavorecidoFuncionario' => 'required',
            // 'agenciafavorecidoFuncionario' => 'required',

        ]);

        $funcionario = Funcionario::find($id);


        $funcionario->nomeFuncionario                                   = $request->get('nomeFuncionario');
        $funcionario->cpfFuncionario                                    = $request->get('cpfFuncionario');
        $funcionario->cepFuncionario                                    = $request->get('cepFuncionario');
        $funcionario->enderecoFuncionario                               = $request->get('enderecoFuncionario');
        $funcionario->bairroFuncionario                                 = $request->get('bairroFuncionario');
        $funcionario->cidadeFuncionario                                 = $request->get('cidadeFuncionario');
        $funcionario->ufFuncionario                                     = $request->get('ufFuncionario');
        $funcionario->celularFuncionario                                = $request->get('celularFuncionario');

        $funcionario->telresidenciaFuncionario                          = $request->get('telresidenciaFuncionario');
        $funcionario->contatoemergenciaFuncionario                      = $request->get('contatoemergenciaFuncionario');
        $funcionario->emailFuncionario                                  = $request->get('emailFuncionario');
        $funcionario->redesocialFuncionario                             = $request->get('redesocialFuncionario');
        $funcionario->facebookFuncionario                               = $request->get('facebookFuncionario');
        $funcionario->telegramFuncionario                               = $request->get('telegramFuncionario');
        $funcionario->rgFuncionario                                     = $request->get('rgFuncionario');
        $funcionario->orgaoRGFuncionario                                = $request->get('orgaoRGFuncionario');
        $funcionario->expedicaoRGFuncionario                            = $request->get('expedicaoRGFuncionario');
        $funcionario->tituloFuncionario                                 = $request->get('tituloFuncionario');
        $funcionario->maeFuncionario                                    = $request->get('maeFuncionario');
        $funcionario->paiFuncionario                                    = $request->get('paiFuncionario');
        $funcionario->profissaoFuncionario                              = $request->get('profissaoFuncionario');
        $funcionario->cargoEmpresaFuncionario                           = $request->get('cargoEmpresaFuncionario');
        $funcionario->tipocontratoFuncionario                           = $request->get('tipocontratoFuncionario');
        $funcionario->grauescolaridadeFuncionario                       = $request->get('grauescolaridadeFuncionario');
        $funcionario->descformacaoFuncionario                           = $request->get('descformacaoFuncionario');
        $funcionario->certficFuncionario                                = $request->get('certficFuncionario');
        $funcionario->uncertificadoraFuncionario                        = $request->get('uncertificadoraFuncionario');
        $funcionario->anocertificacaoFuncionario                        = $request->get('anocertificacaoFuncionario');
        $funcionario->contacorrenteFuncionario                          = $request->get('contacorrenteFuncionario');
        $funcionario->bancoFuncionario                                  = $request->get('bancoFuncionario');
        $funcionario->nrcontaFuncionario                                = $request->get('nrcontaFuncionario');
        $funcionario->agenciaFuncionario                                = $request->get('agenciaFuncionario');
        $funcionario->nomefavorecidoFuncionario                         = $request->get('nomefavorecidoFuncionario');
        $funcionario->cpffavorecidoFuncionario                          = $request->get('cpffavorecidoFuncionario');
        $funcionario->contacorrentefavorecidoFuncionario                = $request->get('contacorrentefavorecidoFuncionario');
        $funcionario->bancofavorecidoFuncionario                        = $request->get('bancofavorecidoFuncionario');
        $funcionario->nrcontafavorecidoFuncionario                      = $request->get('nrcontafavorecidoFuncionario');
        $funcionario->agenciafavorecidoFuncionario                      = $request->get('agenciafavorecidoFuncionario');
        $funcionario->ativoFuncionario                                  = $request->get('ativoFuncionario');
        $funcionario->excluidoFuncionario                               = $request->get('excluidoFuncionario');

        $funcionario->fotoFuncionario                                                = $request->get('fotoFuncionario');

        $mensagemSucesso = 'Cadastro do funcionário ' . $funcionario->nomeFuncionario . ' foi alterado com êxito.';

        if ($funcionario->fotoFuncionario = "" || $funcionario->fotoFuncionario = null) {
            $funcionario->save();
            return redirect()->route('funcionarios.index')
                ->with('success', $mensagemSucesso);
        }

        // Define o valor default para a variável que contém o nome da imagem 
         $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('fotoFuncionario') && $request->file('fotoFuncionario')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            //$extension = $request->fotoFuncionario->extension();

            // Define finalmente o nome
            //$nameFile = "{$name}.{$extension}";
            $nameFile = "{$name}.png";

            // Faz o upload:
            $upload = $request->file('fotoFuncionario')->storeAs('fotosFuncionarios', $nameFile, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
            $funcionario->fotoFuncionario = $nameFile;

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if (!$upload) {
                return redirect()->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } 
           
        }
        else{
            unset($funcionario->fotoFuncionario);
        }
                $funcionario->save();
                return redirect()->route('funcionarios.index')
                    ->with('success', $mensagemSucesso);
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
            ->with('success', 'Funcionário excluído com êxito!');
    }
}
