<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Arr as Arr;
use App\Sandbox;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:usuario-list|usuario-create|usuario-edit|usuario-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:usuario-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:usuario-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:usuario-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    $id = $request->get('id');
                    $name = $request->get('name');
                    $email = $request->get('email');
                    $ativoUser = $request->get('ativoUser');
                    if (!empty($id)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['id'], $request->get('id')) ? true : false;
                        });
                    }
                    if (!empty($name)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['name'], $request->get('name')) ? true : false;
                        });
                    }
                    if (!empty($email)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['email'], $request->get('email')) ? true : false;
                        });
                    }
                    if (!empty($ativoUser)) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::is($row['ativoUser'], $request->get('ativoUser')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {

                            if (Str::is(Str::lower($row['id']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['name']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['email']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::is(Str::lower($row['ativoUser']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('action', function ($row) {

                    $btnVisualizar = '<a href="users/' . $row['id'] . '" class="edit btn btn-primary btn-sm">Visualizar</a>';
                    return $btnVisualizar;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            $data = User::orderBy('id', 'DESC')->paginate(5);
            return view('users.index', compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }


    public function getUserRoles($id = null)
    {
        // Buscar usuário por ID ou autenticado
        $user = $id ? User::find($id) : Auth::user();
    
        // Verificar se o usuário existe
        if (!$user) {
            return response()->json(['error' => 'Usuário não autenticado ou não existe'], 401);
        }
    
        // Assumindo que você está usando o Spatie Permission Package para buscar os nomes das roles
        $roles = $user->roles()->pluck('name');
    
        return response()->json([
            'roles' => $roles,
        ], 200);
    }

    public function getUserPermissions(Request $request)
    {
        // Obter o usuário autenticado
        $user = Auth::user();

        // Obter as permissões do usuário
        $permissions = $user->getAllPermissions()->pluck('name');

        // Retornar as permissões como uma resposta JSON
        return response()->json([
            'permissions' => $permissions,
        ], 200);
    }

    public function getUsersApi($id = null){
        $users = User::where('excluidoUser',0);
        if($id){
            $users =  $users->where('id', $id);
        }

        $users =  $users->get();
        return response()->json([
            'users' => $users,
        ], 200);
    }

    public function toggleUserActive($id)
    {
        $user = User::findOrFail($id);
        $user->ativoUser = !$user->ativoUser;
        $user->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Status do usuário atualizado com sucesso.',
            'active' => $user->ativoUser
        ]);
    }

    public function updateApi(Request $request, $id = null)
    {
    
        // Regras de validação
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|same:confirmPassword',
        ];
    
        $this->validate($request, $rules);
    
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
    
        $user = User::find($id);
        if (!$user) {
            $user = User::where('email', $request->email)->first();
            
            if (!$user) {
                $user = User::create($input);
                $user->assignRole($request->input('roles'));
                return response()->json([
                    'success' => true,
                    'message' => 'Dados de usuário atualizados com sucesso',
                    'user' => $user
                ], 200);
                // return response()->json(['message' => 'Usuário não encontrado'], 404);
            }
            $id = $user->id;
        }
    
        $user->update($input);
    
        // if ($request->input('roles')) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->input('roles'));
        // }
    
        return response()->json([
            'success' => true,
            'message' => 'Dados de usuário atualizados com sucesso',
            'user' => $user
        ], 200);
    }
    
        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        // Popule a tabela sandbox
        Sandbox::create([
            'ativo'       => 0,
            'idUser'      => $user->id,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuário ' . $request->name . ' adicionado!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();


        return view('users.edit', compact('user', 'roles', 'userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success', 'Dados de usuário atualizados com sucesso');
    }
    


    public function updateProfile(Request $request, $id = null)
    {
        $user = Auth::user(); // Recupera o usuário autenticado
        if ($user->id == $id || is_null($id)){
            $input = $request->all();

            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }
    
            $user = User::find($id);
            $user->update($input);
            return response()->json(['message' => 'Perfil atualizado com sucesso'], 200);
        }else{
            return response()->json(['message' => 'Usuário não confere'], 403);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Usuário removido!');
    }

    public function destroyApi($id)
    {
        $user = User::findOrFail($id);
        $user->excluidoUser = 1; // Assumindo que 1 significa inativo.
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuário excluído com sucesso'
        ], 200);
    }

}
