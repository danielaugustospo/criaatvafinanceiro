<?php


namespace App\Http\Controllers;


use App\BensPatrimoniais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class BensPatrimoniaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:benspatrimoniais-list|benspatrimoniais-create|benspatrimoniais-edit|benspatrimoniais-delete', ['only' => ['index','show']]);
         $this->middleware('permission:benspatrimoniais-create', ['only' => ['create','store']]);
         $this->middleware('permission:benspatrimoniais-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:benspatrimoniais-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = BensPatrimoniais::orderBy('id','DESC')->paginate(5);
        return view('benspatrimoniais.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('benspatrimoniais.create');
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


        BensPatrimoniais::create($request->all());


        return redirect()->route('benspatrimoniais.index')
                        ->with('success','Bem Patrimonial criado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\BensPatrimoniais  $benspatrimoniais
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $benspatrimoniais = BensPatrimoniais::find($id);
        return view('benspatrimoniais.show',compact('benspatrimoniais'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BensPatrimoniais  $benspatrimoniais
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $benspatrimoniais = BensPatrimoniais::find($id);
        $roles = BensPatrimoniais::pluck('nomeFuncionario','nomeFuncionario')->all();
        $funcionarioRole = $benspatrimoniais->roles->pluck('nomeFuncionario','nomeFuncionario')->all();

        return view('benspatrimoniais.edit',compact('benspatrimoniais','roles','funcionarioRole'));

        // return view('bensPatrimoniais.edit',compact('benspatrimoniais'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BensPatrimoniais  $benspatrimoniais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BensPatrimoniais $benspatrimoniais)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


        $benspatrimoniais->update($request->all());


        return redirect()->route('benspatrimoniais.index')
                        ->with('success','Bem Patrimonial atualizado com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BensPatrimoniais  $benspatrimoniais
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        BensPatrimoniais::find($id)->delete();

        return redirect()->route('benspatrimoniais.index')
                        ->with('success','Bem Patrimonial excluído com êxito!');
    }
}
