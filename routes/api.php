<?php

use App\Fornecedores;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FormaPagamentoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\PDFController;

// Rotas de autenticação
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');


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


//Rotas V1

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/apibenspatrimoniais', 'BensPatrimoniaisController@apibenspatrimoniais')->name('apibenspatrimoniais');

Route::get('/apidespesas', 'DespesaController@apidespesas')->name('apidespesas');
Route::get('/apiAliquotaMensal', 'AliquotaMensalController@apiAliquotaMensal')->name('apiAliquotaMensal');
Route::get('/apiNotasRecibos', 'NotasRecibosController@apiNotasRecibos')->name('apiNotasRecibos');

// Route::post('/apicreatedespesas', 'DespesaController@apistore')->name('apicreatedespesas');
Route::get('/apireceita', 'ReceitaController@apireceita')->name('apireceita');
Route::get('/apiestoque', 'EstoqueController@apiestoque')->name('apiestoque');
Route::get('/apientrada', 'EntradasController@apientrada')->name('apientrada');
Route::get('/apisaida', 'SaidasController@apisaida')->name('apisaida');
Route::get('/apipedidocompra', 'PedidoCompraController@apipedidocompra')->name('apipedidocompra');
Route::get('duplicidadeestoque', 'EstoqueController@verificaSeExisteNoEstoque')->name('duplicidadeestoque');

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
Route::get('/apiControleDeOrcamento', 'RelatorioController@apiControleDeOrcamento')->name('apiControleDeOrcamento');
Route::get('/apiareceber', 'RelatorioController@apiAReceber')->name('apiareceber');
Route::get('/apiareceita', 'RelatorioController@consultaIndexReceita')->name('apireceitaNovo');
Route::get('/apiconsultaprolabore', 'RelatorioController@apiConsultaProLabore')->name('apiconsultaprolabore');
Route::get('/apidespesasfixavariavel', 'RelatorioController@apiDespesasFixaVariavel')->name('apidespesasfixavariavel');
Route::get('/apidadosreceitaos', 'RelatorioController@apidadosReceitaOS')->name('apidadosreceitaos');
Route::get('/apidadosfechamentofinal', 'RelatorioController@apidadosFechamentoFinal')->name('apidadosfechamentofinal');
Route::get('/apiprojecaotrimestral', 'RelatorioController@apiProjecaoTrimestral')->name('apiprojecaotrimestral');
Route::get('/apicontasareceber', 'RelatorioController@apiContasAReceber')->name('apicontasareceber');


Route::post('/calculatePercent', '\App\Helpers\MathHelper@calculatePercent')->name('calculatePercent');

Route::middleware('auth:api')->put('/update-profile', 'UserController@updateProfile')->name('update-profile');
Route::get('/listaTipoMateriais', 'DespesaController@listaTipoMateriais')->name('apilistaTipoMateriais');
Route::get('/listaUnidadeMedida', 'BensPatrimoniaisController@listaUnidadeMedida')->name('apilistaUnidadeMedida');

Route::post('/cadastromateriais', 'BensPatrimoniaisController@salvarmodalApi')->name('apicadastromateriais');
Route::post('/cadastrotipomateriais', 'ProductController@salvarmodalApi')->name('apicadastrotipomateriais');
Route::get('/apianaliseMaterial', 'EstoqueController@apianaliseMaterial')->name('apianaliseMaterial');

Route::get('/listaContasBancarias', 'ContaController@listaContasBancariasApi')->name('listaContasBancarias');
Route::post('/contas', 'ContaController@salvarContaApi')->name('criarConta');
Route::put('/contas/{id}', 'ContaController@salvarContaApi')->name('alterarConta');
Route::delete('/contas/{id}', 'ContaController@salvarContaApi')->name('deletarConta');



// Routes v2

Route::prefix('v2')->middleware('auth:sanctum')->group(function () {
    
    #Autenticação
    Route::post('/logout', 'AuthController@logout')->name('v2logout');
    
    #Relatórios
    Route::get('/apicontasareceber', 'RelatorioController@apiContasAReceber')->name('v2apicontasareceber');
    Route::get('/apiextratocontarelatorio', 'RelatorioController@apiextratocontarelatorio')->name('v2apiextratocontarelatorio');
    Route::get('/apifluxodecaixa', 'RelatorioController@apiFluxoDeCaixa')->name('v2apifluxodecaixa');
    Route::get('/apicontaareceberporosrelatorio', 'RelatorioController@apiAReceberPorOSRelatorio')->name('v2apicontaareceberporosrelatorio');
    Route::get('/apifaturamentoporcliente', 'RelatorioController@apiFaturamentoPorCliente')->name('v2apifaturamentoporcliente');
    Route::get('/apientradaporcontabancaria', 'RelatorioController@apiEntradasPorContaBancaria')->name('v2apientradaporcontabancaria');
    Route::get('/apidespesaspagasporcontabancaria', 'RelatorioController@apiDespesasPagasPorContaBancaria')->name('v2apidespesaspagasporcontabancaria');
    Route::get('/apidespesasporos', 'RelatorioController@apiDespesasPorOS')->name('v2apidespesasporos');
    Route::get('/apiconsultaos', 'RelatorioController@apiConsultaOS')->name('v2apiconsultaos');
    Route::get('/apiconsultacontaspagasporgrupo', 'RelatorioController@apiConsultaContasPagasPorGrupo')->name('v2apiconsultacontaspagasporgrupo');
    Route::get('/apiconsultacontasapagarporgrupo','RelatorioController@apiConsultaContasAPagarPorGrupo')->name('v2apiconsultacontasapagarporgrupo');
    Route::get('/apiconsultacontasaidentificar','RelatorioController@apiConsultaContasAIdentificar')->name('v2apiconsultacontasaidentificar');
    Route::get('/apiconsultareembolso', 'RelatorioController@apiConsultaReembolso')->name('v2apiconsultareembolso');
    Route::get('/apientradareceitarecebidas', 'RelatorioController@apiEntradaReceitaRecebidas')->name('v2apientradareceitarecebidas');
    Route::get('/apiordemdeservicorecebidas', 'RelatorioController@apiOrdemdeServicoRecebidas')->name('v2apiordemdeservicorecebidas');
    Route::get('/apiControleDeOrcamento', 'RelatorioController@apiControleDeOrcamento')->name('v2apiControleDeOrcamento');
    Route::get('/apiareceber', 'RelatorioController@apiAReceber')->name('v2apiareceber');
    Route::get('/apiareceita/{id?}', 'ReceitaController@apireceita')->name('v2apireceitaNovo');
    Route::get('/apiconsultaprolabore', 'RelatorioController@apiConsultaProLabore')->name('v2apiconsultaprolabore');
    Route::get('/apidespesasfixavariavel', 'RelatorioController@apiDespesasFixaVariavel')->name('v2apidespesasfixavariavel');
    Route::get('/apidadosreceitaos', 'RelatorioController@apidadosReceitaOS')->name('v2apidadosreceitaos');
    Route::get('/apidadosfechamentofinal', 'RelatorioController@apidadosFechamentoFinal')->name('v2apidadosfechamentofinal');
    Route::get('/apiprojecaotrimestral', 'RelatorioController@apiProjecaoTrimestral')->name('v2apiprojecaotrimestral');
    Route::get('/apicontasareceber', 'RelatorioController@apiContasAReceber')->name('v2apicontasareceber');
    
    
    #Despesas
    Route::get('/apidespesas', 'DespesaController@apidespesas')->name('v2apidespesas');
    Route::get('/listaTipoMateriais', 'DespesaController@listaTipoMateriais')->name('v2apilistaTipoMateriais');
    
    #Alíquotas + Notas e Recibos
    
    Route::get('/apiAliquotaMensal', 'AliquotaMensalController@apiAliquotaMensal')->name('v2apiAliquotaMensal');
    Route::get('/apiNotasRecibos', 'NotasRecibosController@apiNotasRecibos')->name('v2apiNotasRecibos');
    
    #Pedido de Compra
    Route::get('/apipedidocompra', 'PedidoCompraController@apipedidocompra')->name('v2apipedidocompra');
    
    #Receita
    Route::get('/apireceita', 'ReceitaController@apireceita')->name('v2apireceita');
    Route::get('/apidescricaoreceita', 'ReceitaController@apiDescricaoReceita')->name('v2apidescricaoreceita');
    Route::post('/receitas', 'ReceitaController@apiStore')->name('apiStoreReceita');
    Route::put('/receitas/{id}', 'ReceitaController@apiUpdate')->name('apiUpdateReceita');

    
    #Contas
    Route::get('/listaContasBancarias', 'ContaController@listaContasBancariasApi')->name('v2listaContasBancarias');
    Route::post('/contas', 'ContaController@salvarContaApi')->name('v2criarConta');
    Route::put('/contas/{id}', 'ContaController@salvarContaApi')->name('v2alterarConta');
    Route::delete('/contas/{id}', 'ContaController@salvarContaApi')->name('v2deletarConta');
    
    #Estoque
    Route::get('/apibenspatrimoniais', 'BensPatrimoniaisController@apibenspatrimoniais')->name('v2apibenspatrimoniais');
    Route::get('/apiestoque', 'EstoqueController@apiestoque')->name('v2apiestoque');
    Route::get('/apientrada', 'EntradasController@apientrada')->name('v2apientrada');
    Route::get('/apisaida', 'SaidasController@apisaida')->name('v2apisaida');
    Route::get('duplicidadeestoque', 'EstoqueController@verificaSeExisteNoEstoque')->name('v2duplicidadeestoque');
    Route::get('/listaUnidadeMedida', 'BensPatrimoniaisController@listaUnidadeMedida')->name('v2apilistaUnidadeMedida');
    Route::post('/cadastromateriais', 'BensPatrimoniaisController@salvarmodalApi')->name('v2apicadastromateriais');
    Route::post('/cadastrotipomateriais', 'ProductController@salvarmodalApi')->name('v2apicadastrotipomateriais');
    Route::get('/apianaliseMaterial', 'EstoqueController@apianaliseMaterial')->name('v2apianaliseMaterial');
    
    #User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::get('/users', [UserController::class, 'getUsersApi']);
    Route::get('/users/{id}', [UserController::class, 'getUsersApi']);
    Route::put('/update-profile', [UserController::class, 'updateProfile'])->name('v2update-profile');
    Route::put('/update-profile/{id}', [UserController::class, 'updateProfile'])->name('v2update-profile-id');
    Route::post('/users/{id}/toggle-active', [UserController::class, 'toggleUserActive'])->middleware('permission:usuario-edit');
    Route::put('/users/{id}', [UserController::class, 'updateApi'])->middleware('permission:usuario-edit');
    Route::post('/users', [UserController::class, 'updateApi'])->middleware('permission:usuario-edit');
    Route::delete('/users/{id}', [UserController::class, 'destroyApi'])->middleware('permission:usuario-delete');
    Route::get('/userroles/{id?}', [UserController::class, 'getUserRoles']);
    Route::get('/userpermissions', [UserController::class, 'getUserPermissions']);
    
    #Roles + Permissions
    Route::get('/roles', [RoleController::class, 'getAllRolesApi']);
    Route::get('/roles/{id}', [RoleController::class, 'getRoleWithPermissionsApi']);
    Route::get('/permissions', [RoleController::class, 'getAllPermissionsApi']);
    Route::post('/roles', [RoleController::class, 'storeRoleApi']);
    Route::put('/roles/{id}', [RoleController::class, 'updateRoleApi']);
    Route::delete('/roles/{id}', [RoleController::class, 'deleteRoleApi']);
    
    #Funções comuns do sistema
    Route::post('/calculatePercent', '\App\Helpers\MathHelper@calculatePercent')->name('v2calculatePercent');   
    Route::post('/generate-pdf', [PDFController::class, 'generatePDF']);
    
    #Cliente
    Route::get('/listaclientes', [ClientesController::class, 'getClientesApi']);
    
    #Fornecedores
    Route::get('/apiFornecedores/{id?}', [FornecedorController::class, 'apiFornecedores']);
    
    #Forma de Pagamento
    Route::get('/listaformapagamento', [FormaPagamentoController::class, 'getFormadePagamentoApi']);
    
    
    #Ordem de Serviços
    Route::get('/lastOS', 'OrdemdeServicoController@lastOS')->name('v2apiordemservicoslast');
    Route::get('/apiordemdeservicos/{id?}', 'OrdemdeServicoController@apiOS')->name('v2apiordemservicos');
    Route::post('/apiordemdeservicos', 'OrdemdeServicoController@apiStore')->name('v2apiordemservicosstore');
    Route::put('/apiordemdeservicos/{id?}', 'OrdemdeServicoController@updateOSApi')->name('v2apiordemservicosupdate');
    
    Route::post('/login', 'AuthController@login')->name('v2login');
    // Route::post('/apicreatedespesas', 'DespesaController@apistore')->name('v2apicreatedespesas');
});