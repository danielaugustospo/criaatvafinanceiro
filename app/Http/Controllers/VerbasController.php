<?php


namespace App\Http\Controllers;


use App\Verba;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class VerbasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:verba-list|verba-create|verba-edit|verba-delete', ['only' => ['index','show']]);
         $this->middleware('permission:verba-create', ['only' => ['create','store']]);
         $this->middleware('permission:verba-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:verba-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Verba::orderBy('id','DESC')->paginate(5);
        return view('verbas.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('verbas.create');
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

            'idFormaPagamento'  => 'required',
            'dataPagamento'     => 'required',
            'descricaoVerba'    => 'required',
            'dataEmissao'       => 'required',
            'valorVerba'        => 'required',
            'pagamentoVerba'    => 'required',
            'contaVerba'        => 'required',
            'registroVerba'     => 'required',
            'emissaoVerba'      => 'required',
            'nfVerba'           => 'required',
            'valorTotalVerba'   => 'required',
            'idOSVerba'         => 'required',
            'ativoVerba'        => 'required',
            'excluidoVerba'     => 'required',

        ]);


        Verba::create($request->all());


        return redirect()->route('verbas.index')
                        ->with('success','Verba cadastrada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Banco  $verba
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $verba = Verba::find($id);
        return view('verbas.show',compact('verba'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banco  $verba
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $verba = Verba::find($id);
        $roles = Verba::pluck('nomeBanco','nomeBanco')->all();
        $verbaRole = $verba->roles->pluck('nomeBanco','nomeBanco')->all();

        return view('verbas.edit',compact('verba','roles','bancoRole'));

        // return view('verbas.edit',compact('verba'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banco  $verba
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verba $verba)
    {
         request()->validate([
            'nomeBanco' => 'required',
            'codigoBanco' => 'required',
        ]);


        $verba->update($request->all());


        return redirect()->route('verbas.index')
                        ->with('success','Verba atualizada com êxito');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banco  $verba
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Verba::find($id)->delete();

        return redirect()->route('verbas.index')
                        ->with('success','Verba excluída com êxito!');
    }
}
