<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(20);
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function getAllPermissionsApi(Request $request)
    {
        $permission = Permission::get();
        return response()->json($permission);
    }

    public function getAllRolesApi()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function getRoleWithPermissionsApi($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }

        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return response()->json([
            'role' => $role,
            'permissions' => $rolePermissions
        ]);
    }

    public function storeRoleApi(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array|min:1',
        ]);
    
        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
        $permissions = Permission::whereIn('id', $request->input('permissions'))
        ->where('guard_name', 'web')
        ->get();
        
        if ($permissions->isEmpty()) {
            return response()->json(['error' => 'No permissions found for the specified guard.'], 400);
        }
        
        $role->syncPermissions($permissions);
        
        return response()->json(['success' => 'Role created successfully', 'role' => $role], 201);
    }
    
    public function deleteRoleApi($id)
    {
        $role = Role::find($id);
        
        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }
    
        $role->delete();
    
        return response()->json(['success' => 'Role deleted successfully'], 200);
    }
    

    public function updateRoleApi(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id,
            'permissions' => 'required|array|min:1',
        ]);
    
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }
    
        $role->name = $request->input('name');
        $role->guard_name = 'web';
        $role->save();
    
        $permissions = Permission::whereIn('id', $request->input('permissions'))
            ->where('guard_name', 'web')
            ->get();
    
        if ($permissions->isEmpty()) {
            return response()->json(['error' => 'No permissions found for the specified guard.'], 400);
        }
    
        $role->syncPermissions($permissions);
    
        return response()->json(['success' => 'Role updated successfully', 'role' => $role]);
    }
    
    

    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Regra cadastrada com sucesso');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Regra atualizada com sucesso');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Regra excluída com sucesso');
    }
}
