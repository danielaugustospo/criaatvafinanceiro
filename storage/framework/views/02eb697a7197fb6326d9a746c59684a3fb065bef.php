<?php 
    $intervaloCelulas = "A1:G1"; 
    // $rotaapi = "apiextratocontarelatorio";
    $titulo  = "Conta Corrente";
    $campodata = 'dtoperacao';
    $contaSelecionada = $contaSelecionada; 
    $datainicial = $datainicial;
    $datafinal = $datafinal;
    $conta          = $conta;
    $saldoInicial   = $saldoInicial;
    $saldoFinal     = $saldoFinal;
    $contacorrente     = 1;
    $relatorioKendoGrid = true;

    $urlContaCorrente = route('apiextratocontarelatorio');

?>
<head>
    <meta charset="utf-8">
    <title><?php echo e($titulo); ?></title>
</head>



<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('visualiza-contacorrente')): ?>


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <?php if($contaSelecionada == ""): echo "<label class='text-center' style='color:red;'>AVISO: Conta não informada. Relatório não pode ser gerado. Tente novamente a partir da página inicial</label>"; endif; ?>

            <h2 class="text-center"> <img src="img/credit-card.png" style="width: 50px;" alt=""><?php echo e($titulo); ?></h2>
        </div>
    </div>
</div>
 <a  class="d-flex justify-content-center" data-toggle="modal" onclick="alteraRotaFormularioCC();" data-target="#exampleModalCenter" style="cursor: pointer; color: red;"><i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a>

<?php if($message = Session::get('success')): ?>
<div class="alert alert-success">
    <p><?php echo e($message); ?></p>
</div>
<?php endif; ?>



<div id="filter-menu"></div>
<br /><br />
<div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;" >
       
    <div id="informacoes" class="d-flex justify-content-center" >
        <label class="fontenormal">Conta: <b style="color: red;"> <?php echo e($conta); ?>  </b> - Período 
            <?php 
            $numberFormatter = new \NumberFormatter('pt-BR',\NumberFormatter::CURRENCY); 
            echo '<b style="color: red;"> '. date("d/m/Y", strtotime($datainicial)) .' </b>' . " até " . '<b style="color: red;">' . date("d/m/Y", strtotime($datafinal)) . ' </b>'; 
            setlocale(LC_MONETARY, 'pt_BR');
            echo ' - Saldo Inicial:  <b style="color: red;">' . $numberFormatter->format($saldoInicial) .'</b>';
            echo ' - Saldo Final:    <b style="color: red;">' . $numberFormatter->format($saldoFinal)  .'</b>';
            ?> 
        </label>
    </div>
</div>

<script>

    <?php echo $__env->make('layouts/helpersview/iniciotabela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    pageable: true,
            dataSource: {
                data: data,
                pageSize: 50,
                schema: {
                    model: {
                        fields: {
                            dtoperacao: { type: "date" },
                            valorreceita: { type: "number" },
                            saldo: { type: "number" },
                            conta: { type: "string" },
                        }
                    },
                },

                group: {
                    field: "conta", aggregates: [
                        { field: "conta", aggregate: "count" },
                        { field: "valorreceita", aggregate: "sum" },
                        // { field: "saldoinicial", aggregate: "sum" },
                    ]
                },
                aggregate: [{ field: "conta", aggregate: "count" },
                { field: "valorreceita", aggregate: "sum" }],
                sort: [
                    // sort by "category" in descending order and then by "name" in ascending order
                    { field: "dtoperacao", dir: "asc" },
                    // { field: "name", dir: "asc" }
                ],

            },

            columns: [
                { field: "id", title: "ID", filterable: true, width: 80 },
                { field: "dtoperacao", title: "Data",  format: "{0:dd/MM/yyyy}", width: 80  , filterable: false},
                { field: "historico", title: "Histórico", filterable: true, width: 180  },
                { field: "nomeFormaPagamento", title: "Forma PG", filterable: true,  width: 100  },
                // { field: "conta", title: "Conta", filterable: true, width: 100, aggregates: ["count"], footerTemplate: "QTD. Total: #=count#", groupHeaderColumnTemplate: "Qtd.: #=count#" },
                // { field: "vencimento", title: "Vencimento", filterable: true, width: 100, format: "{0:dd/MM/yyyy}" },
                { field: "valorreceita", title: "Valor", filterable: true,  width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Mov.: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Val. Total: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                
                // Retirada solicitada pelo Nelio dia 30/04/2022
                { field: "saldo", title: "Saldo", filterable: true,  width: 80, decimals: 2, aggregates: ["sum"], format: '{0:0.00}', groupHeaderColumnTemplate: '<?php $numberFormatter = new \NumberFormatter('pt-BR',\NumberFormatter::CURRENCY); echo ' SALDO INICIAL:' . $numberFormatter->format($saldoInicial); ?>', footerTemplate: '<?php echo ' SALDO FINAL:' . $numberFormatter->format($saldoFinal); ?>' },
                
                // { field: "notaFiscal", title: "Nota Fiscal", filterable: true, width: 100 },
            ],

            <?php echo $__env->make('layouts/helpersview/finaltabela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
           
</script>

<?php else: ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Não Autorizado</h2>
        </div>
    </div>
</div>
<?php endif; ?>



<?php $__env->stopSection(); ?>  
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/contacorrente/extratoConta.blade.php ENDPATH**/ ?>