<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getTimeRemaining()
    {
        $expiresAt = session()->get('expires_at');
        $currentTime = now();
        $remainingTime = $expiresAt->diffInSeconds($currentTime);
        return response()->json(['remaining_time' => $remainingTime]);
    }
}
