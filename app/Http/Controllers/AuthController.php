<?php
// AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('AuthToken')->accessToken;
            // return response()->json(['token' => $token], 200);
            $user = Auth::user();

            // Pegar os IDs das roles do usuário
            $roleIds = $user->roles()->pluck('id');

            // Inicializar um array para armazenar todas as permissões
            $allPermissions = [];

            // Iterar sobre os IDs das roles
            foreach ($roleIds as $roleId) {
                // Consultar as permissões associadas a cada role
                $rolePermissions = Permission::select('id', 'name')
                    ->join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
                    ->where("role_has_permissions.role_id", $roleId)
                    ->get();

                // Adicionar as permissões encontradas ao array de todas as permissões
                $allPermissions = array_merge($allPermissions, $rolePermissions->toArray());
            }



            // Agora $allPermissions contém todas as permissões associadas às roles do usuário


            return response()->json([
                'user'  => $user,
                'allPermissions' => $allPermissions,
                'token' => $token,
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout()
    {
        // Revoga o token atual do usuário
        Auth::user()->token()->revoke();

        // Retorna uma resposta de sucesso
        return response()->json(['message' => 'Logout bem-sucedido'], 200);
    }
}
