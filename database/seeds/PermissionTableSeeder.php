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
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
