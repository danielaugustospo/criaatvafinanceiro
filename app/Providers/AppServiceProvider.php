<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Sandbox;
use Illuminate\Support\Facades\Cache;
use App\Enums\StatusEnumPedidoCompra;


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

        $listaDespesas = Cache::remember('listaDespesas', $minutes = 5, function () {
            return DB::table('despesas')
                ->select('id', 'descricaoDespesa', 'precoReal', 'vencimento', 'despesaCodigoDespesas', 'nRegistro', 'idOS', 'notaFiscal', 'valorparcela', 'idAutor')
                ->where('excluidoDespesa', 0)
                ->where('ativoDespesa', 1)
                ->orderByDesc('id')
                ->limit(5000)
                ->get();
        });
        
        view()->share('listaDespesas', $listaDespesas);
        
        
        view()->share('listaDespesas', $listaDespesas);

        $listaGrupoDespesas = DB::select('SELECT * FROM grupodespesas WHERE (excluidoDespesa = 0) and (ativoDespesa = 1) order by id');
        view()->share('listaGrupoDespesas', $listaGrupoDespesas);

        $listaCodigoDespesa = DB::select('SELECT * FROM codigodespesas WHERE (excluidoCodigoDespesa = 0) and (ativoCodigoDespesa = 1) order by id');
        view()->share('listaCodigoDespesa', $listaCodigoDespesa);

        $listaGrupoDespesa = DB::select('SELECT DISTINCT grupoDespesa FROM grupodespesas WHERE excluidoDespesa = 0 and ativoDespesa = 1');
        view()->share('listaGrupoDespesa', $listaGrupoDespesa);

        $listaOrdemDeServicos = DB::select('SELECT ods.id, ods.idClienteOrdemdeServico, ods.dataVendaOrdemdeServico, ods.valorOrdemdeServico,ods.dataOrdemdeServico,clientes.id as idcliente,clientes.razaosocialCliente, ods.eventoOrdemdeServico,ods.servicoOrdemdeServico,ods.obsOrdemdeServico,ods.dataCriacaoOrdemdeServico,ods.dataExclusaoOrdemdeServico,ods.ativoOrdemdeServico,ods.excluidoOrdemdeServico
        from ordemdeservico ods 
        left join `clientes` on idClienteOrdemdeServico = `clientes`.`id`');
        view()->share('listaOrdemDeServicos', $listaOrdemDeServicos);

        $pegaidOS = DB::select('SELECT * from ordemdeservico');
        view()->share('pegaidOS', $pegaidOS);

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

        $listaFormaPG = DB::select('SELECT * FROM formapagamento where ativoFormaPagamento = 1 order by nomeFormaPagamento  asc');
        view()->share('listaFormaPG', $listaFormaPG);

        $listaTiposBensPatrimoniais = DB::select('SELECT * FROM products where ativotipobenspatrimoniais = 1');
        view()->share('listaTiposBensPatrimoniais', $listaTiposBensPatrimoniais);

        $listaUnidadeMedida = DB::select('SELECT * FROM unidademedida');
        view()->share('listaUnidadeMedida', $listaUnidadeMedida);

        $listaFornecedores =  DB::select('SELECT * from fornecedores where ativoFornecedor = 1 and excluidoFornecedor = 0');
        view()->share('listaFornecedores', $listaFornecedores);

        $listaClientes =  DB::select('SELECT * from clientes where ativoCliente = 1');
        view()->share('listaClientes', $listaClientes);

        $nomeclientes =  DB::select('SELECT id, razaosocialCliente from clientes where ativoCliente = 1');
        view()->share('nomeclientes', $nomeclientes);

        $listaFuncionarios =  DB::select('SELECT * from funcionarios where ativoFuncionario = 1');
        view()->share('listaFuncionarios', $listaFuncionarios);

        $consultaNotasRecibosProvider = DB::select('SELECT distinct * from view_notasrecibos order by Emissao ASC');
        view()->share('consultaNotasRecibosProvider', $consultaNotasRecibosProvider);

        $consultaAliquotasProvider = DB::select('SELECT * from aliquotamensal');
        view()->share('consultaAliquotasProvider', $consultaAliquotasProvider);
               
        $modoSandbox = Sandbox::first();
        view()->share('modoSandbox', $modoSandbox);

    }

    public static function pegaCountPedidoAprovado($id)
    {
        $countpedidoaprovado = DB::select("SELECT count(id) as countpedidoaprovado FROM pedidocompra p where p.ped_usrsolicitante = $id	
        and ped_excluidopedido = 0 
        and (ped_aprovado = '" . StatusEnumPedidoCompra::PEDIDO_APROVADO . "' or ped_aprovado = '" . StatusEnumPedidoCompra::PEDIDO_REVISADO . "')
        and ped_novanotificacao = 1");
        return $countpedidoaprovado;
    }

    public static function pegaCountPedidoNaoAprovado($id)
    {
        $countpedidonaoaprovado = DB::select("SELECT count(id) as countpedidonaoaprovado FROM pedidocompra p where p.ped_usrsolicitante = $id	and ped_excluidopedido = 0 and p.ped_aprovado = '". StatusEnumPedidoCompra::PEDIDO_NAO_APROVADO ."'");
        return $countpedidonaoaprovado;
    }

    public static function pegaCountPedidoAguardandoAprovacao($id = null)
    {

        $whereId = (is_null($id)) ? ' ' : ' and ped_usrsolicitante = '. $id;
        $countpedidoaguardandoaprov = DB::select("SELECT count(id) as aguardaprov FROM pedidocompra p where  ped_excluidopedido = 0 and ped_aprovado = '". StatusEnumPedidoCompra::PEDIDO_AGUARDANDO_APROVACAO . "'". $whereId);
        return $countpedidoaguardandoaprov;
    }
    public static function pegaCountPedidoAguardandoAprovacaoAvaliador()
    {
        $countpedidoaguardandoaprov = DB::select("SELECT count(id) as aguardaprov FROM pedidocompra p where  ped_excluidopedido = 0 and ped_aprovado = '". StatusEnumPedidoCompra::PEDIDO_AGUARDANDO_APROVACAO . "'");
        return $countpedidoaguardandoaprov;
    }
    public static function getOptionDefault()
    {
        $optionSelect = "<option selected>Qual</option>";
        view()->share('optionSelect', $optionSelect);
    }
    

}
