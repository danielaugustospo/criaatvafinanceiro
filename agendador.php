<?php
include_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$servername = env('DB_HOST');
$username =   env('DB_USERNAME');
$password =   env('DB_PASSWORD');
$dbname =     env('DB_DATABASE');

$hoje = date("d/m/Y");
$hojeAmericano = date("Y-m-d");

$date = new DateTime();

try {
    $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $data = $conexao->query("SELECT *
        FROM despesas 
        WHERE vencimento not BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()
 
        AND (excluidoDespesa = 0 and despesaFixa = 1
	        AND ativoDespesa = 1 AND idDespesaPai = 0 
	        AND vencimento <= CURDATE());
        ")->fetchAll();

    $contaVencidas = count($data);

    foreach ($data as $row) {

        $contasVencidas = count($data);

        $idCodigoDespesas  = $row['idCodigoDespesas'];
        $idOS  = $row['idOS'];
        $idDespesaPai  = $row['id'];
        $descricaoDespesa  = $row['descricaoDespesa'];
        $despesaCodigoDespesas  = $row['despesaCodigoDespesas'];
        $idFornecedor  = $row['idFornecedor'];
        $precoReal  = $row['precoReal'];
        $valorEstornado  = $row['valorEstornado'];
        $atuacao  = $row['atuacao'];
        $pago  = $row['pago'];
        $quempagou  = $row['quempagou'];
        $idFormaPagamento  = $row['idFormaPagamento'];
        $conta  = $row['conta'];
        $nRegistro  = $row['nRegistro'];
        $vencimento  = $hojeAmericano;
        $totalPrecoReal  = $row['totalPrecoReal'];
        $totalPrecoCliente  = $row['totalPrecoCliente'];
        $notaFiscal  = $row['notaFiscal'];
        $despesaFixa  = $row['despesaFixa'];
        $cheque  = $row['cheque'];
        $idBanco  = $row['idBanco'];
        $ativoDespesa  = $row['ativoDespesa'];
        $excluidoDespesa  = $row['excluidoDespesa'];


        for ($i = 0; $i < $contasVencidas; $i++) {
            $stmt = $conexao->prepare("INSERT INTO despesas (idCodigoDespesas,idOS,idDespesaPai,descricaoDespesa,despesaCodigoDespesas,idFornecedor,precoReal,valorEstornado,atuacao,pago,quempagou,idFormaPagamento,conta,nRegistro,vencimento,totalPrecoReal,totalPrecoCliente,notaFiscal,despesaFixa,cheque,idBanco,ativoDespesa,excluidoDespesa)
            VALUES (:idCodigoDespesas,:idOS,:idDespesaPai,:descricaoDespesa,:despesaCodigoDespesas,:idFornecedor,:precoReal,:valorEstornado,:atuacao,:pago,:quempagou,:idFormaPagamento,:conta,:nRegistro,:vencimento,:totalPrecoReal,:totalPrecoCliente,:notaFiscal,:despesaFixa,:cheque,:idBanco,:ativoDespesa,:excluidoDespesa)");
            $stmt->bindParam(':idCodigoDespesas', $idCodigoDespesas);
            $stmt->bindParam(':idOS', $idOS);
            $stmt->bindParam(':idDespesaPai', $idDespesaPai);
            $stmt->bindParam(':descricaoDespesa', $descricaoDespesa);
            $stmt->bindParam(':despesaCodigoDespesas', $despesaCodigoDespesas);
            $stmt->bindParam(':idFornecedor', $idFornecedor);
            $stmt->bindParam(':precoReal', $precoReal);
            $stmt->bindParam(':valorEstornado', $valorEstornado);
            $stmt->bindParam(':atuacao', $atuacao);
            $stmt->bindParam(':pago', $pago);
            $stmt->bindParam(':quempagou', $quempagou);
            $stmt->bindParam(':idFormaPagamento', $idFormaPagamento);
            $stmt->bindParam(':conta', $conta);
            $stmt->bindParam(':nRegistro', $nRegistro);
            $stmt->bindParam(':vencimento', $vencimento);
            $stmt->bindParam(':totalPrecoReal', $totalPrecoReal);
            $stmt->bindParam(':totalPrecoCliente', $totalPrecoCliente);
            $stmt->bindParam(':notaFiscal', $notaFiscal);
            $stmt->bindParam(':despesaFixa', $despesaFixa);
            $stmt->bindParam(':cheque', $cheque);
            $stmt->bindParam(':idBanco', $idBanco);
            $stmt->bindParam(':ativoDespesa', $ativoDespesa);
            $stmt->bindParam(':excluidoDespesa', $excluidoDespesa);

            $stmt->execute();
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conexao = null;
