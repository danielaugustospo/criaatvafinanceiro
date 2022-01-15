<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormatacoesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function validaValoresParaBackEndMigracao($valorMonetario){
        $valorMonetario  = str_replace(',', '', $valorMonetario );
        return $valorMonetario;
    }

    public static function validaValoresParaBackEnd($valorMonetario){
        $SemPonto  = str_replace('.', '', $valorMonetario );
        $SemVirgula  = str_replace(',', '.', $SemPonto );
        $valorMonetario = $SemVirgula;
        return $valorMonetario;

    }
    public static function validaValoresParaView($valorMonetario){
        $ComPonto  = str_replace('', '.', $valorMonetario );
        $ComVirgula  = str_replace('.', ',', $ComPonto );
        $valorMonetario = $ComVirgula;
        return $valorMonetario;

    }

    public static function campoReadOnly($readonlyOuNao, $tipo){
        $readonlyOuNao = ('editavel' == $tipo) ? ' ' : 'readonly'; 
        return $readonlyOuNao;
        
    }

    public static function getHorarioParaBackend()
    {
    date_default_timezone_set("America/Sao_Paulo");
    return date("Y-m-d H:i:s:ms", time());
    }

   

    function mod($dividendo,$divisor)
    {
       return round($dividendo - (floor($dividendo/$divisor)*$divisor));
    }
    
    function cpf($compontos)
    {
       $n1 = rand(0,9);
       $n2 = rand(0,9);
       $n3 = rand(0,9);
       $n4 = rand(0,9);
       $n5 = rand(0,9);
       $n6 = rand(0,9);
       $n7 = rand(0,9);
       $n8 = rand(0,9);
       $n9 = rand(0,9);
       $d1 = $n9*2+$n8*3+$n7*4+$n6*5+$n5*6+$n4*7+$n3*8+$n2*9+$n1*10;
       $d1 = 11 - ( $this->mod($d1,11) );
    
       if ( $d1 >= 10 )
       { 
          $d1 = 0 ;
       }
    
       $d2 = $d1*2+$n9*3+$n8*4+$n7*5+$n6*6+$n5*7+$n4*8+$n3*9+$n2*10+$n1*11;
       $d2 = 11 - ( $this->mod($d2,11) );
    
       if ($d2>=10) { $d2 = 0 ;}
    
       $retorno = '';
    
       if ($compontos==1) {$retorno = ''.$n1.$n2.$n3.".".$n4.$n5.$n6.".".$n7.$n8.$n9."-".$d1.$d2;}
       else {$retorno = ''.$n1.$n2.$n3.$n4.$n5.$n6.$n7.$n8.$n9.$d1.$d2;}
    
       return $retorno;
    }
    
    function cnpj($compontos)
    {
       $n1 = rand(0,9);
       $n2 = rand(0,9);
       $n3 = rand(0,9);
       $n4 = rand(0,9);
       $n5 = rand(0,9);
       $n6 = rand(0,9);
       $n7 = rand(0,9);
       $n8 = rand(0,9);
       $n9 = 0;
       $n10= 0;
       $n11= 0;
       $n12= 1;
       $d1 = $n12*2+$n11*3+$n10*4+$n9*5+$n8*6+$n7*7+$n6*8+$n5*9+$n4*2+$n3*3+$n2*4+$n1*5;
       $d1 = 11 - ( $this->mod($d1,11) );
    
       if ( $d1 >= 10 )
       { 
          $d1 = 0 ;
       }
       $d2 = $d1*2+$n12*3+$n11*4+$n10*5+$n9*6+$n8*7+$n7*8+$n6*9+$n5*2+$n4*3+$n3*4+$n2*5+$n1*6;
       $d2 = 11 - ( $this->mod($d2,11) );
    
       if ($d2>=10) { $d2 = 0 ;}
    
       $retorno = '';
    
       if ($compontos==1) {$retorno = ''.$n1.$n2.".".$n3.$n4.$n5.".".$n6.$n7.$n8."/".$n9.$n10.$n11.$n12."-".$d1.$d2;}
       else {$retorno = ''.$n1.$n2.$n3.$n4.$n5.$n6.$n7.$n8.$n9.$n10.$n11.$n12.$d1.$d2;}
    
       return $retorno;
    }
}
