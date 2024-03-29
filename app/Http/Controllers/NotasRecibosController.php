<?php


namespace App\Http\Controllers;


use App\NotasRecibos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
// use Illuminate\Support\Facades\DB;
use DB;
use DataTables;
use Illuminate\Support\Str;
use App\Providers\FormatacoesServiceProvider;

use App\Despesa;
use App\User;
use Illuminate\Support\Facades\App;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Gate;
class NotasRecibosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:notasrecibos-list|notasrecibos-create|notasrecibos-edit|notasrecibos-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:notasrecibos-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:notasrecibos-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:notasrecibos-delete', ['only' => ['destroy']]);
    }


 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('id')) {
            $idNotaRecibo = $request->get('id');
            settype($idNotaRecibo, "integer");
            $this->show($request, $idNotaRecibo);

            $notaRecibo = NotasRecibos::where('id', $idNotaRecibo)->get();

            if (count($notaRecibo) == 1) {

                header("Location: notasrecibos/$idNotaRecibo");
                exit();
            } else {
                return redirect()->route('notasrecibos.index')
                    ->with('warning', 'Nota/Recibo id ' . $idNotaRecibo . ' é um dado excluído, ou inexistente, não podendo ser acessado');
            }
        }

        if (!Gate::allows('notasrecibos-list') && !Gate::allows('notasrecibos-list-all')) {
            abort(401, 'Não Autorizado');
        } elseif (Gate::allows('notasrecibos-list')) {
            $request->idUser = Auth::id();
        }

        $param = "dtInicioEmissao=$request->dtInicioEmissao&amp;dtFimEmissao=$request->dtFimEmissao&amp;valorNFRecibo=$request->valorNFRecibo&amp;notaRecibo=$request->notaRecibo&amp;aliquota=$request->aliquota&amp;ordemServico=$request->ordemServico&amp;valorImposto=$request->valorImposto&amp;dtInicioRecebimento=$request->dtInicioRecebimento&amp;dtFimRecebimento=$request->dtFimRecebimento&amp;pago=$request->pago&amp;conta=$request->conta&amp;tpRel=";
        
        
        return view('notasrecibos.index', compact('param'));
    }


    public function apiNotasRecibos(Request $request)
    {

        $listaNotasRecibos = NotasRecibos::where('OS', '!=', '' );
        
        $listaNotasRecibos = (!is_null($request->ordemServico))        ?  $listaNotasRecibos->where('OS', $request->ordemServico) : $listaNotasRecibos;
               
        
        $listaNotasRecibos = (!is_null($request->dtInicioEmissao)) && (!is_null($request->dtFimEmissao) ) ?  $listaNotasRecibos->whereBetween('Emissao', [$request->dtInicioEmissao, $request->dtFimEmissao]) : $listaNotasRecibos;
        $listaNotasRecibos = (!is_null($request->valorNFRecibo))       ?  $listaNotasRecibos->where('Valor', FormatacoesServiceProvider::validaValoresParaBackEnd($request->valorNFRecibo)) : $listaNotasRecibos;

        $listaNotasRecibos = (!is_null($request->valorImposto))       ?  $listaNotasRecibos->where('imposto', FormatacoesServiceProvider::validaValoresParaBackEnd($request->valorImposto)) : $listaNotasRecibos;
        $listaNotasRecibos = (!is_null($request->notaRecibo))          ?  $listaNotasRecibos->where('nfRecibo', $request->notaRecibo) : $listaNotasRecibos;
        $listaNotasRecibos = (!is_null($request->aliquota))            ?  $listaNotasRecibos->where('aliquota', $request->aliquota) : $listaNotasRecibos;
        $listaNotasRecibos = (!is_null($request->conta))               ?  $listaNotasRecibos->where('nomeConta', $request->conta) : $listaNotasRecibos;
        $listaNotasRecibos = (!is_null($request->pago) && ($request->pago != 'T'))               ?  $listaNotasRecibos->where('pagoreceita', $request->pago) : $listaNotasRecibos;
        $listaNotasRecibos = (!is_null($request->dtInicioRecebimento)) && (!is_null($request->dtFimRecebimento) ) ?  $listaNotasRecibos->whereBetween('datapagamentoreceita', [$request->dtInicioRecebimento, $request->dtFimRecebimento]) : $listaNotasRecibos;

        $listaNotasRecibos = $listaNotasRecibos->get();

        return $listaNotasRecibos;
    }

    public function indexOld(Request $request)
    {
        if ($request->ajax()) {

            // $consulta = new NotasRecibos();
            // $data = NotasRecibos::consultaNotasRecibos();
            $data = NotasRecibos::latest()->get();
            //  var_dump($data);
            //  exit;
            // $data = NotasRecibos::consultaNotasRecibos()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $dtemissao      = $request->get('dtemissao');
                    $nfrecibo       = $request->get('nfrecibo');
                    $idOS           = $request->get('idOS');
                    $valorNfRecibo  = $request->get('valorNfRecibo');
                    $idaliquota     = $request->get('idaliquota');
                    $valorimposto   = $request->get('valorimposto');
                    $dtRecebimento  = $request->get('dtRecebimento');
                    $nomeConta      = $request->get('nomeConta');

                    if (!empty($dtemissao)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['Emissao'], $request->get('dtemissao')) ? true : false;
                        });
                    }
                    if (!empty($nfrecibo)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['nfRecibo'], $request->get('nfrecibo')) ? true : false;
                        });
                    }
                    if (!empty($idOS)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['OS'], $request->get('idOS')) ? true : false;
                        });
                    }
                    if (!empty($valorNfRecibo)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['Valor'], $request->get('valorNfRecibo')) ? true : false;
                        });
                    }
                    if (!empty($idaliquota)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['imposto'], $request->get('idaliquota')) ? true : false;
                        });
                    }
                    if (!empty($valorimposto)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['aliquota'], $request->get('valorimposto')) ? true : false;
                        });
                    }
                    if (!empty($dtRecebimento)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['datapagamentoreceita'], $request->get('dtRecebimento')) ? true : false;
                        });
                    }
                    if (!empty($nomeConta)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['nomeConta'], $request->get('nomeConta')) ? true : false;
                        });
                    }


                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['Emissao']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['nfRecibo']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['OS']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['Valor']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['imposto']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['aliquota']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['datapagamentoreceita']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['nomeConta']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="notasrecibos/' . $row['Emissao'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {

            $data = NotasRecibos::orderBy('Emissao', 'DESC')->paginate(5);
            return view('notasrecibos.index_old', compact('data'))
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
        $notasrecibos = DB::select('SELECT * from notasrecibos');
        $readonlyOuNao = FormatacoesServiceProvider::campoReadOnly(null, 'editavel');


        return view('notasrecibos.create', compact('notasrecibos', 'readonlyOuNao'));
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

            'dtemissao'         => 'required',
            'nfrecibo'          => 'required',
            'idOS'              => 'required',
            'valorNfRecibo'     => 'required',
            'idaliquota'        => 'required',
            'tipoaliquota'      => 'required',
            'valorimposto'      => 'required',
            'dtRecebimento'     => 'required',

        ]);


        NotasRecibos::create($request->all());


        return redirect()->route('notasrecibos.index')
            ->with('success', 'Nota/Recibo criado com êxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotasRecibos  $notasrecibos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notasrecibos = NotasRecibos::find($id);
        $dadosNota = NotasRecibos::find($id);

        $readonlyOuNao = FormatacoesServiceProvider::campoReadOnly(null, 'naoeditavel');


        return view('notasrecibos.show', compact('notasrecibos', 'dadosNota', 'readonlyOuNao'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotasRecibos  $notasrecibos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notasrecibos = NotasRecibos::find($id);
        $dadosNota = NotasRecibos::find($id);

        $readonlyOuNao = FormatacoesServiceProvider::campoReadOnly(null, 'editavel');

        return view('notasrecibos.edit', compact('notasrecibos', 'dadosNota', 'readonlyOuNao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotasRecibos  $notasrecibos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'dtemissao'         => 'required',
            'nfrecibo'          => 'required',
            'idOS'              => 'required',
            'valorNfRecibo'     => 'required',
            'idaliquota'        => 'required',
            'tipoaliquota'      => 'required',
            'valorimposto'      => 'required',
            'dtRecebimento'     => 'required',
        ]);

        $notasrecibos = NotasRecibos::find($id);
        $notasrecibos->dtemissao        = $request->input('dtemissao');
        $notasrecibos->nfrecibo         = $request->input('nfrecibo');
        $notasrecibos->idOS             = $request->input('idOS');
        $notasrecibos->valorNfRecibo    = $request->input('valorNfRecibo');
        $notasrecibos->idaliquota       = $request->input('idaliquota');
        $notasrecibos->tipoaliquota     = $request->input('tipoaliquota');
        $notasrecibos->valorimposto     = $request->input('valorimposto');
        $notasrecibos->dtRecebimento    = $request->input('dtRecebimento');
        $notasrecibos->save();


        return redirect()->route('notasrecibos.index')
            ->with('success', 'Nota/Recibo atualizado com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotasRecibos  $notasrecibos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        NotasRecibos::find($id)->delete();

        return redirect()->route('notasrecibos.index')
            ->with('success', 'Nota/Recibo excluído com êxito!');
    }
}
