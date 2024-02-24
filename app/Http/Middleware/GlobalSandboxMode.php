<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Sandbox;

class GlobalSandboxMode
{
    public function handle($request, Closure $next)
    {
        $modoSandbox = new Sandbox();
        $modoSandbox->ativo = 0;

        $user = Auth::user();
        if ($user && isset($user->sandbox)) {
            $modoSandbox = $user->sandbox;
        }

        view()->share('modoSandbox', $modoSandbox);
        return $next($request);
    }
}
