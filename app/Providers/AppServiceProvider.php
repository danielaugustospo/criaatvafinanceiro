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

        $listaBancos = DB::select('SELECT * FROM banco WHERE ativoBanco = 1');
        view()->share('listaBancos', $listaBancos);

        $listaContas = DB::select('SELECT * FROM conta WHERE ativoConta = 1');
        view()->share('listaContas', $listaContas);

        $listaOrgaosRG = DB::select('SELECT * FROM orgaorg where ativoOrgaoRG = 1');
        view()->share('listaOrgaosRG', $listaOrgaosRG);

        $listaFormaPG = DB::select('SELECT * FROM formapagamento where ativoFormaPagamento = 1');
        view()->share('listaFormaPG', $listaFormaPG);

        $listaTiposBensPatrimoniais = DB::select('SELECT * FROM products where ativotipobenspatrimoniais = 1');
        view()->share('listaTiposBensPatrimoniais', $listaTiposBensPatrimoniais);

        $listaBensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais where ativadobenspatrimoniais = 1');
        view()->share('listaBensPatrimoniais', $listaBensPatrimoniais);

        $listaEntradas = DB::select('SELECT * FROM  entradas where ativoentrada = 1');
        view()->share('listaEntradas', $listaEntradas);

        $listaSaidas = DB::select('SELECT * FROM  saidas where ativadosaida = 1');
        view()->share('listaSaidas', $listaSaidas);

        $listaInventario = DB::select('SELECT * FROM estoques where ativadoestoque = 1');
        view()->share('listaInventario', $listaInventario);

        $listaFornecedores =  DB::select('SELECT * from fornecedores where ativoFornecedor = 1');
        view()->share('listaFornecedores', $listaFornecedores);

        $listaClientes =  DB::select('SELECT * from clientes where ativoCliente = 1');
        view()->share('listaClientes', $listaClientes);

        $listaFuncionarios =  DB::select('SELECT * from funcionarios where ativoFuncionario = 1');
        view()->share('listaFuncionarios', $listaFuncionarios);

    }

}
