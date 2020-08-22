<?php


namespace App\Http\Controllers;


use App\Saidas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class SaidasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:saidas-list|saidas-create|saidas-edit|saidas-delete', ['only' => ['index','show']]);
         $this->middleware('permission:saidas-create', ['only' => ['create','store']]);
         $this->middleware('permission:saidas-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:saidas-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Saidas::orderBy('id','DESC')->paginate(5);
        return view('saidas.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('saidas.create');
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

            'nomeBensPatrimoniais'      => 'required|min:3',
            'idTipoBensPatrimoniais'    => 'required',
            'descricaoBensPatrimoniais' => 'required',
            'ativadoBensPatrimoniais'   => 'required',
            'excluidoBensPatrimoniais'  => 'required',


        ]);


        Saidas::create($request->all());


        return redirect()->route('saidas.index')
                        ->with('success','Saída criada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saidas = Saidas::find($id);
        return view('saidas.show',compact('saidas'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saidas = Saidas::find($id);
        $roles = Saidas::pluck('nomeFuncionario','nomeFuncionario')->all();
        $saidaRole = $saidas->roles->pluck('nomeFuncionario','nomeFuncionario')->all();

        return view('saidas.edit',compact('saidas','roles','saidaRole'));

        // return view('saidas.edit',compact('saidas'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saidas $saidas)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


        $saidas->update($request->all());


        return redirect()->route('saidas.index')
                        ->with('success','Saída atualizada com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saidas  $saidas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Saidas::find($id)->delete();

        return redirect()->route('saidas.index')
                        ->with('success','Saída excluído com êxito!');
    }
}
