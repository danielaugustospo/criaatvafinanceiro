<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\DB;


use App\Despesa;
use Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
// use Freshbitsweb\Laratables\Laratables;
use DataTables;
use Illuminate\Support\Str;


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

        $listaDespesas = DB::select('SELECT id, descricaoDespesa, precoReal, vencimento, idCodigoDespesas, nRegistro, idOS FROM despesas WHERE ativoDespesa = 1 order by id');

        view()->share('listaDespesas', $listaDespesas);

        $optionNao = '<option value="N">NÃO</option>';
        $optionSim = '<option value="S">SIM</option>';

        $selectSimOuNao = array($optionNao, $optionSim);
        view()->share('selectSimOuNao', $selectSimOuNao);

    }
}
