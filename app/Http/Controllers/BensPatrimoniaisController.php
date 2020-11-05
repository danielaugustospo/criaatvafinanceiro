<?php


namespace App\Http\Controllers;


use App\BensPatrimoniais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


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
        $tipoBensPatrimoniais =  DB::select('select distinct * from products where ativotipobenspatrimoniais = 1 and excluidotipobenspatrimoniais = 0;');

        return view('benspatrimoniais.create', compact('tipoBensPatrimoniais'));
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
            'statusbenspatrimoniais'    => 'required',
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
        $tipoBensPatrimoniais =  DB::select('select distinct * from products where ativotipobenspatrimoniais = 1 and excluidotipobenspatrimoniais = 0;');

        return view('benspatrimoniais.edit',compact('benspatrimoniais','tipoBensPatrimoniais'));

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

            'nomeBensPatrimoniais'          => 'required',
            'idTipoBensPatrimoniais'        => 'required',
            'descricaoBensPatrimoniais'     => 'required',
            'ativadoBensPatrimoniais'       => 'required',
            'excluidoBensPatrimoniais'      => 'required',
            'statusbenspatrimoniais'        => 'required',
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
