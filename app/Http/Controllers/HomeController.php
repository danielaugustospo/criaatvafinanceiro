<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $currentTime = Carbon::now();
        
        if (!$expiresAt) {
            return response()->json(['remaining_time' => null]);
        }
        
        $remainingTime = optional($expiresAt)->diffInSeconds($currentTime);
        
        return response()->json(['remaining_time' => $remainingTime]);
    }
}
