<?php


namespace App\Http\Controllers;


use App\Entradas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:entradas-list|entradas-create|entradas-edit|entradas-delete', ['only' => ['index','show']]);
         $this->middleware('permission:entradas-create', ['only' => ['create','store']]);
         $this->middleware('permission:entradas-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:entradas-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Entradas::orderBy('id','DESC')->paginate(5);
        return view('entradas.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banco =  DB::select('select * from banco');

        return view('entradas.create', compact('banco'));
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


        Entradas::create($request->all());


        return redirect()->route('entradas.index')
                        ->with('success','Entrada criada com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entradas = Entradas::find($id);
        return view('entradas.show',compact('entradas'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entradas = Entradas::find($id);
        $roles = Entradas::pluck('nomeFuncionario','nomeFuncionario')->all();
        $entradasRole = $entradas->roles->pluck('nomeFuncionario','nomeFuncionario')->all();

        return view('entradas.edit',compact('entradas','roles','entradasRole'));

        // return view('entradas.edit',compact('entradas'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entradas $entradas)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


        $entradas->update($request->all());


        return redirect()->route('entradas.index')
                        ->with('success','Entrada atualizada com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entradas  $entradas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Entradas::find($id)->delete();

        return redirect()->route('entradas.index')
                        ->with('success','Entrada excluída com êxito!');
    }
}
