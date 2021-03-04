<?php


namespace App\Http\Controllers;


use App\OrgaoRG;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Freshbitsweb\Laratables\Laratables;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
        if ($request->ajax()) {

            $data = OrgaoRG::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $nome = $request->get('nome');
                    $estadoOrgaoRG = $request->get('estadoOrgaoRG');
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($nome)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['nome'], $request->get('nome')) ? true : false;
                        });
                    }
                    if (!empty($estadoOrgaoRG)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['estadoOrgaoRG'], $request->get('estadoOrgaoRG')) ? true : false;
                        });
                    }
                    

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::contains(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['nome']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['estadoOrgaoRG']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="orgaosrg/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {

        $data = OrgaoRG::orderBy('id','DESC')->paginate(5);
        return view('orgaosrg.index',compact('data'))
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
    public function update(Request $request, $id)
    {
         $request->validate([
            'nome' => 'required|min:3',
            'estadoOrgaoRG'  => 'required'
        ]);

        $orgaorg = OrgaoRG::find($id);
        $orgaorg->nome = $request->input('nome');
        $orgaorg->estadoOrgaoRG = $request->input('estadoOrgaoRG');
        $orgaorg->save();


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
