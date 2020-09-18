<?php


namespace App\Http\Controllers;


use App\OrgaoRG;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshbitsweb\Laratables\Laratables;
use Spatie\Permission\Models\Role;

class OrgaosRGController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:orgaorg-list|orgaorg-create|orgaorg-edit|orgaorg-delete', ['only' => ['index','show']]);
         $this->middleware('permission:orgaorg-create', ['only' => ['create','store']]);
         $this->middleware('permission:orgaorg-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:orgaorg-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = OrgaoRG::orderBy('id','DESC')->paginate(5);
        return view('orgaosrg.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }



    public function basicLaratableData()
    {
        return Laratables::recordsOf(OrgaoRG::class);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orgaosrg.create');
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
            'nome' => 'required|min:3',
            'estadoOrgaoRG'  => 'required',

        ]);


        OrgaoRG::create($request->all());


        return redirect()->route('orgaosrg.index')
                        ->with('success','Órgão cadastrado com êxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\OrgaoRG  $orgaorg
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orgaorg = OrgaoRG::find($id);
        return view('orgaosrg.show',compact('orgaorg'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrgaoRG  $orgaorg
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orgaorg = OrgaoRG::find($id);
        $roles = OrgaoRG::pluck('nome','nome')->all();
        $orgaorgRole = $orgaorg->roles->pluck('nome','nome')->all();

        return view('orgaosrg.edit',compact('orgaorg','roles','orgaorgRole'));

        // return view('orgaosrg.edit',compact('orgaorg'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrgaoRG  $orgaorg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrgaoRG $orgaorg)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);


        $orgaorg->update($request->all());


        return redirect()->route('orgaosrg.index')
                        ->with('success','Orgão atualizado com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrgaoRG  $orgaorg
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        OrgaoRG::find($id)->delete();

        return redirect()->route('orgaosrg.index')
                        ->with('success','Orgão excluído com êxito!');
    }
}
