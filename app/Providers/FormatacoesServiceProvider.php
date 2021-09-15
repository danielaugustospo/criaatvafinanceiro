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
}
