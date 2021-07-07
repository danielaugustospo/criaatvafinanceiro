<?php

namespace App\Http\Controllers;

use App\CodigoDespesa;
use App\Despesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
// use Freshbitsweb\Laratables\Laratables;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Providers\AppServiceProvider;
use App\Providers\FormatacoesServiceProvider;
use Illuminate\Support\Facades\App;




class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:despesa-list|despesa-create|despesa-edit|despesa-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:despesa-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:despesa-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:despesa-delete', ['only' => ['destroy']]);

        $this->acao =  request()->segment(count(request()->segments()));
        $this->valorInput = null;
        $this->valorSemCadastro = null;


        if ($this->acao == 'create') {
            $this->valorInput = " ";
            $this->valorSemCadastro = "0";
            $this->variavelReadOnlyNaView = "";
            $this->variavelDisabledNaView = "";
        } elseif ($this->acao == 'edit') {
            $this->variavelReadOnlyNaView = "";
            $this->variavelDisabledNaView = "";
        } elseif ($this->acao != 'edit' && $this->acao != 'create') {
            $this->variavelReadOnlyNaView = "readonly";
            $this->variavelDisabledNaView = 'disabled';
        }


        //its just a dummy data object.
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Despesa::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $descricaoDespesa = $request->get('descricaoDespesa');
                    $valorparcela = $request->get('valorparcela');
                    $vencimento = $request->get('vencimento');
                    $idCodigoDespesas = $request->get('idCodigoDespesas');
                    $notaFiscal = $request->get('notaFiscal');
                    $idOS = $request->get('idOS');
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($descricaoDespesa)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['descricaoDespesa'], $request->get('descricaoDespesa')) ? true : false;
                        });
                    }
                    if (!empty($valorparcela)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['valorparcela'], $request->get('valorparcela')) ? true : false;
                        });
                    }
                    if (!empty($vencimento)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['vencimento'], $request->get('vencimento')) ? true : false;
                        });
                    }
                    if (!empty($idCodigoDespesas)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idCodigoDespesas'], $request->get('idCodigoDespesas')) ? true : false;
                        });
                    }
                    if (!empty($notaFiscal)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['notaFiscal'], $request->get('notaFiscal')) ? true : false;
                        });
                    }
                    if (!empty($idOS)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['idOS'], $request->get('idOS')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['descricaoDespesa']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['valorparcela']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['vencimento']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idCodigoDespesas']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['notaFiscal']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['idOS']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="despesas/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = Despesa::orderBy('id', 'DESC')->paginate(5);
            return view('despesas.index', compact('data'))
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

        $listaContas = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1');
        // $codigoDespesa = DB::select('select id, idGrupoCodigoDespesa, despesaCodigoDespesa from codigodespesas where ativoCodigoDespesa = 1');
        $codigoDespesa = DB::select('select c.id,  c.despesaCodigoDespesa, c.idGrupoCodigoDespesa, g.grupoDespesa from codigodespesas c, grupodespesas g 
        where (c.ativoCodigoDespesa = 1) and (g.id = c.idGrupoCodigoDespesa) order by c.id');

        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1');
        $todasOSAtivas = DB::select('SELECT x.* FROM ordemdeservico x WHERE ativoOrdemdeServico = 1');
        $todosOSBancos = DB::select('SELECT * FROM banco WHERE ativoBanco = 1');
        $precoReal = " ";
        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;
        return view('despesas.create', compact('listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'todosOSBancos', 'precoReal', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $despesa = new Despesa();


        $request->validate([

            // 'idCodigoDespesas'          => 'required',
            // 'idOS'                      => 'required',
            // 'idDespesaPai'              => 'required',
            'descricaoDespesa'          => 'required',
            // 'despesaCodigoDespesas'     => 'required',
            // 'idFornecedor'              => 'required',
            // 'precoReal'                 => 'required',
            // 'ehcompra'                   => 'required',
            // 'pago'                      => 'required',
            // 'quempagou'                 => 'required',
            'idFormaPagamento'          => 'required',
            'conta'                     => 'required',
            // 'nRegistro'                 => 'required',
            // 'valorEstornado'            => 'required',
            // 'vencimento'                => 'required',
            // 'totalPrecoReal'            => 'required',
            // 'totalPrecoCliente'         => 'required',
            // 'ativoDespesa'              => 'required',
            // 'excluidoDespesa'           => 'required',

            'despesaFixa'               => 'required',
            // 'notaFiscal'                => 'required',
            // 'idBanco'                   => 'required',
            // 'cheque'                    => 'required',
        ]);
        // $valorMonetario                  = $request->get('precoReal');
        // $quantia = FormatacoesServiceProvider::validaValoresParaBackEnd($valorMonetario);


        // $despesa->idCodigoDespesas           = $request->get('idCodigoDespesas');
        // $despesa->idOS                       = $request->get('idOS');
        // $despesa->idDespesaPai               = $request->get('idDespesaPai');
        // $despesa->descricaoDespesa           = $request->get('descricaoDespesa');
        // $despesa->despesaCodigoDespesas      = $request->get('despesaCodigoDespesas');
        // $despesa->tipoFornecedor             = $request->get('tipoFornecedor');
        // $despesa->idFornecedor               = $request->get('idFornecedor');
        // $despesa->precoReal                  = $quantia;
        // $despesa->ehcompra                    = $request->get('ehcompra');
        // $despesa->pago                       = $request->get('pago');
        // $despesa->reembolsado                = $request->get('reembolsado');
        // $despesa->idFormaPagamento           = $request->get('idFormaPagamento');
        // $despesa->conta                      = $request->get('conta');
        // $despesa->nRegistro                  = $request->get('nRegistro');
        // $despesa->dataDaCompra               = $request->get('dataDaCompra');
        // $despesa->dataDoTrabalho             = $request->get('dataDoTrabalho');
        // $despesa->vencimento                 = $request->get('vencimento');
        // $despesa->totalPrecoReal             = $request->get('totalPrecoReal');
        // $despesa->totalPrecoCliente          = $request->get('totalPrecoCliente');
        // // $despesa->lucro                   = $request->get('lucro');
        // $despesa->despesaFixa                = $request->get('despesaFixa');
        // $despesa->notaFiscal                 = $request->get('notaFiscal');
        // $despesa->idBanco                    = $request->get('idBanco');
        // $despesa->cheque                     = $request->get('cheque');
        // $despesa->ativoDespesa               = $request->get('ativoDespesa');
        // $despesa->excluidoDespesa            = $request->get('excluidoDespesa');
        // $despesa->idAlteracaoUsuario         = $request->get('idAlteracaoUsuario');
        // $despesa->idAutor                    = $request->get('idAutor');

        $compraparcelada =  $request->get('compraparcelada');

        // $temDespesa = $request->get('compraparcelada');
        // $tamanhoArrayDespesa = count($compraparcelada);

        // $despesa->a                     =  $request->get('a');
        // $despesa->compraparcelada       =  $request->get('compraparcelada');

        $despesa->idCodigoDespesas      =  $request->get('idCodigoDespesas');
        $despesa->idFornecedor          =  $request->get('idFornecedor');
        $despesa->idFormaPagamento      =  $request->get('idFormaPagamento');
        $despesa->conta                 =  $request->get('conta');
        $despesa->precoReal             =  $request->get('precoReal');
        $despesa->dataDaCompra          =  $request->get('dataDaCompra');
        $despesa->dataDoTrabalho        =  $request->get('dataDoTrabalho');
        $despesa->quemcomprou           =  $request->get('quemcomprou');
        $despesa->idBanco               =  $request->get('idBanco');
        $despesa->cheque                =  $request->get('cheque');
        $despesa->reembolsado           =  $request->get('reembolsado');
        $despesa->despesaFixa           =  $request->get('despesaFixa');
        $despesa->nRegistro             =  $request->get('nRegistro');
        $despesa->despesaCodigoDespesas =  $request->get('despesaCodigoDespesas');
        $despesa->ativoDespesa          =  $request->get('ativoDespesa');
        $despesa->ehcompra               =  $request->get('ehcompra');
        $despesa->excluidoDespesa       =  $request->get('excluidoDespesa');
        $despesa->totalPrecoCliente     =  $request->get('totalPrecoCliente');
        $despesa->totalPrecoReal        =  $request->get('totalPrecoReal');
        $despesa->idDespesaPai          =  $request->get('idDespesaPai');
        $despesa->ativoDespesa          =  $request->get('ativoDespesa');
        $despesa->excluidoDespesa       =  $request->get('excluidoDespesa');


        if ($compraparcelada == 'S') {
            $quantidade = $request->get('quantidadeTabela');
            $tamanhoArrayQuantidade = count($quantidade);

            for ($i = 0; $i < $tamanhoArrayQuantidade; $i++) {
                $despesa = new Despesa();

                $despesa->idOS                  =  $request->get('idOSTabela')[$i];
                $despesa->vencimento            =  $request->get('vencimentoTabela')[$i];
                $despesa->notaFiscal            =  $request->get('notaFiscalTabela')[$i];
                $despesa->pago                  =  $request->get('pagoTabela')[$i];
                $despesa->quantidade            =  $request->get('quantidadeTabela')[$i];
                $despesa->valorUnitario         =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorUnitarioTabela')[$i]);

                $despesa->valorLiquido          =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorLiquidoTabela')[$i]);
                $despesa->valorparcela          =  FormatacoesServiceProvider::validaValoresParaBackEnd($request->get('valorparcelaTabela')[$i]);
                $despesa->descricaoDespesa      =  $request->get('descricaoTabela')[$i];

                $despesa->idCodigoDespesas      =  $request->get('idCodigoDespesas');
                $despesa->idFornecedor          =  $request->get('idFornecedor');
                $despesa->idFormaPagamento      =  $request->get('idFormaPagamento');
                $despesa->conta                 =  $request->get('conta');
                $despesa->precoReal             =  $request->get('precoReal');
                $despesa->dataDaCompra          =  $request->get('dataDaCompra');
                $despesa->dataDoTrabalho        =  $request->get('dataDoTrabalho');
                $despesa->quemcomprou           =  $request->get('quemcomprou');
                $despesa->idBanco               =  $request->get('idBanco');
                $despesa->cheque                =  $request->get('cheque');
                $despesa->reembolsado           =  $request->get('reembolsado');
                $despesa->despesaFixa           =  $request->get('despesaFixa');
                $despesa->nRegistro             =  $request->get('nRegistro');
                $despesa->despesaCodigoDespesas =  $request->get('despesaCodigoDespesas');
                $despesa->ativoDespesa          =  $request->get('ativoDespesa');
                $despesa->ehcompra               =  $request->get('ehcompra');
                $despesa->excluidoDespesa       =  $request->get('excluidoDespesa');
                $despesa->totalPrecoCliente     =  $request->get('totalPrecoCliente');
                $despesa->totalPrecoReal        =  $request->get('totalPrecoReal');
                $despesa->idDespesaPai          =  $request->get('idDespesaPai');
                $despesa->ativoDespesa          =  $request->get('ativoDespesa');
                $despesa->excluidoDespesa       =  $request->get('excluidoDespesa');


                $despesa->save();
            }
        } elseif ($compraparcelada == 'N') {

            // $despesa->valorparcela          =  $request->get('precoReal');

            $despesa->idOS                  =  $request->get('idOS');
            /*array*/
            $despesa->vencimento            =  $request->get('vencimento')[0];
            $despesa->notaFiscal            =  $request->get('notaFiscal');
            /*array*/
            $despesa->pago                  =  $request->get('pago')[0];
            // $despesa->quantidade            =  $request->get('quantidade');
            // $despesa->valorUnitario         =  $request->get('valorUnitario');
            // $despesa->valorLiquido          =  $request->get('valorLiquido');
            // $despesa->valorparcela          =  $request->get('valorparcela');
            $despesa->precoReal             =  $request->get('valorparcela');
            $despesa->descricaoDespesa      =  $request->get('descricaoDespesa');

            $despesa->save();
        } elseif (($compraparcelada != 'N') && ($compraparcelada != 'S')) {
            return redirect()->route('despesas.index')
                ->with('error', 'Ocorreu um erro ao salvar.');
        }
        // Despesa::create($request->all());

        return redirect()->route('despesas.index')
            ->with('success', 'Despesa cadastrada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $despesa = Despesa::find($id);

        $listaContas  = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1 order by id = :conta desc', ['conta' => $despesa->conta]);

        $codigoDespesa = DB::select('select c.id,  c.despesaCodigoDespesa, c.idGrupoCodigoDespesa, g.grupoDespesa from codigodespesas c, grupodespesas g 
        where (c.ativoCodigoDespesa = 1) and (g.id = c.idGrupoCodigoDespesa) order by c.id = :codigoCadastrado desc', ['codigoCadastrado' => $despesa->idCodigoDespesas]);

        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1 order by id = :idFornecedor desc', ['idFornecedor' => $despesa->idFornecedor]);
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 order by id = :idFormaPagamento desc', ['idFormaPagamento' => $despesa->idFormaPagamento]);
        $todasOSAtivas = DB::select('SELECT x.* FROM ordemdeservico x WHERE ativoOrdemdeServico = 1 order by id = :idOS desc', ['idOS' => $despesa->idOS]);
        $listabancos = DB::select('SELECT * FROM banco WHERE ativoBanco = 1 order by id = :idBanco desc', ['idBanco' => $despesa->idBanco]);
        $valorMonetario = $despesa->precoReal;
        $precoReal = FormatacoesServiceProvider::validaValoresParaView($valorMonetario);


        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;
        return view('despesas.show', compact('despesa', 'listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'listabancos', 'precoReal', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $despesa = Despesa::find($id);

        $listaContas  = DB::select('select id,apelidoConta, nomeConta from conta where ativoConta = 1 order by id = :conta desc', ['conta' => $despesa->conta]);

        $codigoDespesa = DB::select('select c.id,  c.despesaCodigoDespesa, c.idGrupoCodigoDespesa, g.grupoDespesa from codigodespesas c, grupodespesas g 
        where (c.ativoCodigoDespesa = 1) and (g.id = c.idGrupoCodigoDespesa) order by c.id = :codigoCadastrado desc', ['codigoCadastrado' => $despesa->idCodigoDespesas]);

        $listaForncedores = DB::select('select id,nomeFornecedor, razaosocialFornecedor, contatoFornecedor from fornecedores where ativoFornecedor = 1');
        $formapagamento = DB::select('select id,nomeFormaPagamento from formapagamento where ativoFormaPagamento = 1 order by id = :idFormaPagamento desc', ['idFormaPagamento' => $despesa->idFormaPagamento]);
        $todasOSAtivas = DB::select('SELECT x.* FROM ordemdeservico x WHERE ativoOrdemdeServico = 1 order by id = :idOS desc', ['idOS' => $despesa->idOS]);
        $listabancos = DB::select('SELECT * FROM banco WHERE ativoBanco = 1 order by id = :idBanco desc', ['idBanco' => $despesa->idBanco]);

        $valorMonetario = $despesa->precoReal;
        $precoReal = FormatacoesServiceProvider::validaValoresParaView($valorMonetario);

        $valorInput = $this->valorInput;
        $valorSemCadastro = $this->valorSemCadastro;
        $variavelReadOnlyNaView = $this->variavelReadOnlyNaView;
        $variavelDisabledNaView = $this->variavelDisabledNaView;


        return view('despesas.edit', compact('despesa', 'listaContas', 'codigoDespesa', 'listaForncedores', 'formapagamento', 'todasOSAtivas', 'listabancos', 'precoReal', 'valorInput', 'valorSemCadastro', 'variavelReadOnlyNaView', 'variavelDisabledNaView'));

        // return view('despesas.edit',compact('banco'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Despesa $despesa)
    {
        request()->validate([
            // 'idCodigoDespesas'          => 'required',
            // 'idOS'                      => 'required',
            // 'idDespesaPai'              => 'required',
            'descricaoDespesa'          => 'required',
            // 'despesaCodigoDespesas'     => 'required',
            // 'idFornecedor'              => 'required',
            // 'precoReal'                 => 'required',
            // 'ehcompra'                   => 'required',
            // 'pago'                      => 'required',
            // 'quempagou'                 => 'required',
            'idFormaPagamento'          => 'required',
            'conta'                     => 'required',
            // 'nRegistro'                 => 'required',
            // 'valorEstornado'            => 'required',
            // 'vencimento'                => 'required',
            // 'totalPrecoReal'            => 'required',
            // 'totalPrecoCliente'         => 'required',
            // 'ativoDespesa'              => 'required',
            // 'excluidoDespesa'           => 'required',

            'despesaFixa'               => 'required',
            // 'notaFiscal'                => 'required',
            // 'idBanco'                   => 'required',
            // 'cheque'                    => 'required',
        ]);

        $valorMonetario                  = $request->get('precoReal');

        // $quantia = $this->validaValores($valorMonetario);
        $quantia = FormatacoesServiceProvider::validaValoresParaBackEnd($valorMonetario);


        $despesa->idCodigoDespesas           = $request->get('idCodigoDespesas');
        $despesa->idOS                       = $request->get('idOS');
        $despesa->idDespesaPai               = $request->get('idDespesaPai');
        $despesa->descricaoDespesa           = $request->get('descricaoDespesa');
        $despesa->despesaCodigoDespesas      = $request->get('despesaCodigoDespesas');
        $despesa->tipoFornecedor             = $request->get('tipoFornecedor');
        $despesa->idFornecedor               = $request->get('idFornecedor');
        $despesa->precoReal                  = $quantia;
        $despesa->ehcompra                    = $request->get('ehcompra');
        $despesa->pago                       = $request->get('pago');
        $despesa->reembolsado                = $request->get('reembolsado');
        $despesa->idFormaPagamento           = $request->get('idFormaPagamento');
        $despesa->conta                      = $request->get('conta');
        $despesa->nRegistro                  = $request->get('nRegistro');
        $despesa->dataDaCompra               = $request->get('dataDaCompra');
        $despesa->dataDoTrabalho             = $request->get('dataDoTrabalho');
        $despesa->vencimento                 = $request->get('vencimento');
        $despesa->totalPrecoReal             = $request->get('totalPrecoReal');
        $despesa->totalPrecoCliente          = $request->get('totalPrecoCliente');
        // $despesa->lucro                      = $request->get('lucro');
        $despesa->despesaFixa                = $request->get('despesaFixa');
        $despesa->notaFiscal                 = $request->get('notaFiscal');
        $despesa->idBanco                    = $request->get('idBanco');
        $despesa->cheque                     = $request->get('cheque');
        $despesa->ativoDespesa               = $request->get('ativoDespesa');
        $despesa->excluidoDespesa            = $request->get('excluidoDespesa');
        $despesa->idAlteracaoUsuario         = $request->get('idAlteracaoUsuario');
        // $despesa->idAutor                    = $request->get('idAutor');


        $despesa->update();

        return redirect()->route('despesas.index')
            ->with('success', 'Despesa atualizada com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Despesa::find($id)->delete();

        return redirect()->route('despesas.index')
            ->with('success', 'Despesa excluída com êxito!');
    }


    public function listaCodigoDespesa()
    {
        $listaCodigoDespesa = DB::select('SELECT c.id, c.despesaCodigoDespesa, g.grupoDespesa 
        FROM codigodespesas c, grupodespesas g 
        WHERE (c.excluidoCodigoDespesa = 0) 
        and (c.ativoCodigoDespesa = 1) 
        and (c.idGrupoCodigoDespesa = g.id) 
        order by c.despesaCodigoDespesa');

        view()->share('listaCodigoDespesa', $listaCodigoDespesa);
        echo json_encode($listaCodigoDespesa);
    }
    public function listaMateriais()
    {
        $listaBensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais where ativadobenspatrimoniais = 1');
        echo json_encode($listaBensPatrimoniais);
    }

    public function listaFornecedores()
    {
        $listaFornecedores =  DB::select('SELECT * from fornecedores where ativoFornecedor = 1');
        echo json_encode($listaFornecedores);
    }
}
