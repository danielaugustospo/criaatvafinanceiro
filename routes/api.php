<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/apibenspatrimoniais', 'BensPatrimoniaisController@apibenspatrimoniais')->name('apibenspatrimoniais');
Route::get('/apidespesas', 'DespesaController@apidespesas')->name('apidespesas');
Route::get('/apireceita', 'ReceitaController@apireceita')->name('apireceita');
Route::get('/apiestoque', 'EstoqueController@apiestoque')->name('apiestoque');
Route::get('/apientrada', 'EntradasController@apientrada')->name('apientrada');
Route::get('/apisaida', 'SaidasController@apisaida')->name('apisaida');
Route::get('/apipedidocompra', 'PedidoCompraController@apipedidocompra')->name('apipedidocompra');

Route::get('/apiextratocontarelatorio', 'RelatorioController@apiextratocontarelatorio')->name('apiextratocontarelatorio');
Route::get('/apifluxodecaixa', 'RelatorioController@apiFluxoDeCaixa')->name('apifluxodecaixa');
Route::get('/apicontaareceberporosrelatorio', 'RelatorioController@apiAReceberPorOSRelatorio')->name('apicontaareceberporosrelatorio');
Route::get('/apifaturamentoporcliente', 'RelatorioController@apiFaturamentoPorCliente')->name('apifaturamentoporcliente');
Route::get('/apientradaporcontabancaria', 'RelatorioController@apiEntradasPorContaBancaria')->name('apientradaporcontabancaria');
Route::get('/apidespesaspagasporcontabancaria', 'RelatorioController@apiDespesasPagasPorContaBancaria')->name('apidespesaspagasporcontabancaria');
Route::get('/apidespesasporos', 'RelatorioController@apiDespesasPorOS')->name('apidespesasporos');
Route::get('/apiconsultaos', 'RelatorioController@apiConsultaOS')->name('apiconsultaos');
Route::get('/apiconsultacontaspagasporgrupo', 'RelatorioController@apiConsultaContasPagasPorGrupo')->name('apiconsultacontaspagasporgrupo');
Route::get('/apiconsultacontasapagarporgrupo','RelatorioController@apiConsultaContasAPagarPorGrupo')->name('apiconsultacontasapagarporgrupo');
Route::get('/apiconsultacontasaidentificar','RelatorioController@apiConsultaContasAIdentificar')->name('apiconsultacontasaidentificar');
Route::get('/apiconsultareembolso', 'RelatorioController@apiConsultaReembolso')->name('apiconsultareembolso');
Route::get('/apientradareceitarecebidas', 'RelatorioController@apiEntradaReceitaRecebidas')->name('apientradareceitarecebidas');
Route::get('/apiordemdeservicorecebidas', 'RelatorioController@apiOrdemdeServicoRecebidas')->name('apiordemdeservicorecebidas');
Route::get('/apiareceber', 'RelatorioController@apiAReceber')->name('apiareceber');
Route::get('/apiareceita', 'RelatorioController@consultaIndexReceita')->name('apireceita');
Route::get('/apicontasareceber', 'RelatorioController@apiContasAReceber')->name('apicontasareceber');
Route::get('/apiconsultaprolabore', 'RelatorioController@apiConsultaProLabore')->name('apiconsultaprolabore');
Route::get('/apidespesasfixavariavel', 'RelatorioController@apiDespesasFixaVariavel')->name('apidespesasfixavariavel');
Route::get('/apidadosreceitaos', 'RelatorioController@apidadosReceitaOS')->name('apidadosreceitaos');
Route::get('/apidadosfechamentofinal', 'RelatorioController@apidadosFechamentoFinal')->name('apidadosfechamentofinal');
Route::get('/apiprojecaotrimestral', 'RelatorioController@apiProjecaoTrimestral')->name('apiprojecaotrimestral');

