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

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

            'funcionario-list',
            'funcionario-create',
            'funcionario-edit',
            'funcionario-delete',

            'benspatrimoniais-list',
            'benspatrimoniais-create',
            'benspatrimoniais-edit',
            'benspatrimoniais-delete',

            'banco-list',
            'banco-create',
            'banco-edit',
            'banco-delete',

            'conta-list',
            'conta-create',
            'conta-edit',
            'conta-delete',

            'orgaorg-list',
            'orgaorg-create',
            'orgaorg-edit',
            'orgaorg-delete',

            'fornecedor-list',
            'fornecedor-create',
            'fornecedor-edit',
            'fornecedor-delete',

            'usuario-list',
            'usuario-create',
            'usuario-edit',
            'usuario-delete',

            'estoque-list',
            'estoque-create',
            'estoque-edit',
            'estoque-delete',

            'entradas-list',
            'entradas-create',
            'entradas-edit',
            'entradas-delete',

            'saidas-list',
            'saidas-create',
            'saidas-edit',
            'saidas-delete',

            'cliente-list',
            'cliente-create',
            'cliente-edit',
            'cliente-delete',

            'formapagamento-list',
            'formapagamento-create',
            'formapagamento-edit',
            'formapagamento-delete',

            'ordemdeservico-list',
            'ordemdeservico-create',
            'ordemdeservico-edit',
            'ordemdeservico-delete',

            'codigodespesa-list',
            'codigodespesa-create',
            'codigodespesa-edit',
            'codigodespesa-delete',

            'despesa-list',
            'despesa-create',
            'despesa-edit',
            'despesa-delete',

            'verba-list',
            'verba-create',
            'verba-edit',
            'verba-delete',

            'tabelapercentual-list',
            'tabelapercentual-create',
            'tabelapercentual-edit',
            'tabelapercentual-delete',

            'receita-list',
            'receita-create',
            'receita-edit',
            'receita-delete',

            'grupodespesa-list',
            'grupodespesa-create',
            'grupodespesa-edit',
            'grupodespesa-delete',
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
