<?php
// app/Http/Controllers/AuthController.php

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
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;

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
            ], 200)->cookie('laravel_session', session()->getId(), 60, null, null, false, true);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    
    public function logout(Request $request)
    {
        if (Auth::check()) {
            // Se o usuário estiver logado, revoga o token (se estiver usando Sanctum ou Passport)
            if ($request->user()) {
                $request->user()->tokens()->delete(); // Revoga todos os tokens de API do usuário
            }
            
            Auth::logout(); // Logout do sistema
            $request->session()->invalidate(); // Invalida a sessão
            $request->session()->regenerateToken(); // Gera um novo token de sessão
        }
    
        return response()->json(['message' => 'Logout successful']);
    }
    
}
