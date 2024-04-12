<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class MathHelper
{

    public function calculatePercent(Request $request) {
        $value1   = $request->get('value1');
        $percent  = $request->get('percent');
        $value2   = $request->get('value2');

        if ($value1 && $percent){
           return response($this->calcValueByPercent($value1, $percent), 200);
        }

        if ($value1 && $value2){
           return response($this->calcPercentWithTwoValues($value1, $value2), 200);
        }

        return response()->json(['error' => 'Parâmetros insuficientes'], 422);

    }

    public static function calcValueByPercent($valueToCalculate, $percent) {
        
        if (($valueToCalculate >= 0) && ($percent >= 0)) {
            $multipliedValue = bcmul($valueToCalculate, $percent);
            $percent = bcdiv($multipliedValue, 100); 

           return $percent;
        }
        return response()->json(['error' => 'Parâmetros insuficientes'], 422);

    }

    public static function calcPercentWithTwoValues($value1, $value2) {
        
        if (($value1 >= 0) && ($value2 >= 0)) {
            $multipliedValue = bcmul($value2, 100); //cem por cento da regra de tres
            $percent = bcdiv($multipliedValue, $value1); // divido pelo total da OS

           return $percent;
        }
        return response()->json(['error' => 'Parâmetros insuficientes'], 422);
    }

}