<?php

namespace App\Http\Controllers;

use App\Relatorio;
use App\Despesa;
use App\Conta;
use App\Clientes;
use App\CodigoDespesa;
use App\FormaPagamento;
use App\Fornecedores;
use App\Funcionario;
use App\GrupoDespesa;
use App\OrdemdeServico;
use App\Providers\FormatacoesServiceProvider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Receita;
use Illuminate\Support\Facades\DB;
use DateTime;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('permission:conta-list|conta-create|conta-edit|conta-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:conta-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:conta-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:conta-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {         
        return view('relatorio.index');
    }


    public function apiextratocontarelatorio(Request $request)
    {

        $modelConta = new Conta();
        $datainicial = $request->input('datainicial');
        $datafinal = $request->input('datafinal');
        $conta = $request->input('conta');


        $complemento = "WHERE idconta ='".$conta."' and dtoperacao  BETWEEN '".$datainicial."' AND '".$datafinal."'";
        $stringQueryExtratoConta = $modelConta->dadosRelatorio(null, $complemento);
        $extrato = DB::select($stringQueryExtratoConta);


        $tamExtrato = sizeof($extrato);
        if($tamExtrato > 0 && $tamExtrato != null){
            $tamExtrato = $tamExtrato - 1;

            for ($i=0; $i <= $tamExtrato; $i++) { 
                if($extrato[0] == $extrato[$i]){                    
                    $extrato[0]->saldoNovo = $extrato[0]->saldo; 
                }
                else {
                    $valDescrescido = $i - 1;
                    $extrato[$i]->saldoNovo = bcadd($extrato[$valDescrescido]->saldoNovo, $extrato[$i]->valorreceita, 2);
                }
            }

        }
        // $contador = count($extrato);

        // for ($i = 0; $i < $contador; $i++) {
        //     $valorAnterior = $i - 1;

        //     if (($i == 0) || ($extrato[$valorAnterior]->conta != $extrato[$i]->conta)) {
        //         $saldo = $extrato[$i]->valorreceita;
        //         $extrato[0]->saldoinicial = $saldo;

        //     } else if (($i == 1) && ($extrato[$valorAnterior]->conta == $extrato[$i]->conta)) {
        //         $saldo = $extrato[$i]->valorreceita + $extrato[$valorAnterior]->valorreceita;
        //     } else if (($i > 1)  && ($extrato[$valorAnterior]->conta == $extrato[$i]->conta)) {
        //         $saldo = $saldo + $extrato[$i]->valorreceita;
        //     } else if (($i == $contador)  && ($extrato[$valorAnterior]->conta == $extrato[$i]->conta)) {
        //         $extrato[0]->saldofinal = $saldo;
        //     }
        //     $extrato[$i]->saldo = $saldo;
        // }

        return $extrato;
    }

    public function apiAReceberPorOSRelatorio(Request $request)
    {
        $modelConta = new Conta();
        $stringRelatorioFornecedores = $modelConta->dadosRelatorioAReceberPorOS(null);
        $dadosConsulta = DB::select($stringRelatorioFornecedores);
        return $dadosConsulta;
    }
    public function apiFaturamentoPorCliente(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioFaturamentoPorCliente($request->a);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiEntradasPorContaBancaria(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioEntradasPorContaBancaria(null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiDespesasPagasPorContaBancaria(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioDespesasPagasPorContaBancaria(null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiDespesasPorOS(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioDespesasPorOS(null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiConsultaOS(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioOSCadastradas(null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiConsultaContasPagasPorGrupo(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioContas(null, $pago = " desp.pago = 'S'", $nomeFunc = null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiConsultaContasAPagarPorGrupo(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioContas(null, $pago = " desp.pago =  'N'", $nomeFunc = null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiConsultaContasAIdentificar(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioContas(null, $pago = "desp.pago = 'S' or desp.pago = 'N'", $nomeFunc = null);
        
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiConsultaProLabore(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioContas(null, $pago = null, $nomeFunc = " (func.nomeFuncionario != '') and (despesaCodigoDespesas = 33)");
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiConsultaReembolso(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosReembolso(null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiOrdemdeServicoRecebidas(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosOrdemdeServicoRecebidas(null, $parametros = "and r.idosreceita = os.id");
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiEntradaReceitaRecebidas(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosOrdemdeServicoRecebidas(null, $parametros = "and r.idosreceita = 'CRIAATVA'");
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiAReceber(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosOrdemdeServicoAReceber(null, $parametros = null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiContasAReceber(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosContasAReceber(null, $parametros = null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apiDespesasFixaVariavel(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosRelatorioDespesasPorOS(null, $parametros = null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apidadosReceitaOS(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosReceitaOS(null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function apidadosFechamentoFinal(Request $request)
    {
        $relatorio = new Relatorio();
        $stringConsulta = $relatorio->dadosFechamentoFinal(null);
        $dadosConsulta = DB::select($stringConsulta);
        return $dadosConsulta;
    }

    public function displayFluxoDeCaixa(Request $request)
    {

        $contaSelecionada   = $request->get('conta');
        $datainicial        = $request->get('datainicial');
        $modorelatorio      = $request->get('modorelatorio');


        if($modorelatorio == "analitico"){
            return view('relatorio.fluxodecaixaanalitico.index', compact('contaSelecionada','datainicial'));
        }
        else if($modorelatorio == "sintetico"){
            return view('relatorio.fluxodecaixasintetico.index', compact('contaSelecionada','datainicial'));
        }

    }

    public function apiFluxoDeCaixa(Request $request)
    {
        $conta = $request->get('conta');
        $datainicial = $request->get('datainicial');
        // $datainicial = $request->get('datainicial');
        // $datafinal = $request->get('datafinal');

        
        $anoinicial = date('Y', strtotime ($datainicial));
        $mesinicial = date('m', strtotime ($datainicial));
                
        $mesAno = $this->pegaMesCorrenteEAno($anoinicial, $mesinicial);
        $mes = $mesAno[0];
        $ano = $mesAno[1];

        $relatorio = new Relatorio();

        // $stringConsultaDespesa = $relatorio->dadosDespesaProjecaoTrimestral(null, $mes, $ano);
        // $stringConsultaDespesa = $relatorio->dadosDespesaProjecaoTrimestral(null, $mes, $ano);
        // $dadosConsultaDespesa = DB::select($stringConsultaDespesa);
        
        
        // $stringConsultaReceita = $relatorio->dadosReceitaProjecaoTrimestral(null, $mes, $ano);
        // $dadosConsultaReceita = DB::select($stringConsultaReceita);
        
        
        // $contadorReceita = count($dadosConsultaReceita);
        // if ($contadorReceita == 0) { $dadosReceita = "{}"; }  
        // else { $dadosReceita = $dadosConsultaReceita[0]; }  
        
        $stringConsulta = $relatorio->dadosFluxoDeCaixa($mes, $ano, $conta);
        $dadosConsulta = DB::select($stringConsulta);

        return $dadosConsulta;

    }

    // public function apiProjecaoTrimestral(Request $request)
    // {

    //     $mesAno = $this->pegaMesCorrenteEAno();
    //     $mes = $mesAno[0];
    //     $ano = $mesAno[1];

    //     $relatorio = new Relatorio();

    //     $stringConsultaDespesa = $relatorio->dadosDespesaProjecaoTrimestral(null, $mes, $ano);
    //     $dadosConsultaDespesa = DB::select($stringConsultaDespesa);


    //     $stringConsultaReceita = $relatorio->dadosReceitaProjecaoTrimestral(null, $mes, $ano);
    //     $dadosConsultaReceita = DB::select($stringConsultaReceita);


    //     $contadorReceita = count($dadosConsultaReceita);
    //     if ($contadorReceita == 0) { $dadosReceita = "{}"; }  
    //     else { $dadosReceita = $dadosConsultaReceita[0]; }  

    //     $dadosConsultaDespesa = $this->pegaJsonOS();

    //     return $dadosConsultaDespesa;

    //     // array_push($dadosConsultaDespesa, $dadosReceita);

    //     // return $dadosConsultaDespesa;

    //     // $dadosConsulta = array($dadosConsultaDespesa, $dadosConsultaReceita);
    //     // return $dadosConsulta;



    //     // $mesCorrente    = $mesAno[0][0];
    //     // $mesSegundo     = $mesAno[0][1];
    //     // $mesTerceiro    = $mesAno[0][2];

    //     // $anoCorrente            = $mesAno[1][0];
    //     // $anoMesCorrenteSegundo  = $mesAno[1][1];
    //     // $anoMesCorrenteTerceiro = $mesAno[1][2];

    //     // return $mesCorrente;

    // }

    public function pegaMesCorrenteEAno($anoinicial, $mesinicial)
    {
        // $mesAtual = date("m");
        $mesAtual = $mesinicial;
        $mesAtual = intval($mesAtual);

        // $anoAtual = date("Y");
        $anoAtual = $anoinicial;
        $anoAtual = intval($anoAtual);

        $segundoMes = $mesAtual + 1;
        $terceiroMes = $segundoMes + 1;

        $anoSegundoMes = $anoAtual;
        $anoTerceiroMes = $anoAtual;

        if ($segundoMes  == 13) {
            $segundoMes = 1;
            $terceiroMes = 2;
            $anoSegundoMes = $anoSegundoMes + 1;
            $anoTerceiroMes = $anoSegundoMes;
        }
        if ($terceiroMes == 13) {
            $terceiroMes = 1;
            $anoTerceiroMes = $anoTerceiroMes + 1;
        }

        if ($mesAtual    < 10) {
            $mesAtual = '0' . $mesAtual;
        }
        if ($segundoMes  < 10) {
            $segundoMes = '0' . $segundoMes;
        }
        if ($terceiroMes < 10) {
            $terceiroMes = '0' . $terceiroMes;
        }

        $arrayMes = array($mesAtual, $segundoMes, $terceiroMes);
        $arrayAno = array($anoAtual, $anoSegundoMes, $anoTerceiroMes);

        return array($arrayMes, $arrayAno);
    }

    public function limpaTabelas()
    {
         DB::delete('delete from conta');
         DB::statement('ALTER TABLE conta 
     AUTO_INCREMENT=1');

         DB::delete('delete from clientes');
         DB::statement('ALTER TABLE clientes 
     AUTO_INCREMENT=1');

         DB::delete('delete from ordemdeservico');
         DB::statement('ALTER TABLE ordemdeservico 
     AUTO_INCREMENT=1');

         DB::delete('delete from fornecedores');
         DB::statement('ALTER TABLE fornecedores 
     AUTO_INCREMENT=1');

         DB::delete('delete from formapagamento');
         DB::statement('ALTER TABLE formapagamento 
     AUTO_INCREMENT=1');

         DB::delete('delete from funcionarios');
         DB::statement('ALTER TABLE funcionarios 
     AUTO_INCREMENT=1');

         DB::delete('delete from grupodespesas');
         DB::statement('ALTER TABLE grupodespesas 
     AUTO_INCREMENT=1');

         DB::delete('delete from codigodespesas');
         DB::statement('ALTER TABLE codigodespesas 
     AUTO_INCREMENT=1');

        DB::delete('delete from despesas');
        DB::statement('ALTER TABLE despesas 
     AUTO_INCREMENT=1');

        DB::delete('delete from receita');
        DB::statement('ALTER TABLE receita 
     AUTO_INCREMENT=1');

        print_r("Tabelas limpas \n");
    }

    public function migracao()
    {
        $this->limpaTabelas();

        $this->pegaJsonContas();
        $this->pegaJsonCliente();
        $this->pegaJsonOS();
        $this->pegaJsonFornecedor();
        $this->pegaJsonFormaPagamento();
        $this->pegaJsonFuncionarios();
        $this->pegaJsonGrupoDespesas();
        $this->pegaJsonCodigoDespesas();
        $this->pegaJsonMovimentacoes();
    }

    public function pegaJsonCliente()
    {
        error_reporting(E_DEPRECATED);
        $importaCliente = file_get_contents(env('DIR_MIGRACAO') . "clientes1.json");
        $jsoncliente = json_decode($importaCliente, true);

        $qtdClientes = count((array)$jsoncliente);


        for ($contadorClientes = 0; $contadorClientes < $qtdClientes; $contadorClientes++) {
            $cliente = new Clientes();

            $cliente->id = $jsoncliente[$contadorClientes]['codcliente'];
            $cliente->razaosocialCliente = $jsoncliente[$contadorClientes]['Razão Social'];

            $salvaCliente = $cliente->save();
            print_r("Cliente " . $cliente->razaosocialCliente . " - ID " . $cliente->id . " migrado com sucesso \n");
        }
    }

    public function pegaJsonFornecedor()
    {
        error_reporting(E_DEPRECATED);
        $importaFornecedor = file_get_contents(env('DIR_MIGRACAO') . "fornecedores.json");
        $jsonfornecedor = json_decode($importaFornecedor, true);

        $qtdFornecedor = count((array)$jsonfornecedor);


        for ($contadorFornecedores = 0; $contadorFornecedores < $qtdFornecedor; $contadorFornecedores++) {
            $fornecedor = new Fornecedores();

            $fornecedor->id = null;
            $fornecedor->razaosocialFornecedor = $jsonfornecedor[$contadorFornecedores]['Razão Social'];

            $salvaFornecedor = $fornecedor->save();
            print_r("Fornecedor " . $fornecedor->razaosocialFornecedor  . " cadastrado com sucesso \n");
        }
    }

    public function pegaJsonOS()
    {
        $listaClientes = DB::select('select * from clientes where excluidoCliente = "0"');
        $totalClientes = count((array)$listaClientes);

        $importaOS = file_get_contents(env('DIR_MIGRACAO') . 'vendas1.json');
        $os = json_decode($importaOS, true);

        $totalOS = count((array)$os);
        $contadorOS = 0;
        for ($contadorOS = 0; $contadorOS < $totalOS; $contadorOS++) {
            foreach ($listaClientes as $clientes) {

                if ($os[$contadorOS]['Cliente'] == $clientes->razaosocialCliente) {
                    $os[$contadorOS]['Cliente'] = $clientes->id;
                }
            }

            $ordemdeservico = new OrdemdeServico();
            $fatorR = '0';
            if (isset($os[$contadorOS]['Valor Total'])) {
                $valorTotal = $os[$contadorOS]['Valor Total'];
            } else {
                $valorTotal = '0.00';
            }
            $ordemdeservico->id                              = $os[$contadorOS]['Numvenda'];
            $ordemdeservico->idClienteOrdemdeServico          = $os[$contadorOS]['Cliente'];
            $ordemdeservico->valorProjetoOrdemdeServico       = '0.00';
            $ordemdeservico->valorOrdemdeServico             = FormatacoesServiceProvider::validaValoresParaBackEndMigracao($valorTotal);
            $ordemdeservico->dataOrdemdeServico               = '';
            $ordemdeservico->eventoOrdemdeServico             = $os[$contadorOS]['Evento'];
            $ordemdeservico->servicoOrdemdeServico            = 'Campo Serviço';
            $ordemdeservico->obsOrdemdeServico                = '';
            $ordemdeservico->dataCriacaoOrdemdeServico        = DateTime::createFromFormat('d/m/y', $os[$contadorOS]['DataVenda'])->format("Y-m-d");
            $ordemdeservico->fatorR                           = $fatorR;
            $ordemdeservico->ativoOrdemdeServico              = '1';
            $ordemdeservico->excluidoOrdemdeServico           = '0';

            $salvaOS = $ordemdeservico->save();
            print_r("OS " . $ordemdeservico->id . " migrada com sucesso \n");
        }
    }

    public function pegaJsonFormaPagamento()
    {
        $importaformapagamento = file_get_contents(env('DIR_MIGRACAO') . "formapagamento.json");
        $jsonformapagamento = json_decode($importaformapagamento, true);

        $qtdFormaPagamento = count((array)$jsonformapagamento);

        for ($contadorFormaPagamento = 0; $contadorFormaPagamento < $qtdFormaPagamento; $contadorFormaPagamento++) {
            $formapagamento = new FormaPagamento();

            $formapagamento->id = null;
            $formapagamento->nomeFormaPagamento = $jsonformapagamento[$contadorFormaPagamento]['Formapag'];
            $formapagamento->ativoFormaPagamento = '1';
            $formapagamento->excluidoFormaPagamento = '0';

            $salvaFormaPagamento = $formapagamento->save();
            print_r("Forma de Pagamento " . $formapagamento->nomeFormaPagamento  . " cadastrada com sucesso \n");
        }
    }

    public function pegaJsonContas()
    {
        $importaconta = file_get_contents(env('DIR_MIGRACAO') . "contas.json");
        $jsonconta = json_decode($importaconta, true);

        $qtdContas = count((array)$jsonconta);

        for ($contadorContas = 0; $contadorContas < $qtdContas; $contadorContas++) {
            $conta = new Conta();

            $conta->nomeConta = $jsonconta[$contadorContas]['Conta'];
            $conta->apelidoConta = 'N/D';

            $salvaContas = $conta->save();
            print_r("Conta " . $conta->nomeConta  . " cadastrada com sucesso \n");
        }
    }

    public function pegaJsonFuncionarios()
    {
        $importafuncionario = file_get_contents(env('DIR_MIGRACAO') . "funcionarios.json");
        $jsonfuncionario = json_decode($importafuncionario, true);

        $qtdFuncionario = count((array)$jsonfuncionario);

        for ($contadorfuncionario = 0; $contadorfuncionario < $qtdFuncionario; $contadorfuncionario++) {
            $funcionario = new Funcionario();

            if (isset($jsonfuncionario[$contadorfuncionario]['Apelido'])) {
                $funcionario->nomeFuncionario = $jsonfuncionario[$contadorfuncionario]['Apelido'];
            } elseif (isset($jsonfuncionario[$contadorfuncionario]['Nome'])) {
                $funcionario->nomeFuncionario = $jsonfuncionario[$contadorfuncionario]['Nome'];
            } else {
                $funcionario->nomeFuncionario = 'SEM NOME NO ANTIGO SISTEMA';
            }
            $funcionario->id = $jsonfuncionario[$contadorfuncionario]['Codfunci'];

            $salvaFuncionario = $funcionario->save();
            print_r("Funcionário(a) " . $funcionario->nomeFuncionario  . " cadastrado(a) com sucesso \n");
        }
    }

    public function pegaJsonMovimentacoes()
    {
        $importavencimentos = file_get_contents(env('DIR_MIGRACAO') . "vencimentos.json");
        $jsonvencimentos = json_decode($importavencimentos, true);

        $qtdMovimentacoes = count((array)$jsonvencimentos);

        for ($movimentacoes = 0; $movimentacoes < $qtdMovimentacoes; $movimentacoes++) {

            // var_dump($jsonvencimentos[$movimentacoes]['Valorfat']);
            if (isset($jsonvencimentos[$movimentacoes]['Valorfat'])) {
                if (($jsonvencimentos[$movimentacoes]['Valorfat'] != 0.00) && ($jsonvencimentos[$movimentacoes]['Valorfat'] != '')) {

                    $despesa =  new Despesa();

                    //Verificação Conta
                    if (isset($jsonvencimentos[$movimentacoes]['Conta'])) {

                        $listaContas = DB::select('select * from conta where excluidoConta = "0"');

                        foreach ($listaContas as $contas) {

                            if ($jsonvencimentos[$movimentacoes]['Conta'] == $contas->nomeConta) {
                                $jsonvencimentos[$movimentacoes]['Conta'] = $contas->id;
                            }
                        }
                        $despesa->conta                  = $jsonvencimentos[$movimentacoes]['Conta'];
                    } else {
                        $despesa->conta                  = '';
                    }

                    //Verificação Fornecedor
                    if (isset($jsonvencimentos[$movimentacoes]['Fornecedor'])) {

                        $listaFornecedor = DB::select('select * from fornecedores where excluidoFornecedor = "0"');

                        foreach ($listaFornecedor as $fornecedor) {

                            if ($jsonvencimentos[$movimentacoes]['Fornecedor'] == $fornecedor->razaosocialFornecedor) {
                                $jsonvencimentos[$movimentacoes]['Fornecedor'] = $fornecedor->id;
                            }
                        }
                        $despesa->idFornecedor                  = $jsonvencimentos[$movimentacoes]['Fornecedor'];
                    } else {
                        $despesa->idFornecedor                  = '';
                    }

                    //Verificação Codfunci
                    if (isset($jsonvencimentos[$movimentacoes]['Codfunci'])) {

                        $listaFuncionario = DB::select('select * from funcionarios where excluidoFuncionario = "0"');

                        foreach ($listaFuncionario as $funcionario) {

                            if ($jsonvencimentos[$movimentacoes]['Codfunci'] == $funcionario->nomeFuncionario) {
                                $jsonvencimentos[$movimentacoes]['Codfunci'] = $funcionario->id;
                            }
                        }
                        $despesa->idFuncionario                  = $jsonvencimentos[$movimentacoes]['Codfunci'];
                    } else {
                        $despesa->idFuncionario                  = '';
                    }

                    //Verificação Formapag
                    if (isset($jsonvencimentos[$movimentacoes]['Formapag'])) {

                        $listaFormaPagamento = DB::select('select * from formapagamento where excluidoFormaPagamento != "1"');

                        foreach ($listaFormaPagamento as $formapagamento) {

                            if ($jsonvencimentos[$movimentacoes]['Formapag'] == $formapagamento->nomeFormaPagamento) {
                                $jsonvencimentos[$movimentacoes]['Formapag'] = $formapagamento->id;
                            }
                        }
                        $despesa->idFormaPagamento                  = $jsonvencimentos[$movimentacoes]['Formapag'];
                    } else {
                        $despesa->idFormaPagamento                  = '';
                    }

                    //Verificação Valorfat
                    $despesa->precoReal             =  $jsonvencimentos[$movimentacoes]['Valorfat'];
                    $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEndMigracao($despesa->precoReal);


                    $despesa->dataDaCompra          =  '';
                    $despesa->dataDoTrabalho        =  '';

                    // $despesa->quemcomprou           =  $request->get('quemcomprou');
                    // $despesa->reembolsado           =  $request->get('reembolsado');

                    //Verificação de Despesa Fixa
                    if (isset($jsonvencimentos[$movimentacoes]['Fixa'])) {
                        if (($jsonvencimentos[$movimentacoes]['Fixa'] == 'N') || ($jsonvencimentos[$movimentacoes]['Fixa'] == 'V')) {
                            $despesa->despesaFixa           =  '0';
                        } elseif (($jsonvencimentos[$movimentacoes]['Fixa'] == 'S') || ($jsonvencimentos[$movimentacoes]['Fixa'] == 'F')) {
                            $despesa->despesaFixa           =  '1';
                        }
                    } else {
                        $despesa->despesaFixa           =  '0';
                    }

                    //Verificação CodigoDespesa
                    if (isset($jsonvencimentos[$movimentacoes]['Codigo'])) {

                        $listaCodigoDespesa = DB::select('select * from codigodespesas where excluidoCodigoDespesa != "1"');

                        foreach ($listaCodigoDespesa as $codigo) {

                            if ($jsonvencimentos[$movimentacoes]['Codigo'] == $codigo->despesaCodigoDespesa) {
                                $jsonvencimentos[$movimentacoes]['Codigo'] = $codigo->id;
                            }
                        }
                        $despesa->despesaCodigoDespesas                  = $jsonvencimentos[$movimentacoes]['Codigo'];
                    } else {
                        $despesa->despesaCodigoDespesas                  = '';
                    }

                    $despesa->idDespesaPai          =  '0'; //Verificar se terão despesas filhas

                    $despesa->vale                  =  '0.00';
                    $despesa->datavale              =  '';


                    $despesa->idBanco               =  '';
                    $despesa->cheque                =  '';

                    //Verificação Registro
                    if (isset($jsonvencimentos[$movimentacoes]['Registro'])) {
                        $despesa->nRegistro                   = $jsonvencimentos[$movimentacoes]['Registro'];
                    } else {
                        $despesa->nRegistro                   = '';
                    }

                    $despesa->ativoDespesa          =  '1';
                    $despesa->excluidoDespesa       =  '0';

                    //Atribuição a financeiro@criaatva.com                    
                    $despesa->idAutor               =  '1';

                    //Verificação OS
                    if (isset($jsonvencimentos[$movimentacoes]['Numvenda'])) {
                        $despesa->idOS               = $jsonvencimentos[$movimentacoes]['Numvenda'];
                    } else {
                        $despesa->idOS               = 'CRIAATVA';
                    }

                    //Verificação Vencimento
                    if (isset($jsonvencimentos[$movimentacoes]['Datapag'])) {
                        $despesa->vencimento          = DateTime::createFromFormat('d/m/y', $jsonvencimentos[$movimentacoes]['Datapag'])->format("Y-m-d");
                    } else {
                        $despesa->vencimento          = '';
                    }

                    //Verificação NF
                    if (isset($jsonvencimentos[$movimentacoes]['NF'])) {
                        $despesa->notaFiscal            =  $jsonvencimentos[$movimentacoes]['NF'];
                    } else {
                        $despesa->notaFiscal            =  '';
                    }

                    //Verificação PG
                    if (isset($jsonvencimentos[$movimentacoes]['PG'])) {
                        $despesa->pago                  =  $jsonvencimentos[$movimentacoes]['PG'];
                    } else {
                        $despesa->pago                  =  $jsonvencimentos[$movimentacoes]['PG'];
                    }

                    //Verificação Valorfat
                    $despesa->precoReal             =  $jsonvencimentos[$movimentacoes]['Valorfat'];
                    $despesa->precoReal             =  FormatacoesServiceProvider::validaValoresParaBackEndMigracao($despesa->precoReal);

                    //Verificação Despesa
                    if (isset($jsonvencimentos[$movimentacoes]['Despesa'])) {
                        $despesa->descricaoDespesa      =  $jsonvencimentos[$movimentacoes]['Despesa'];
                    } else {
                        $despesa->descricaoDespesa      =  '';
                    }

                    $despesa->save();
                    print_r("Despesa " . $despesa->descricaoDespesa  . " cadastrada com sucesso \n");
                } elseif (isset($jsonvencimentos[$movimentacoes]['Valor'])) {
                    if (($jsonvencimentos[$movimentacoes]['Valor'] != 0.00) || ($jsonvencimentos[$movimentacoes]['Valor'] != '')) {

                        $receita = new Receita();

                        //Verificação Formapag
                        if (isset($jsonvencimentos[$movimentacoes]['Formapag'])) {

                            $listaFormaPagamento = DB::select('select * from formapagamento where excluidoFormaPagamento != "1"');

                            foreach ($listaFormaPagamento as $formapagamento) {

                                if ($jsonvencimentos[$movimentacoes]['Formapag'] == $formapagamento->nomeFormaPagamento) {
                                    $jsonvencimentos[$movimentacoes]['Formapag'] = $formapagamento->id;
                                }
                            }
                            $receita->idformapagamentoreceita                  = $jsonvencimentos[$movimentacoes]['Formapag'];
                        } else {
                            $receita->idformapagamentoreceita                  = '';
                        }

                        //Verificação Vencimento
                        if (isset($jsonvencimentos[$movimentacoes]['Datapag'])) {
                            $receita->datapagamentoreceita          = DateTime::createFromFormat('d/m/y', $jsonvencimentos[$movimentacoes]['Datapag'])->format("Y-m-d");
                        } else {
                            $receita->datapagamentoreceita          = '';
                        }

                        //Verificação Valor
                        $receita->valorreceita                  = $jsonvencimentos[$movimentacoes]['Valor'];
                        $receita->valorreceita                  = FormatacoesServiceProvider::validaValoresParaBackEndMigracao($receita->valorreceita);

                        //Verificação PG
                        if (isset($jsonvencimentos[$movimentacoes]['PG'])) {
                            $receita->pagoreceita                   = $jsonvencimentos[$movimentacoes]['PG'];
                        } else {
                            $receita->pagoreceita                   = '';
                        }


                        //Verificação Conta
                        if (isset($jsonvencimentos[$movimentacoes]['Conta'])) {

                            $listaContas = DB::select('select * from conta where excluidoConta = "0"');

                            foreach ($listaContas as $contas) {

                                if ($jsonvencimentos[$movimentacoes]['Conta'] == 'nomeConta') {
                                    $jsonvencimentos[$movimentacoes]['Conta'] = $contas->id;
                                }
                            }
                            $receita->contareceita                  = $jsonvencimentos[$movimentacoes]['Conta'];
                        } else {
                            $receita->contareceita                  = '';
                        }

                        //Verificação Receita
                        if (isset($jsonvencimentos[$movimentacoes]['Receita'])) {
                            $receita->descricaoreceita               = $jsonvencimentos[$movimentacoes]['Receita'];
                        } else {
                            $receita->descricaoreceita               = '';
                        }

                        //Verificação Registro
                        if (isset($jsonvencimentos[$movimentacoes]['Registro'])) {
                            $receita->registroreceita                   = $jsonvencimentos[$movimentacoes]['Registro'];
                        } else {
                            $receita->registroreceita                   = '';
                        }

                        //Verificação NF
                        if (isset($jsonvencimentos[$movimentacoes]['NF'])) {
                            $receita->nfreceita                     = $jsonvencimentos[$movimentacoes]['NF'];
                        } else {
                            $receita->nfreceita                     = '';
                        }

                        //Verificação Data Emissão
                        if (isset($jsonvencimentos[$movimentacoes]['Data Emissão'])) {
                            $receita->dataemissaoreceita            =  DateTime::createFromFormat('d/m/y', $jsonvencimentos[$movimentacoes]['Data Emissão'])->format("Y-m-d");
                        } else {
                            $receita->dataemissaoreceita            = '';
                        }

                        //Verificação OS
                        if (isset($jsonvencimentos[$movimentacoes]['Numvenda'])) {
                            $receita->idosreceita               = $jsonvencimentos[$movimentacoes]['Numvenda'];
                        } else {
                            $receita->idosreceita               = 'CRIAATVA';
                        }

                        //Verificação cliente
                        if (isset($jsonvencimentos[$movimentacoes]['Cliente'])) {
                            $listaClientes = DB::select('select * from clientes where excluidoCliente = "0"');
                            $totalClientes = count((array)$listaClientes);

                            foreach ($listaClientes as $clientes) {

                                if ($jsonvencimentos[$movimentacoes]['Cliente'] == $clientes->razaosocialCliente) {
                                    $jsonvencimentos[$movimentacoes]['Cliente'] = $clientes->id;
                                }
                            }
                            $receita->idclientereceita              = $jsonvencimentos[$movimentacoes]['Cliente'];
                        } else {
                            $receita->idclientereceita              = '';
                        }

                        $salvareceita = $receita->save();
                        print_r("Receita " . $receita->descricaoreceita  . " cadastrada com sucesso \n");
                    }
                }
            }
        }
    }

    public function pegaJsonGrupoDespesas()
    {
        $importagrupodespesas = file_get_contents(env('DIR_MIGRACAO') . "grupodespesas.json");
        $jsongrupodespesas = json_decode($importagrupodespesas, true);

        $qtdTotalGrupoDespesas = count((array)$jsongrupodespesas);


        for ($contadorgrupo = 0; $contadorgrupo < $qtdTotalGrupoDespesas; $contadorgrupo++) {
            $grupodespesas = new GrupoDespesa();

            if (isset($jsongrupodespesas[$contadorgrupo]['Grupo'])) {
                $grupodespesas->grupoDespesa = $jsongrupodespesas[$contadorgrupo]['Grupo'];
            } else {
                $grupodespesas->grupoDespesa = 'SEM NOME NO ANTIGO SISTEMA';
            }
            $grupodespesas->ativoDespesa = '1';
            $grupodespesas->excluidoDespesa = '0';

            $salvaGrupo = $grupodespesas->save();
            print_r("Grupo " . $grupodespesas->grupoDespesa  . " cadastrado com sucesso \n");
        }
    }

    public function pegaJsonCodigoDespesas()
    {
        $importacodigodespesas = file_get_contents(env('DIR_MIGRACAO') . "codigo_de_despesas.json");
        $jsoncodigodespesas = json_decode($importacodigodespesas, true);

        $qtdTotalcodigoDespesas = count((array)$jsoncodigodespesas);

        $listaGrupoDespesas = DB::select('select * from grupodespesas where excluidoDespesa = "0"');
        $totalGrupoDespesas = count((array)$listaGrupoDespesas);

        for ($contadorcodigo = 0; $contadorcodigo < $qtdTotalcodigoDespesas; $contadorcodigo++) {

            if ((isset($jsoncodigodespesas[$contadorcodigo]['Codigo'])) && (isset($jsoncodigodespesas[$contadorcodigo]['Grupo']))) {
                $codigodespesas = new CodigoDespesa();

                foreach ($listaGrupoDespesas as $grupo) {

                    if ($jsoncodigodespesas[$contadorcodigo]['Grupo'] == $grupo->grupoDespesa) {
                        $jsoncodigodespesas[$contadorcodigo]['Grupo'] = $grupo->id;
                    }
                }

                $codigodespesas->id = $jsoncodigodespesas[$contadorcodigo]['Codigo'];
                $codigodespesas->ativoCodigoDespesa = '1';
                $codigodespesas->excluidoCodigoDespesa = '0';

                if (isset($jsoncodigodespesas[$contadorcodigo]['Descrição da despesa'])) {
                    $codigodespesas->despesaCodigoDespesa = $jsoncodigodespesas[$contadorcodigo]['Descrição da despesa'];
                }

                if (isset($jsoncodigodespesas[$contadorcodigo]['Grupo'])) {
                    $codigodespesas->idGrupoCodigoDespesa = $jsoncodigodespesas[$contadorcodigo]['Grupo'];
                }
                $salvacodigo = $codigodespesas->save();
                print_r("Código " . $codigodespesas->despesaCodigoDespesa  . " cadastrado com sucesso \n");
            }
        }
    }
}
