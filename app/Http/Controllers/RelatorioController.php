<?php


namespace App\Http\Controllers;


use App\Relatorio;
use App\Despesa;
use App\Conta;
use App\Clientes;
use App\OrdemdeServico;
use App\Providers\FormatacoesServiceProvider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Receita;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Label;

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


    public function apiextratocontarelatorio(Request $request)
    {
        
        $modelConta = new Conta();
        $stringQueryExtratoConta = $modelConta->dadosRelatorio(null);
        $extrato = DB::select($stringQueryExtratoConta);
        $contador = count($extrato);

        for ($i=0; $i < $contador; $i++) { 
            $valorAnterior = $i - 1;

            if (($i == 0) || ($extrato[$valorAnterior]->apelidoConta != $extrato[$i]->apelidoConta)) {
                $saldo = $extrato[$i]->valorreceita;
            }
            else if (($i == 1) && ($extrato[$valorAnterior]->apelidoConta == $extrato[$i]->apelidoConta)) {
                $saldo = $extrato[$i]->valorreceita + $extrato[$valorAnterior]->valorreceita;
            }
            else if (($i > 1)  && ($extrato[$valorAnterior]->apelidoConta == $extrato[$i]->apelidoConta)){
                $saldo = $saldo + $extrato[$i]->valorreceita;
            }
            $extrato[$i]->saldo = $saldo;
        }
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
        $stringConsulta = $relatorio->dadosRelatorioContas(null, $pago = null, $nomeFunc = " (func.nomeFuncionario != '')");
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
        $stringConsulta = $relatorio->dadosOrdemdeServicoRecebidas(null, $parametros = "and r.idosreceita != 'CRIAATVA'");
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

    public function apiProjecaoTrimestral(Request $request)
    {

        // $mesAno = $this->pegaMesCorrenteEAno();
        // $mes = $mesAno[0];
        // $ano = $mesAno[1];

        // $relatorio = new Relatorio();

        // $stringConsultaDespesa = $relatorio->dadosDespesaProjecaoTrimestral(null, $mes, $ano);
        // $dadosConsultaDespesa = DB::select($stringConsultaDespesa);


        // $stringConsultaReceita = $relatorio->dadosReceitaProjecaoTrimestral(null, $mes, $ano);
        // $dadosConsultaReceita = DB::select($stringConsultaReceita);


        // $contadorReceita = count($dadosConsultaReceita);
        // if ($contadorReceita == 0) { $dadosReceita = "{}"; }  
        // else { $dadosReceita = $dadosConsultaReceita[0]; }  

        $dadosConsultaDespesa = $this->pegaJsonOS();

return $dadosConsultaDespesa;

        // array_push($dadosConsultaDespesa, $dadosReceita);

        // return $dadosConsultaDespesa;

        // $dadosConsulta = array($dadosConsultaDespesa, $dadosConsultaReceita);
        // return $dadosConsulta;



        // $mesCorrente    = $mesAno[0][0];
        // $mesSegundo     = $mesAno[0][1];
        // $mesTerceiro    = $mesAno[0][2];

        // $anoCorrente            = $mesAno[1][0];
        // $anoMesCorrenteSegundo  = $mesAno[1][1];
        // $anoMesCorrenteTerceiro = $mesAno[1][2];

        // return $mesCorrente;

    }

    public function pegaMesCorrenteEAno()
    {
        $mesAtual = date("m"); 
        $mesAtual = intval($mesAtual);

        $anoAtual = date("Y");
        $anoAtual = intval($anoAtual);

        $segundoMes = $mesAtual + 1;
        $terceiroMes = $segundoMes + 1;

        $anoSegundoMes = $anoAtual;
        $anoTerceiroMes = $anoAtual;

        if ($segundoMes  == 13){ $segundoMes = 1; $terceiroMes = 2;  $anoSegundoMes = $anoSegundoMes + 1; $anoTerceiroMes = $anoSegundoMes;}
        if ($terceiroMes == 13){ $terceiroMes = 1; $anoTerceiroMes = $anoTerceiroMes + 1;}

        if ($mesAtual    < 10){ $mesAtual = '0' . $mesAtual; }
        if ($segundoMes  < 10){ $segundoMes = '0' . $segundoMes; }
        if ($terceiroMes < 10){ $terceiroMes = '0' . $terceiroMes; }

        $arrayMes = array($mesAtual, $segundoMes, $terceiroMes);
        $arrayAno = array($anoAtual, $anoSegundoMes, $anoTerceiroMes);

        return array($arrayMes, $arrayAno);

    }

    public function pegaJsonOS()
    {
        $listaClientes = DB::select('select * from clientes where excluidoCliente = "0"');
        $totalClientes = count((array)$listaClientes);
        $contadorClientes = 0;
        
        $importaOS = file_get_contents('./migracao/vendas.json');
        $os = json_decode($importaOS,true);
          
        // Display data
        // print_r($os);    

        $idDaOS = 0;

        $totalOS = count((array)$os);
        $contadorOS = 0;
        while ($contadorOS < $totalOS) {
            while ($contadorClientes < $totalClientes) {

                if ($os[$contadorOS]['Cliente'] == $listaClientes[$contadorClientes]->razaosocialCliente){
                    $os[$contadorOS]['Cliente'] = $listaClientes[$contadorClientes]->id;
                }
                $contadorClientes++;
            }
            

            
        $ordemdeservico = new OrdemdeServico();
        $fatorR = '0';


        $ordemdeservico->idClienteOrdemdeServico          = $os[$contadorOS]['Cliente'];
        $ordemdeservico->valorProjetoOrdemdeServico       = '0.00';
        $ordemdeservico->valorOrdemdeServico              = FormatacoesServiceProvider::validaValoresParaBackEnd($os[$contadorOS]['ValorTotal']);
        $ordemdeservico->dataOrdemdeServico               = $os[$contadorOS]['DataVenda'];
        // $ordemdeservico->clienteOrdemdeServico            = $request->get('clienteOrdemdeServico');
        $ordemdeservico->eventoOrdemdeServico             = $os[$contadorOS]['Evento'];
        $ordemdeservico->servicoOrdemdeServico            = 'Campo Serviço';
        $ordemdeservico->obsOrdemdeServico                = '';
        $ordemdeservico->dataCriacaoOrdemdeServico        = $os[$contadorOS]['DataVenda'];
        $ordemdeservico->fatorR                           = $fatorR;
        $ordemdeservico->ativoOrdemdeServico              = '1';
        $ordemdeservico->excluidoOrdemdeServico           = '0';

        $salvaOS = $ordemdeservico->save();
        $idDaOS = $ordemdeservico->id;


        $contadorOS++;
        }



        // var_dump($os[0]['Numvenda']);
        var_dump("última os: " . $idDaOS);

    }
}