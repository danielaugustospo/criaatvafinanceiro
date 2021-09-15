<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Log;
use Auth;

class Logger{

    public function log($level, $message)
    {
        if ((Auth::user()->id != '') || (Auth::user()->id != NULL)){
            $message = Auth::user()->email . ' '.  $message;

        } else{
            $message = 'Email não capturado '. $message;
        }

        Log::channel('single')->$level($message);
    }
}