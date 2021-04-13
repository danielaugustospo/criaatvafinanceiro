<?php

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/tabelabanco', 'BancoController@basicLaratableData')->name('tabelabanco');
// Route::get('/tabelaOS', 'OrdemdeServicoController@basicLaratableData')->name('tabelaOS');
// Route::get('/tabelausuarios', 'UserController@basicLaratableData')->name('tabelausuarios');
// Route::get('/tabelapercentualajax', 'TabelaPercentualController@basicLaratableData')->name('tabelapercentualajax');
// Route::get('/tabelareceita', 'ReceitaController@basicLaratableData')->name('tabelareceita');
// Route::get('/tabeladespesa', 'DespesaController@basicLaratableData')->name('tabeladespesa');
// Route::get('/tabelaformapagamento', 'FormaPagamentoController@basicLaratableData')->name('tabelaformapagamento');
// Route::get('/tabelacontas', 'ContaController@basicLaratableData')->name('tabelacontas');
// Route::get('/tabelacodigodespesas', 'CodigoDespesaController@basicLaratableData')->name('tabelacodigodespesas');
// Route::get('/tabelaorgaosrg', 'OrgaosRGController@basicLaratableData')->name('tabelaorgaosrg');
// Route::get('/tabelatipobenspatrimoniais', 'ProductController@basicLaratableData')->name('tabelatipobenspatrimoniais');
// Route::get('/tabelafornecedores', 'FornecedorController@basicLaratableData')->name('tabelafornecedores');
// Route::get('/tabelagrupodespesas', 'GrupoDespesaController@basicLaratableData')->name('tabelagrupodespesas');
// Route::get('/filtraDados', 'DespesaController@filtraDados')->name('filtraDados');


Route::get('/resumofinanceiro', 'ContaController@resumofinanceiro')->name('resumofinanceiro');
Route::get('/contasAReceber', 'ContaController@contasAReceber')->name('contasAReceber');
Route::get('/contasAPagar', 'ContaController@contasAPagar')->name('contasAPagar');

Route::get('/tabelaContasAReceber', 'ContaController@tabelaContasAReceber')->name('tabelaContasAReceber');
Route::get('/tabelaContasAPagar', 'ContaController@tabelaContasAPagar')->name('tabelaContasAPagar');
Route::get('/extratoConta', 'ContaController@extratoConta')->name('extratoConta');
Route::get('/tabelaExtratoConta', 'ContaController@tabelaExtratoConta')->name('tabelaExtratoConta');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
    Route::resource('funcionarios','FuncionarioController');
    Route::resource('benspatrimoniais','BensPatrimoniaisController');
    Route::resource('bancos','BancoController');
    Route::resource('contas','ContaController');
    Route::resource('orgaosrg','OrgaosRGController');
    Route::resource('fornecedores','FornecedorController');
    Route::resource('estoque','EstoqueController');
    Route::resource('entradas','EntradasController');
    Route::resource('saidas','SaidasController');
    Route::resource('clientes','ClientesController');
    Route::resource('formapagamentos','FormaPagamentoController');
    Route::resource('ordemdeservicos','OrdemdeServicoController');
    Route::resource('codigodespesas','CodigoDespesaController');
    Route::resource('despesas','DespesaController');
    Route::resource('verbas','VerbasController');
    Route::resource('tabelapercentual','TabelaPercentualController');
    Route::resource('receita','ReceitaController');
    Route::resource('grupodespesas','GrupoDespesaController');

});
