<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $listaDespesas = DB::select('SELECT id, descricaoDespesa, precoReal, vencimento, idCodigoDespesas, nRegistro, idOS FROM despesas WHERE (excluidoDespesa = 0) and (ativoDespesa = 1) order by id');
        view()->share('listaDespesas', $listaDespesas);


        $listaGrupoDespesas = DB::select('SELECT * FROM grupodespesas WHERE (excluidoDespesa = 0) and (ativoDespesa = 1) order by id');
        view()->share('listaGrupoDespesas', $listaGrupoDespesas);

        $listaCodigoDespesa = DB::select('SELECT * FROM codigodespesas WHERE (excluidoCodigoDespesa = 0) and (ativoCodigoDespesa = 1) order by id');
        view()->share('listaCodigoDespesa', $listaCodigoDespesa);

        $listaOrdemDeServicos = DB::select('SELECT * FROM ordemdeservico WHERE (ativoOrdemdeServico = 1) AND (excluidoOrdemdeServico = 0)');
        view()->share('listaOrdemDeServicos', $listaOrdemDeServicos);

        $listaReceitas = DB::select('SELECT * FROM receita');
        view()->share('listaReceitas', $listaReceitas);

        $listaTabela = DB::select('SELECT * FROM tabelapercentual');
        view()->share('listaTabela', $listaTabela);

        $listaUsuarios =  DB::select('SELECT * FROM users');
        view()->share('listaUsuarios', $listaUsuarios);

    }

}
