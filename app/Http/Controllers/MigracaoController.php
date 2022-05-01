<?php

namespace App\Http\Controllers;

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
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Label;
use DateTime;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class MigracaoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->diretorio = 'public/migracao/';
    }

    public function migracao()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $horarioInicio = date('d-m-Y H:i:s');

        $this->criaJsonClientes();
        // $this->criaJsonContas();
        $this->criaJsonFormaPagamento();
        $this->criaJsonFornecedores();
        $this->criaJsonFuncionarios();
        $this->criaJsonGrupoDespesas();
        $this->criaJsonCodigoDespesas();
        $this->criaJsonVendas();
        $this->criaJsonVencimentos();

        $this->limpaTabelas();

        // $this->pegaJsonContas();
        $this->pegaJsonCliente();
        $this->pegaJsonOS();
        $this->pegaJsonFornecedor();
        $this->pegaJsonFormaPagamento();
        $this->pegaJsonFuncionarios();
        $this->pegaJsonGrupoDespesas();
        $this->pegaJsonCodigoDespesas();
        $this->pegaJsonMovimentacoes();

        $horarioFinal = date('d-m-Y H:i:s');
        print("Iniciado em: " . $horarioInicio . "\n Finalizado: " . $horarioFinal);
    }

    public function criaJsonInicio($nomeArquivo)
    {
        $inputFileType = 'Xlsx';
        $inputFileName = $this->diretorio . $nomeArquivo . ".xlsx";


        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = IOFactory::createReader($inputFileType);
        /**  Advise the Reader that we only want to load cell data  **/
        $reader->setReadDataOnly(false);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $worksheet = $spreadsheet->getSheet(0); //

        // Get the highest row and column numbers referenced in the worksheet
        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

        $data = array();
        return array($worksheet, $highestRow, $highestColumnIndex);
    }

    public function criaJsonClientes()
    {

        $nomeArquivo = 'clientes1';
        $dadosJsonInicio = $this->criaJsonInicio($nomeArquivo);

        //Riga = cabeçalho colunas
        for ($row = 1; $row <= $dadosJsonInicio[1]; $row++) {
            $riga = array();

            for ($col = 1; $col <= $dadosJsonInicio[2]; $col++) {
                $riga[] = $dadosJsonInicio[0]->getCellByColumnAndRow($col, $row)->getValue();

                $rzSocial[$row] = $dadosJsonInicio[0]->getCellByColumnAndRow(2, $row)->getFormattedValue();
                $dataPadraoAmericano[$row] = $dadosJsonInicio[0]->getCellByColumnAndRow(22, $row)->getFormattedValue();
                $dataPadraoAmericano[$row] = date("Y-m-d", strtotime($dataPadraoAmericano[$row]));
            }
            if (1 === $row) {
                // Header row. Save it in "$keys".
                $keys = $riga;
                continue;
            }
            // This is not the first row; so it is a data row.
            // Transform $riga into a dictionary and add it to $data.
            $data[] = array_combine($keys, $riga);
        }


        for ($i = 0; $i < ($dadosJsonInicio[1] - 1); $i++) {
            if ($i == 0) : $i_data = 1;
            endif;

            if ($i_data < $dadosJsonInicio[1]) : $i_data++;
            endif;

            $data[$i]["Razão Social"]   = $rzSocial[$i_data];
            $data[$i]["Cadastro"]       = $dataPadraoAmericano[$i_data];
        }
        try {
            $criaArquivo = fopen($this->diretorio . $nomeArquivo . '.json', 'w');
            fwrite($criaArquivo, json_encode($data, JSON_UNESCAPED_UNICODE));
            fclose($criaArquivo);
            print("Tabela clientes convertida para formato json \n");
        } catch (\Throwable $th) {
            print("Ocorreu um erro na tabela clientes. Tente novamente \n");
        }
    }

    public function criaJsonCodigoDespesas()
    {

        $nomeArquivo = 'codigo_de_despesas';
        $dadosJsonInicio = $this->criaJsonInicio($nomeArquivo);

        //Riga = cabeçalho colunas
        for ($row = 1; $row <= $dadosJsonInicio[1]; $row++) {
            $riga = array();

            for ($col = 1; $col <= $dadosJsonInicio[2]; $col++) {
                $riga[] = $dadosJsonInicio[0]->getCellByColumnAndRow($col, $row)->getValue();

                $codigo[$row] = $dadosJsonInicio[0]->getCellByColumnAndRow(1, $row)->getFormattedValue();
                $descricao[$row] = $dadosJsonInicio[0]->getCellByColumnAndRow(2, $row)->getFormattedValue();
                $grupo[$row] = $dadosJsonInicio[0]->getCellByColumnAndRow(3, $row)->getFormattedValue();
            }
            if (1 === $row) {
                // Header row. Save it in "$keys".
                $keys = $riga;
                continue;
            }
            // This is not the first row; so it is a data row.
            // Transform $riga into a dictionary and add it to $data.
            $data[] = array_combine($keys, $riga);
        }


        for ($i = 0; $i < ($dadosJsonInicio[1] - 1); $i++) {
            if ($i == 0) : $i_data = 1;
            endif;

            if ($i_data < $dadosJsonInicio[1]) : $i_data++;
            endif;

            $data[$i]["Codigo"]     = $codigo[$i_data];
            if ($descricao[$i_data] == '' || $descricao[$i_data] == 'null') {
                unset($data[$i]["Descricao"]);
                unset($descricao[$i_data]);
            } else {
                $data[$i]["Descricao"]  = $descricao[$i_data];
            }
            if ($grupo[$i_data] == '' || $grupo[$i_data] == 'null') {
                unset($data[$i]["Grupo"]);
                unset($grupo[$i_data]);
            } else {
                $data[$i]["Grupo"]      = $grupo[$i_data];
            }
        }
        try {
            $criaArquivo = fopen($this->diretorio . $nomeArquivo . '.json', 'w');
            fwrite($criaArquivo, json_encode($data, JSON_UNESCAPED_UNICODE));
            fclose($criaArquivo);
            print("Tabela de código de despesas convertida para formato json \n");
        } catch (\Throwable $th) {
            print("Ocorreu um erro na tabela código de despesas. Tente novamente \n");
        }
    }
    public function criaJsonContas()
    {
        //C1 - TAILORMADE
        //C2 - THIAGO
        //C3 - CAIXINHA
        //C4 - VIRA
        //C5 - NELIO
        //C6 - THIAGO POUPANÇA
        //C7 - VIROLA

        $nomeArquivo = 'contas';
        $dadosJsonInicio = $this->criaJsonInicio($nomeArquivo);

        //Riga = cabeçalho colunas
        for ($row = 1; $row <= $dadosJsonInicio[1]; $row++) {
            $riga = array();

            for ($col = 1; $col <= $dadosJsonInicio[2]; $col++) {
                $riga[] = $dadosJsonInicio[0]->getCellByColumnAndRow($col, $row)->getValue();

                $conta[$row] = $dadosJsonInicio[0]->getCellByColumnAndRow(1, $row)->getFormattedValue();
            }
            if (1 === $row) {
                // Header row. Save it in "$keys".
                $keys = $riga;
                continue;
            }
            // This is not the first row; so it is a data row.
            // Transform $riga into a dictionary and add it to $data.
            $data[] = array_combine($keys, $riga);
        }


        for ($i = 0; $i < ($dadosJsonInicio[1] - 1); $i++) {
            if ($i == 0) : $i_data = 1;
            endif;

            if ($i_data < $dadosJsonInicio[1]) : $i_data++;
            endif;

            $data[$i]["Conta"]   = $conta[$i_data];
        }
        try {
            $criaArquivo = fopen($this->diretorio . $nomeArquivo . '.json', 'w');
            fwrite($criaArquivo, json_encode($data, JSON_UNESCAPED_UNICODE));
            fclose($criaArquivo);
            print("Tabela de contas convertida para formato json \n");
        } catch (\Throwable $th) {
            print("Ocorreu um erro na tabela contas. Tente novamente \n");
        }
    }
    public function criaJsonFormaPagamento()
    {

        $nomeArquivo = 'formapagamento';
        $dadosJsonInicio = $this->criaJsonInicio($nomeArquivo);

        //Riga = cabeçalho colunas
        for ($row = 1; $row <= $dadosJsonInicio[1]; $row++) {
            $riga = array();

            for ($col = 1; $col <= $dadosJsonInicio[2]; $col++) {
                $riga[] = $dadosJsonInicio[0]->getCellByColumnAndRow($col, $row)->getValue();

                $formapagamento[$row] = $dadosJsonInicio[0]->getCellByColumnAndRow(1, $row)->getFormattedValue();
            }
            if (1 === $row) {
                // Header row. Save it in "$keys".
                $keys = $riga;
                continue;
            }
            // This is not the first row; so it is a data row.
            // Transform $riga into a dictionary and add it to $data.
            $data[] = array_combine($keys, $riga);
        }


        for ($i = 0; $i < ($dadosJsonInicio[1] - 1); $i++) {
            if ($i == 0) : $i_data = 1;
            endif;

            if ($i_data < $dadosJsonInicio[1]) : $i_data++;
            endif;

            $data[$i]["Formapag"]   = $formapagamento[$i_data];
        }
        try {
            $criaArquivo = fopen($this->diretorio . $nomeArquivo . '.json', 'w');
            fwrite($criaArquivo, json_encode($data, JSON_UNESCAPED_UNICODE));
            fclose($criaArquivo);
            print("Tabela formapagamento convertida para formato json \n");
        } catch (\Throwable $th) {
            print("Ocorreu um erro na tabela forma de pagamento. Tente novamente \n");
        }
    }
    public function criaJsonFornecedores()
    {

        $nomeArquivo = 'fornecedores';
        $dadosJsonInicio = $this->criaJsonInicio($nomeArquivo);

        //Riga = cabeçalho colunas
        for ($row = 1; $row <= $dadosJsonInicio[1]; $row++) {
            $riga = array();

            for ($col = 1; $col <= $dadosJsonInicio[2]; $col++) {
                $riga[] = $dadosJsonInicio[0]->getCellByColumnAndRow($col, $row)->getValue();

                $fornecedores[$row] = $dadosJsonInicio[0]->getCellByColumnAndRow(1, $row)->getFormattedValue();
            }
            if (1 === $row) {
                // Header row. Save it in "$keys".
                $keys = $riga;
                continue;
            }
            // This is not the first row; so it is a data row.
            // Transform $riga into a dictionary and add it to $data.
            $data[] = array_combine($keys, $riga);
        }


        for ($i = 0; $i < ($dadosJsonInicio[1] - 1); $i++) {
            if ($i == 0) : $i_data = 1;
            endif;

            if ($i_data < $dadosJsonInicio[1]) : $i_data++;
            endif;

            $data[$i]["Razão Social"]   = $fornecedores[$i_data];
        }
        try {
            $criaArquivo = fopen($this->diretorio . $nomeArquivo . '.json', 'w');
            fwrite($criaArquivo, json_encode($data, JSON_UNESCAPED_UNICODE));
            fclose($criaArquivo);
            print("Tabela de fornecedores convertida para formato json \n");
        } catch (\Throwable $th) {
            print("Ocorreu um erro na tabela de fornecedores. Tente novamente \n");
        }
    }
    public function criaJsonFuncionarios()
    {

        $nomeArquivo = 'funcionarios';
        $dadosJsonInicio = $this->criaJsonInicio($nomeArquivo);

        //Riga = cabeçalho colunas
        for ($row = 1; $row <= $dadosJsonInicio[1]; $row++) {
            $riga = array();

            for ($col = 1; $col <= $dadosJsonInicio[2]; $col++) {
                $riga[] = $dadosJsonInicio[0]->getCellByColumnAndRow($col, $row)->getValue();

                $codfuncionario[$row]       = $dadosJsonInicio[0]->getCellByColumnAndRow(1, $row)->getFormattedValue();
                $nomefuncionario[$row]      = $dadosJsonInicio[0]->getCellByColumnAndRow(2, $row)->getFormattedValue();
                $apelidofuncionario[$row]   = $dadosJsonInicio[0]->getCellByColumnAndRow(3, $row)->getFormattedValue();
            }
            if (1 === $row) {
                // Header row. Save it in "$keys".
                $keys = $riga;
                continue;
            }
            // This is not the first row; so it is a data row.
            // Transform $riga into a dictionary and add it to $data.
            $data[] = array_combine($keys, $riga);
        }


        for ($i = 0; $i < ($dadosJsonInicio[1] - 1); $i++) {
            if ($i == 0) : $i_data = 1;
            endif;

            if ($i_data < $dadosJsonInicio[1]) : $i_data++;
            endif;

            $data[$i]["Codfunci"]   = $codfuncionario[$i_data];
            $data[$i]["Nome"]       = $nomefuncionario[$i_data];
            $data[$i]["Apelido"]    = $apelidofuncionario[$i_data];
        }
        try {
            $criaArquivo = fopen($this->diretorio . $nomeArquivo . '.json', 'w');
            fwrite($criaArquivo, json_encode($data, JSON_UNESCAPED_UNICODE));
            fclose($criaArquivo);
            print("Tabela de funcionarios convertida para formato json \n");
        } catch (\Throwable $th) {
            print("Ocorreu um erro na tabela de funcionarios. Tente novamente \n");
        }
    }
    public function criaJsonGrupoDespesas()
    {

        $nomeArquivo = 'grupodespesas';
        $dadosJsonInicio = $this->criaJsonInicio($nomeArquivo);

        //Riga = cabeçalho colunas
        for ($row = 1; $row <= $dadosJsonInicio[1]; $row++) {
            $riga = array();

            for ($col = 1; $col <= $dadosJsonInicio[2]; $col++) {
                $riga[] = $dadosJsonInicio[0]->getCellByColumnAndRow($col, $row)->getValue();

                $grupodespesas[$row] = $dadosJsonInicio[0]->getCellByColumnAndRow(1, $row)->getFormattedValue();
            }
            if (1 === $row) {
                // Header row. Save it in "$keys".
                $keys = $riga;
                continue;
            }
            // This is not the first row; so it is a data row.
            // Transform $riga into a dictionary and add it to $data.
            $data[] = array_combine($keys, $riga);
        }


        for ($i = 0; $i < ($dadosJsonInicio[1] - 1); $i++) {
            if ($i == 0) : $i_data = 1;
            endif;

            if ($i_data < $dadosJsonInicio[1]) : $i_data++;
            endif;

            $data[$i]["Grupo"]   = $grupodespesas[$i_data];
        }
        try {
            $criaArquivo = fopen($this->diretorio . $nomeArquivo . '.json', 'w');
            fwrite($criaArquivo, json_encode($data, JSON_UNESCAPED_UNICODE));
            fclose($criaArquivo);
            print("Tabela de grupo de despesas convertida para formato json \n");
        } catch (\Throwable $th) {
            print("Ocorreu um erro na tabela de despesas. Tente novamente \n");
        }
    }
    public function criaJsonVendas()
    {

        $nomeArquivo = 'vendas1';
        $dadosJsonInicio = $this->criaJsonInicio($nomeArquivo);

        //Riga = cabeçalho colunas
        for ($row = 1; $row <= $dadosJsonInicio[1]; $row++) {
            $riga = array();

            for ($col = 1; $col <= $dadosJsonInicio[2]; $col++) {
                $riga[] = $dadosJsonInicio[0]->getCellByColumnAndRow($col, $row)->getValue();

                $numVenda[$row]     = $dadosJsonInicio[0]->getCellByColumnAndRow(1, $row)->getFormattedValue();
                // $dataVenda[$row]    = $dadosJsonInicio[0]->getCellByColumnAndRow(2, $row)->getFormattedValue();
                $dataVenda[$row]    = date("Y-m-d", strtotime($dadosJsonInicio[0]->getCellByColumnAndRow(2, $row)->getFormattedValue()));
                $cliente[$row]      = $dadosJsonInicio[0]->getCellByColumnAndRow(4, $row)->getFormattedValue();
                $evento[$row]       = $dadosJsonInicio[0]->getCellByColumnAndRow(5, $row)->getFormattedValue();
                $descricao[$row]    = $dadosJsonInicio[0]->getCellByColumnAndRow(6, $row)->getFormattedValue();
                $obs[$row]          = $dadosJsonInicio[0]->getCellByColumnAndRow(7, $row)->getFormattedValue();
                $valorTotal[$row]   = $dadosJsonInicio[0]->getCellByColumnAndRow(8, $row)->getFormattedValue();
            }
            if (1 === $row) {
                // Header row. Save it in "$keys".
                $keys = $riga;
                continue;
            }
            // This is not the first row; so it is a data row.
            // Transform $riga into a dictionary and add it to $data.
            $data[] = array_combine($keys, $riga);
        }


        for ($i = 0; $i < ($dadosJsonInicio[1] - 1); $i++) {
            if ($i == 0) : $i_data = 1;
            endif;

            if ($i_data < $dadosJsonInicio[1]) : $i_data++;
            endif;

            $data[$i]["Cliente"]        = $cliente[$i_data];
            $data[$i]["Valor Total"]    = $valorTotal[$i_data];
            $data[$i]["Numvenda"]       = $numVenda[$i_data];
            $data[$i]["Evento"]         = $evento[$i_data];
            $data[$i]["Descrição"]      = $descricao[$i_data];
            $data[$i]["Obs"]            = $obs[$i_data];
            $data[$i]["DataVenda"]      = $dataVenda[$i_data];
        }
        try {
            $criaArquivo = fopen($this->diretorio . $nomeArquivo . '.json', 'w');
            fwrite($criaArquivo, json_encode($data, JSON_UNESCAPED_UNICODE));
            fclose($criaArquivo);
            print("Tabela de vendas (OS) convertida para formato json");
        } catch (\Throwable $th) {
            print("Ocorreu um erro. Tente novamente");
        }
    }

    public function criaJsonVencimentos()
    {

        $nomeArquivo = 'vencimentos';
        print("\nIniciando migração da tabela de vencimentos para json ...\n");
        print("Lendo arquivo excel ...\n");
        $dadosJsonInicio = $this->criaJsonInicio($nomeArquivo);
        print("Preparando dados ... \n");

        //Riga = cabeçalho colunas
        for ($row = 1; $row <= $dadosJsonInicio[1]; $row++) {
            $riga = array();

            for ($col = 1; $col <= $dadosJsonInicio[2]; $col++) {
                $riga[] = $dadosJsonInicio[0]->getCellByColumnAndRow($col, $row)->getValue();

                $valorfat[$row]     = $dadosJsonInicio[0]->getCellByColumnAndRow(12, $row)->getFormattedValue();
                $conta[$row]        = $dadosJsonInicio[0]->getCellByColumnAndRow(17, $row)->getFormattedValue();
                $fornecedor[$row]   = $dadosJsonInicio[0]->getCellByColumnAndRow(7, $row)->getFormattedValue();
                $codfunci[$row]     = $dadosJsonInicio[0]->getCellByColumnAndRow(28, $row)->getFormattedValue();
                $formapag[$row]     = $dadosJsonInicio[0]->getCellByColumnAndRow(8, $row)->getFormattedValue();
                $fixa[$row]         = $dadosJsonInicio[0]->getCellByColumnAndRow(34, $row)->getFormattedValue();
                $codigo[$row]       = $dadosJsonInicio[0]->getCellByColumnAndRow(3, $row)->getFormattedValue();
                $registro[$row]     = $dadosJsonInicio[0]->getCellByColumnAndRow(18, $row)->getFormattedValue();
                $numvenda[$row]     = $dadosJsonInicio[0]->getCellByColumnAndRow(1, $row)->getFormattedValue();
                $datapag[$row]      = date("Y-m-d", strtotime($dadosJsonInicio[0]->getCellByColumnAndRow(10, $row)->getFormattedValue()));
                $nf[$row]           = $dadosJsonInicio[0]->getCellByColumnAndRow(33, $row)->getFormattedValue();
                $pg[$row]           = $dadosJsonInicio[0]->getCellByColumnAndRow(15, $row)->getFormattedValue();
                $despesa[$row]      = $dadosJsonInicio[0]->getCellByColumnAndRow(6, $row)->getFormattedValue();
                $valor[$row]        = $dadosJsonInicio[0]->getCellByColumnAndRow(11, $row)->getFormattedValue();
                $receita[$row]      = $dadosJsonInicio[0]->getCellByColumnAndRow(5, $row)->getFormattedValue();
                $dataEmissao[$row]  = date("Y-m-d", strtotime($dadosJsonInicio[0]->getCellByColumnAndRow(37, $row)->getFormattedValue()));
                $cliente[$row]      = $dadosJsonInicio[0]->getCellByColumnAndRow(26, $row)->getFormattedValue();
            }
            if (1 === $row) {
                // Header row. Save it in "$keys".
                $keys = $riga;
                continue;
            }
            // This is not the first row; so it is a data row.
            // Transform $riga into a dictionary and add it to $data.
            print("Validando vencimento " . $row . "\n");
            $data[] = array_combine($keys, $riga);
        }


        for ($i = 0; $i < ($dadosJsonInicio[1] - 1); $i++) {
            if ($i == 0) : $i_data = 1;
            endif;

            if ($i_data < $dadosJsonInicio[1]) : $i_data++;
            endif;

            $data[$i]["Valorfat"] =         $valorfat[$i_data];
            $data[$i]["Conta"] =            $conta[$i_data];
            $data[$i]["Fornecedor"] =       $fornecedor[$i_data];
            $data[$i]["Codfunci"] =         $codfunci[$i_data];
            $data[$i]["Formapag"] =         $formapag[$i_data];
            $data[$i]["Fixa"] =             $fixa[$i_data];
            $data[$i]["Codigo"] =           $codigo[$i_data];
            $data[$i]["Registro"] =         $registro[$i_data];
            $data[$i]["Numvenda"] =         $numvenda[$i_data];
            $data[$i]["Datapag"] =          $datapag[$i_data];
            $data[$i]["NF"] =               $nf[$i_data];
            $data[$i]["PG"] =               $pg[$i_data];
            $data[$i]["Despesa"] =          $despesa[$i_data];
            $data[$i]["Valor"] =            $valor[$i_data];
            $data[$i]["Formapag"] =         $formapag[$i_data];
            $data[$i]["Receita"] =          $receita[$i_data];
            if ($dataEmissao[$i_data] == "1969-12-31") {
                unset($data[$i]["Data Emissão"]);
                unset($dataEmissao[$i_data]);
            } else {
                $data[$i]["Data Emissão"] =  $dataEmissao[$i_data];
            }
            $data[$i]["Cliente"] =          $cliente[$i_data];

            unset($data[$i]["Numcompra"]);
            unset($data[$i]["Prazos"]);
            unset($data[$i]["Ativação"]);
            unset($data[$i]["Valor Estornado"]);
            unset($data[$i]["Pagamento"]);
            unset($data[$i]["Quantia"]);
            unset($data[$i]["Data"]);
            unset($data[$i]["Banco"]);
            unset($data[$i]["Obs"]);
            unset($data[$i]["Cheque"]);
            unset($data[$i]["Juros"]);
            unset($data[$i]["Parcela"]);
            unset($data[$i]["Verba"]);
            unset($data[$i]["Comissão"]);
            unset($data[$i]["Imposto"]);
        }

        try {

            $criaArquivo = fopen($this->diretorio . $nomeArquivo . '.json', 'w');
            fwrite($criaArquivo, json_encode($data, JSON_UNESCAPED_UNICODE));
            fclose($criaArquivo);
            print("Tabela de vencimentos convertida para formato json \n");
        } catch (\Throwable $th) {
            print("Ocorreu um erro. Tente novamente");
        }
    }

    public function limpaTabelas()
    {

        // DB::delete('delete from conta');
        // DB::statement('ALTER TABLE conta AUTO_INCREMENT=1');

        DB::delete('delete from clientes');
        DB::statement('ALTER TABLE clientes AUTO_INCREMENT=1');

        DB::delete('delete from ordemdeservico');
        DB::statement('ALTER TABLE ordemdeservico AUTO_INCREMENT=1');

        DB::delete('delete from fornecedores');
        DB::statement('ALTER TABLE fornecedores AUTO_INCREMENT=1');

        DB::delete('delete from formapagamento');
        DB::statement('ALTER TABLE formapagamento AUTO_INCREMENT=1');

        DB::delete('delete from funcionarios');
        DB::statement('ALTER TABLE funcionarios AUTO_INCREMENT=1');

        DB::delete('delete from grupodespesas');
        DB::statement('ALTER TABLE grupodespesas AUTO_INCREMENT=1');

        DB::delete('delete from codigodespesas');
        DB::statement('ALTER TABLE codigodespesas AUTO_INCREMENT=1');

        DB::delete('delete from despesas');
        DB::statement('ALTER TABLE despesas AUTO_INCREMENT=1');

        DB::delete('delete from receita');
        DB::statement('ALTER TABLE receita AUTO_INCREMENT=1');

        print_r("Tabelas limpas \n");
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
            $ordemdeservico->dataCriacaoOrdemdeServico        = $os[$contadorOS]['DataVenda'];
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

                            if (($jsonvencimentos[$movimentacoes]['Codfunci'] == $funcionario->nomeFuncionario) && ($jsonvencimentos[$movimentacoes]['Codfunci'] != null || $jsonvencimentos[$movimentacoes]['Codfunci'] != '')) {
                                $jsonvencimentos[$movimentacoes]['Codfunci'] = $funcionario->id;
                            }
                            elseif($jsonvencimentos[$movimentacoes]['Codfunci'] == null || $jsonvencimentos[$movimentacoes]['Codfunci'] == ''){
                                $jsonvencimentos[$movimentacoes]['Codfunci'] = '';
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

                    //Verificação PG
                    if (isset($jsonvencimentos[$movimentacoes]['PG'])) {
                        $despesa->pago                  =  $jsonvencimentos[$movimentacoes]['PG'];
                    } else {
                        $despesa->pago                  =  $jsonvencimentos[$movimentacoes]['PG'];
                    }

                    //Verificação Vencimento
                    if (isset($jsonvencimentos[$movimentacoes]['Datapag'])) {
                        $despesa->vencimento          = $jsonvencimentos[$movimentacoes]['Datapag'];
                        if ($despesa->pago == 'S') : $despesa->dataDoPagamento = $despesa->vencimento;
                        endif;
                    } else {
                        $despesa->vencimento          = '';
                    }

                    //Verificação NF
                    if (isset($jsonvencimentos[$movimentacoes]['NF'])) {
                        $despesa->notaFiscal            =  $jsonvencimentos[$movimentacoes]['NF'];
                    } else {
                        $despesa->notaFiscal            =  '';
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
                            $receita->datapagamentoreceita          = $jsonvencimentos[$movimentacoes]['Datapag'];
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

                                if ($jsonvencimentos[$movimentacoes]['Conta'] == $contas->nomeConta) {
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
                            $receita->dataemissaoreceita            =  $jsonvencimentos[$movimentacoes]['Data Emissão'];
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

                if (isset($jsoncodigodespesas[$contadorcodigo]['Descricao'])) {
                    $codigodespesas->despesaCodigoDespesa = $jsoncodigodespesas[$contadorcodigo]['Descricao'];
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
