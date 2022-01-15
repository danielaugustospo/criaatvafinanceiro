<?php

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;

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

//Rotas de modal
Route::get('/cadastragrupodespesa', function () { return view('grupodespesas.campos'); });
Route::get('/modalmateriais', function () { return view('benspatrimoniais.camposmodal'); });
Route::get('/modaltipomateriais', function () { return view('products.camposmodal'); });
Route::get('/modalcodigodespesa', function () { return view('codigodespesas.camposmodal'); });
Route::get('/modalfornecedor', function () { return view('fornecedores.camposmodal'); });

//Rotas de relatório
Route::get('/relatorio', function () { return view('relatorio.index'); })->name('relatorio');
Route::get('/fatporcliente', function () { return view('relatorio.fatporcliente.index'); });
Route::get('/entradaporcontabancaria', function () { return view('relatorio.entradaporcontabancaria.index'); });
Route::get('/despesaspagasporcontabancaria', function () { return view('relatorio.despesaspagasporcontabancaria.index'); });
Route::get('/despesasporos', function () { return view('relatorio.despesasporos.index'); });
Route::get('/despesassinteticaporos', function () { return view('relatorio.despesassinteticaporos.index'); });
Route::get('/despesasporclienteanalitico', function () { return view('relatorio.despesasporclienteanalitico.index'); });
Route::get('/oscadastradas', function () { return view('relatorio.oscadastradas.index'); });
Route::get('/contaspagasporgrupo', function () { return view('relatorio.contaspagasporgrupo.index'); });
Route::get('/contasapagarporgrupo', function () { return view('relatorio.contasapagarporgrupo.index'); });
Route::get('/contasaidentificar', function () { return view('relatorio.contasaidentificar.index'); });
Route::get('/fornecedor', function () { return view('relatorio.fornecedor.index'); });
Route::get('/despesasporosplanilha', function () { return view('relatorio.despesasporosplanilha.index'); });
Route::get('/ordemdeservicorecebidas', function () { return view('relatorio.ordemdeservicorecebidas.index'); });
Route::get('/osrecebidasporcliente', function () { return view('relatorio.osrecebidasporcliente.index'); });
Route::get('/entradasdereceitasrecebidas', function () { return view('relatorio.entradasdereceitasrecebidas.index'); });
Route::get('/areceberporcliente', function () { return view('relatorio.areceberporcliente.index'); });
Route::get('/areceberporos', function () { return view('relatorio.areceberporos.index'); });
Route::get('/reembolso', function () { return view('relatorio.reembolso.index'); });
Route::get('/prolabore', function () { return view('relatorio.prolabore.index'); });
Route::get('/despesasfixavariavel', function () { return view('relatorio.despesasfixavariavel.index'); });
Route::get('/notafiscalfornecedor', function () { return view('relatorio.notafiscalfornecedor.index'); });
Route::get('/notasemitidas', function () { return view('relatorio.notasemitidas.index'); });
Route::get('/notasficaisemitidascriaatva', function () { return view('relatorio.notasficaisemitidascriaatva.index'); });
Route::get('/fechamentofinal', function () { return view('relatorio.fechamentofinal.index'); });



Route::get('/contasareceberporos', function () { return view('contacorrente.contasareceberporos'); });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/resumofinanceiro', 'ContaController@resumofinanceiro')->name('resumofinanceiro');
Route::get('/contasAReceber', 'ContaController@contasAReceber')->name('contasAReceber');
Route::get('/contasAPagar', 'ContaController@contasAPagar')->name('contasAPagar');
Route::get('/relatorioFornecedores', 'FornecedorController@relatorioFornecedores')->name('relatorioFornecedores');

Route::get('/tabelaContasAReceber', 'ContaController@tabelaContasAReceber')->name('tabelaContasAReceber');
Route::get('/tabelaContasAPagar', 'ContaController@tabelaContasAPagar')->name('tabelaContasAPagar');
Route::get('/extratoConta', 'ContaController@extratoConta')->name('extratoConta');
Route::get('/tabelaExtratoConta', 'ContaController@tabelaExtratoConta')->name('tabelaExtratoConta');
Route::get('/tabelaRelatorioFornecedores', 'FornecedorController@tabelaRelatorioFornecedores')->name('tabelaRelatorioFornecedores');
Route::get('/tabelaDespesas', 'DespesaController@tabelaDespesas')->name('tabelaDespesas');
Route::get('/tabelaReceitas', 'ReceitaController@tabelaReceitas')->name('tabelaReceitas');
Route::get('/tabelaOrdemServicos', 'OrdemdeServicoController@tabelaOrdemServicos')->name('tabelaOrdemServicos');

Route::get('/listaCodigoDespesa', 'DespesaController@listaCodigoDespesa')->name('listaCodigoDespesa');
Route::get('/listaMateriais', 'DespesaController@listaMateriais')->name('listaMateriais');
Route::get('/listaFornecedores', 'DespesaController@listaFornecedores')->name('listaFornecedores');

Route::post('/retornoanalisepedido', 'PedidoCompraController@updateAprovacao')->name('retornoanalisepedido');
Route::post('/marcacomolido', 'PedidoCompraController@marcaComoLido')->name('marcacomolido');

// Route::get('/apiteste', 'BensPatrimoniaisController@apiteste')->name('apiteste');


Route::post('/salvarmodalgrupodespesa', 'GrupoDespesaController@salvarmodalgrupodespesa')->name('salvarmodalgrupodespesa');
Route::post('/cadastromateriais', 'BensPatrimoniaisController@salvarmodal')->name('cadastromateriais');
Route::post('/cadastrotipomateriais', 'ProductController@salvarmodal')->name('cadastrotipomateriais');
Route::post('/cadastrocodigodespesa', 'CodigoDespesaController@salvarmodal')->name('cadastrocodigodespesa');
Route::post('/cadastrofornecedor', 'FornecedorController@salvarmodal')->name('cadastrofornecedor');


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
    Route::resource('notasrecibos','NotasRecibosController');
    Route::resource('aliquotamensal','AliquotaMensalController');
    Route::resource('pedidocompra','PedidoCompraController');

});
