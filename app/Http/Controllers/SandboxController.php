<?php

namespace App\Http\Controllers;

use App\Sandbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SandboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:sandbox-list|sandbox-modify', ['only' => ['index', 'store']]);
    }

    public function index()
    {
        $sandbox = Sandbox::where('idUser', Auth::id())->first();
        if (!$sandbox){
            $sandbox = Sandbox::create([
                'idUser' => Auth::id(),
                'ativo' => 0
            ]);
        }        
        return json_encode($sandbox);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Busca pelo registro no sandbox
            $sandbox = Sandbox::where('idUser', Auth::id())->first();
    
            // Se encontrou um registro, atualiza; senão, cria um novo
            if ($sandbox) {
                $sandbox->update(['ativo' => $request->ativo]);
            } else {
                $sandbox = Sandbox::create([
                    'idUser' => Auth::id(),
                    'ativo' => $request->ativo
                ]);
            }
    
            // Retorna a resposta bem-sucedida
            return response($sandbox, 200);
        } catch (\Exception $e) {
            // Retorna a resposta de erro
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sandbox  $sandbox
     * @return \Illuminate\Http\Response
     */
    public function show(Sandbox $sandbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sandbox  $sandbox
     * @return \Illuminate\Http\Response
     */
    public function edit(Sandbox $sandbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sandbox  $sandbox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sandbox $sandbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sandbox  $sandbox
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sandbox $sandbox)
    {
        //
    }
}
