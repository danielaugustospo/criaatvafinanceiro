<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


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

        $listaDespesas = DB::select('SELECT id, descricaoDespesa, precoReal, vencimento, despesaCodigoDespesas, nRegistro, idOS, notaFiscal, valorparcela FROM despesas WHERE (excluidoDespesa = 0) and (ativoDespesa = 1) order by id');
        view()->share('listaDespesas', $listaDespesas);

        $listaDescricaoDespesa = DB::select('SELECT id, descricaoDespesa FROM despesas WHERE (excluidoDespesa = 0) and (ativoDespesa = 1) ');
        view()->share('listaDescricaoDespesa', $listaDescricaoDespesa);

        $listaGrupoDespesas = DB::select('SELECT * FROM grupodespesas WHERE (excluidoDespesa = 0) and (ativoDespesa = 1) order by id');
        view()->share('listaGrupoDespesas', $listaGrupoDespesas);

        $listaCodigoDespesa = DB::select('SELECT * FROM codigodespesas WHERE (excluidoCodigoDespesa = 0) and (ativoCodigoDespesa = 1) order by id');
        view()->share('listaCodigoDespesa', $listaCodigoDespesa);

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

        $listaFormaPG = DB::select('SELECT * FROM formapagamento where ativoFormaPagamento = 1');
        view()->share('listaFormaPG', $listaFormaPG);

        $listaTiposBensPatrimoniais = DB::select('SELECT * FROM products where ativotipobenspatrimoniais = 1');
        view()->share('listaTiposBensPatrimoniais', $listaTiposBensPatrimoniais);

        $listaBensPatrimoniais = DB::select('SELECT * FROM benspatrimoniais where ativadobenspatrimoniais = 1');
        view()->share('listaBensPatrimoniais', $listaBensPatrimoniais);

        $listaEntradas = DB::select('SELECT e.*, b.nomeBensPatrimoniais 
                                        FROM  entradas e 
                                        LEFT JOIN benspatrimoniais b on e.idbenspatrimoniais = b.id
                                        where e.excluidoentrada = 0');
        view()->share('listaEntradas', $listaEntradas);

        $listaSaidas = DB::select('SELECT s.*, b.nomeBensPatrimoniais 
                                    FROM  saidas s 
                                    LEFT JOIN benspatrimoniais b on s.idbenspatrimoniais = b.id
                                    WHERE s.excluidosaida = 0');
        view()->share('listaSaidas', $listaSaidas);

        $listaInventario = DB::select('SELECT * FROM estoque where ativadoestoque = 1  and excluidoestoque = 0');
        view()->share('listaInventario', $listaInventario);

        $listaInventarioaDevolver = DB::select('SELECT * FROM estoque where ativadoestoque = 0 and excluidoestoque = 0');
        view()->share('listaInventarioaDevolver', $listaInventarioaDevolver);

        $listaFornecedores =  DB::select('SELECT * from fornecedores where ativoFornecedor = 1');
        view()->share('listaFornecedores', $listaFornecedores);

        $listaClientes =  DB::select('SELECT * from clientes where ativoCliente = 1');
        view()->share('listaClientes', $listaClientes);

        $nomeclientes =  DB::select('SELECT id, razaosocialCliente from clientes where ativoCliente = 1');
        view()->share('nomeclientes', $nomeclientes);

        $listaFuncionarios =  DB::select('SELECT * from funcionarios where ativoFuncionario = 1');
        view()->share('listaFuncionarios', $listaFuncionarios);

        $listaContasAPagar =  DB::select('SELECT d.id as idDespesa, d.idOS, d.vencimento, d.precoReal as preco, d.notaFiscal as notaFiscal,
        os.id as idDaOS, os.eventoOrdemdeServico as evento, os.idClienteOrdemdeServico,
        cli.id as idCliente, cli.nomeCliente, cli.agenciaCliente1 as agencia1, cli.agenciaCliente2 as agencia2, cli.agenciaCliente3 as agencia3
        from despesas d, ordemdeservico os, clientes cli
        where (os.idClienteOrdemdeServico = cli.id)
        and (d.idOS = os.id) 
        and (d.pago = "N")');
        view()->share('listaContasAPagar', $listaContasAPagar);

        $listaContasAReceber = DB::select("SELECT r.valorreceita as preco, r.datapagamentoreceita as vencimento, c.id as idConta, c.apelidoConta as agencia, r.idosreceita as idOS, cli.nomeCliente, os.idClienteOrdemdeServico as idCliente, os.eventoOrdemdeServico as evento, r.nfreceita as notaFiscal
        from receita r, conta c, ordemdeservico os, clientes cli
        where pagoreceita = 'N' and r.contareceita = c.id 
        and r.idosreceita = os.id
        and os.idClienteOrdemdeServico = cli.id");
        view()->share('listaContasAReceber', $listaContasAReceber);

        $listaReceitasEDespesas = DB::select('SELECT r.id, r.valorreceita from receita r union all (select d.id, d.precoReal  from despesas d)');
        view()->share('listaReceitasEDespesas', $listaReceitasEDespesas);

        $consultaNotasRecibosProvider = DB::select('SELECT distinct * from view_notasrecibos order by Emissao ASC');
        view()->share('consultaNotasRecibosProvider', $consultaNotasRecibosProvider);

        $consultaAliquotasProvider = DB::select('SELECT * from aliquotamensal');
        view()->share('consultaAliquotasProvider', $consultaAliquotasProvider);
    }

    public static function pegaCountPedidoAprovado($id)
    {
        $countpedidoaprovado = DB::select("SELECT count(id) as countpedidoaprovado FROM pedidocompra p where p.ped_usrsolicitante = $id	
        and ped_excluidopedido = 0 
        and ped_aprovado = 1
        and ped_novanotificacao = 1");
        return $countpedidoaprovado;
    }

    public static function pegaCountPedidoNaoAprovado($id)
    {
        $countpedidonaoaprovado = DB::select("SELECT count(id) as countpedidonaoaprovado FROM pedidocompra p where p.ped_usrsolicitante = $id	and ped_excluidopedido = 0 and p.ped_aprovado = 0");
        return $countpedidonaoaprovado;
    }

    public static function pegaCountPedidoAguardandoAprovacao()
    {
        $countpedidoaguardandoaprov = DB::select('SELECT count(id) as aguardaprov FROM pedidocompra p where  ped_excluidopedido = 0 and ped_aprovado = 3');
        return $countpedidoaguardandoaprov;
    }
    public static function getOptionDefault()
    {
        $optionSelect = "<option selected>Qual</option>";
        view()->share('optionSelect', $optionSelect);
    }
}
