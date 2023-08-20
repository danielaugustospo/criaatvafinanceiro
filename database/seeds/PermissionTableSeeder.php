<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     //Comando: php artisan db:seed --class=PermissionTableSeeder
    public function run()
    {
        $permissions = [

            // 'role-show',
            // 'role-list',
            // 'role-create',
            // 'role-edit',
            // 'role-delete',

            // 'product-show',
            // 'product-list',
            // 'product-create',
            // 'product-edit',
            // 'product-delete',

            // 'funcionario-show',
            // 'funcionario-list',
            // 'funcionario-create',
            // 'funcionario-edit',
            // 'funcionario-delete',

            // 'benspatrimoniais-show',
            // 'benspatrimoniais-list',
            // 'benspatrimoniais-create',
            // 'benspatrimoniais-edit',
            // 'benspatrimoniais-delete',

            // 'banco-show',
            // 'banco-list',
            // 'banco-create',
            // 'banco-edit',
            // 'banco-delete',

            // 'conta-show',
            // 'conta-list',
            // 'conta-create',
            // 'conta-edit',
            // 'conta-delete',

            // 'orgaorg-show',
            // 'orgaorg-list',
            // 'orgaorg-create',
            // 'orgaorg-edit',
            // 'orgaorg-delete',

            // 'fornecedor-show',
            // 'fornecedor-list',
            // 'fornecedor-create',
            // 'fornecedor-edit',
            // 'fornecedor-delete',

            // 'usuario-show',
            // 'usuario-list',
            // 'usuario-create',
            // 'usuario-edit',
            // 'usuario-delete',

            // 'estoque-show',
            // 'estoque-list',
            // 'estoque-create',
            // 'estoque-edit',
            // 'estoque-delete',

            // 'entradas-show',
            // 'entradas-list',
            // 'entradas-create',
            // 'entradas-edit',
            // 'entradas-delete',

            // 'saidas-show',
            // 'saidas-list',
            // 'saidas-create',
            // 'saidas-edit',
            // 'saidas-delete',

            // 'cliente-show',
            // 'cliente-list',
            // 'cliente-create',
            // 'cliente-edit',
            // 'cliente-delete',

            // 'formapagamento-show',
            // 'formapagamento-list',
            // 'formapagamento-create',
            // 'formapagamento-edit',
            // 'formapagamento-delete',

            // 'ordemdeservico-show',
            // 'ordemdeservico-list',
            // 'ordemdeservico-create',
            // 'ordemdeservico-edit',
            // 'ordemdeservico-delete',

            // 'codigodespesa-show',
            // 'codigodespesa-list',
            // 'codigodespesa-create',
            // 'codigodespesa-edit',
            // 'codigodespesa-delete',

            // 'despesa-show',
            // 'despesa-list',
            // 'despesa-create',
            // 'despesa-edit',
            // 'despesa-delete',
            // 'despesa-list-all',
            // 'despesa-edit-all',
            // 'despesa-delete-all',

            // 'verba-list',
            // 'verba-create',
            // 'verba-edit',
            // 'verba-delete',

            // 'tabelapercentual-show',
            // 'tabelapercentual-list',
            // 'tabelapercentual-create',
            // 'tabelapercentual-edit',
            // 'tabelapercentual-delete',

            // 'receita-show',
            // 'receita-list',
            // 'receita-create',
            // 'receita-edit',
            // 'receita-delete',

            // 'grupodespesa-show',
            // 'grupodespesa-list',
            // 'grupodespesa-create',
            // 'grupodespesa-edit',
            // 'grupodespesa-delete',

            // 'notasrecibos-show',
            // 'notasrecibos-list',
            // 'notasrecibos-create',
            // 'notasrecibos-edit',
            // 'notasrecibos-delete',

            // 'aliquotamensal-show',
            // 'aliquotamensal-list',
            // 'aliquotamensal-create',
            // 'aliquotamensal-edit',
            // 'aliquotamensal-delete',

            // 'pedidocompra-show',
            // 'pedidocompra-list',
            // 'pedidocompra-create',
            // 'pedidocompra-edit',
            // 'pedidocompra-delete',
            // 'pedidocompra-analise',

            // 'visualiza-contacorrente',
            // 'visualiza-relatoriogeral',

            //  'relatorio-list',

            // 'sandbox-list',
            // 'sandbox-modify',

            // 'rel-contasAReceber',
            // 'rel-entradasdereceitasrecebidas',
            // 'rel-entradaporcontabancaria',
            // 'rel-fatporcliente',
            // 'rel-notasemitidas',
            // 'rel-notasficaisemitidascriaatva',
            // 'rel-osrecebidasporcliente',
            // 'rel-contasapagarporgrupo',
            // 'rel-contaspagasporgrupo',
            // 'rel-despesasfixavariavel',
            // 'rel-fornecedor',
            // 'rel-notafiscalfornecedor',
            // 'rel-pclienteanalitico',
            // 'rel-despesaspagasporcontabancaria',
            // 'rel-despesasporos',
            // 'rel-despesasporosplanilha',
            // 'rel-reembolso',
            // 'rel-despesassinteticaporos',
            // 'rel-controleconsumomaterial',
            // 'rel-fechamentofinal',
            // 'configuracoes',
            // 'rel-controleorcamento'

        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
