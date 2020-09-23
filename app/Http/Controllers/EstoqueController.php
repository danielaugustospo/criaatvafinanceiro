<?php


namespace App\Http\Controllers;


use App\Estoque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:estoque-list|estoque-create|estoque-edit|estoque-delete', ['only' => ['index','show']]);
         $this->middleware('permission:estoque-create', ['only' => ['create','store']]);
         $this->middleware('permission:estoque-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:estoque-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Estoque::orderBy('id','DESC')->paginate(5);
        return view('estoque.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banco = DB::select('select * from banco');
        return view('estoque.create',compact('banco'));
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


        Estoque::create($request->all());


        return redirect()->route('estoque.index')
                        ->with('success','Estoque criado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estoque = Estoque::find($id);
        return view('estoque.show',compact('estoque'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estoque = Estoque::find($id);
        $roles = Estoque::pluck('nomeFuncionario','nomeFuncionario')->all();
        $estoqueRole = $estoque->roles->pluck('nomeFuncionario','nomeFuncionario')->all();

        return view('estoque.edit',compact('estoque','roles','estoqueRole'));

        // return view('estoque.edit',compact('estoque'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estoque $estoque)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


        $estoque->update($request->all());


        return redirect()->route('estoque.index')
                        ->with('success','Estoque atualizado com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Estoque::find($id)->delete();

        return redirect()->route('estoque.index')
                        ->with('success','Estoque excluído com êxito!');
    }
}
