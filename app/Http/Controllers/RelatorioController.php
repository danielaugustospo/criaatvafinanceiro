<?php


namespace App\Http\Controllers;


use App\Relatorio;
use App\Despesa;
use App\Conta;
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
}
