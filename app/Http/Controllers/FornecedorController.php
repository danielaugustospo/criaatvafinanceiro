<?php


namespace App\Http\Controllers;


use App\Fornecedores;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $banco =  DB::select('select * from bancos where id = :id', ['id' => $conta->idBanco]);
        $todososbancos =  DB::select('select distinct * from bancos');

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
            'nomeFornecedor' => 'required|min:3',

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
        return view('fornecedores.show',compact('fornecedor'));
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
        $roles = Fornecedores::pluck('nomeFornecedor','nomeFornecedor')->all();
        $fornecedorRole = $fornecedor->roles->pluck('nomeFornecedor','nomeFornecedor')->all();

        return view('fornecedores.edit',compact('fornecedor','roles','fornecedorRole'));

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
            'nomeFornecedor' => 'required',
            'codigoBanco' => 'required',
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
