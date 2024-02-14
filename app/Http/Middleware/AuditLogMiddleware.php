<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\AuditLog;

class AuditLogMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (!Auth::guest()) {
            $user = Auth::user();

            if ($request->method() != 'GET') {
                // Registre o log de auditoria
                // AuditLog::create([
                //     'user_id' => $user->id,
                //     'action' => $request->method(),
                //     'model' => 'PedidoCompra', // Nome do modelo afetado
                //     // adicione mais campos e detalhes conforme necessário
                // ]);
            }

        }

        return $response;
    }
}
