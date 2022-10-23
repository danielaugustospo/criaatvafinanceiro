<?php

namespace App\Http\Controllers;

use App\Sandbox;
use Illuminate\Http\Request;

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
        $sandbox = Sandbox::first();
        return json_encode($sandbox);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sandbox = Sandbox::updateOrCreate(
            ['id' => 1],
            ['ativo' => $request->ativo]
        );
        if ($sandbox) {
            return response($sandbox, 200);
        }else {
            return response($sandbox, 422);
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
