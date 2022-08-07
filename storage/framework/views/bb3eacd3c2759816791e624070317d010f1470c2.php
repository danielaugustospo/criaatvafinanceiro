<?php 
    $intervaloCelulas = "A1:F1"; 
    $rotaapi = "api/apidespesas";
    $titulo  = "CONTAS PAGAS POR DESPESA/GRUPO";
    $campodata = 'vencimento';
    $relatorioKendoGrid = true;

    if (isset($despesas)) {
        $despesas = $despesas;
    } else {
        $despesas = '';
    }
$idUser = Crypt::encrypt(auth()->user()->id);
?>


<head>
<meta charset="utf-8">
<title><?php echo e($titulo); ?></title>
</head>



<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Relatório de <?php echo e($titulo); ?></h2>
        </div>
    </div>
</div>

<a onclick="abreModalDespesas(param = 'contasapagarporgrupo');" class="d-flex justify-content-center" href="#"> <i class="fas fa-sync" ></i>Acessar Outro Período/Conta</a>


<?php if($message = Session::get('success')): ?>
    <div class="alert alert-success">
        <p><?php echo e($message); ?></p>
    </div>
<?php endif; ?>


<div id="filter-menu"></div>
<br /><br />
    <div id="grid" class="shadowDiv mb-5 p-2 rounded" style="background-color: white !important;">
        <?php echo $__env->make('layouts/helpersview/infofiltrosdepesa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script>
        $.LoadingOverlay("show", {
            image: "",
            progress: true
        });
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('visualiza-relatoriogeral')): ?>    
        
    var dataSource = new kendo.data.DataSource({
        transport: {
            read: {
                <?php if(isset($despesas)): ?>
                url: "<?php echo e($rotaapi); ?>?despesas=<?php echo e($despesas); ?>&valor=<?php echo e($valor); ?>&dtinicio=<?php echo e($dtinicio); ?>&dtfim=<?php echo e($dtfim); ?>&coddespesa=<?php echo e($coddespesa); ?>&fornecedor=<?php echo e($fornecedor); ?>&ordemservico=<?php echo e($ordemservico); ?>&conta=<?php echo e($conta); ?>&notafiscal=<?php echo e($notafiscal); ?>&cliente=<?php echo e($cliente); ?>&fixavariavel=<?php echo e($fixavariavel); ?>&pago=S&idUser=<?php echo e($idUser); ?>",

                <?php else: ?>
                    url: "<?php echo e($rotaapi); ?>",
                <?php endif; ?>
                dataType: "json"
            },
        },
    });


    //Se não houver essa declaração, ele retorna erro dizendo que não encontrou o metodo e não exporta o pdf
    var detailColsVisibility = {};

    dataSource.fetch().then(function() {
                var data = dataSource.data();

                // initialize a Kendo Grid with the returned data from the server.
                $("#grid").kendoGrid({
                            toolbar: ["excel", "pdf"],
                            excel: {
                                fileName: "Relatório de " + document.title + ".xlsx",
                                allPages: true
                                // proxyURL: "https://demos.telerik.com/kendo-ui/service/export",
                                // filterable: true
                            },
                            excelExport: function(e) {

                                var sheet = e.workbook.sheets[0];
                                <?php if(isset($contacorrente)): ?>
                                    for (var rowIndex = 1; rowIndex < sheet.rows.length; rowIndex++) { if (rowIndex < (sheet.rows.length - 1)) { var
                                        row=sheet.rows[rowIndex]; for (var cellIndex=4; cellIndex < row.cells.length; cellIndex ++) {
                                        row.cells[cellIndex].format="[Blue]#,##0.00_);[Red]-#,##0.00_);0.0;"  } } } <?php endif; ?>

                                sheet.frozenRows = 1;
                                sheet.mergedCells = ["A1:F1"];
                                sheet.name = "Relatorio_de_" + document.title + " -  CRIAATVA";

                                var myHeaders = [{
                                    value: "Relatório de " + document.title,
                                    textAlign: "center",
                                    background: "black",
                                    color: "#ffffff"
                                }];


                                console.log(e.workbook);
                                sheet.rows.splice(0, 0, {
                                    cells: myHeaders,
                                    type: "header",
                                    height: 20
                                });
                            },

                            pdf: {
                                fileName: "Relatório de " + document.title + ".pdf",

                                allPages: true,
                                avoidLinks: true,
                                paperSize: "A4",
                                margin: {
                                    top: "3.5cm",
                                    left: "1cm",
                                    right: "1cm",
                                    bottom: "0.5cm"
                                },

                                <?php if(isset($orientacao)): ?>
                                    landscape: true,
                                <?php else: ?>
                                    landscape: true,
                                <?php endif; ?>

                                repeatHeaders: false,
                                template: $("#page-template").html(),
                                scale: 0.8
                            },
                            filterable: {
                                extra: false,
                                mode: "row"
                            },
                            sortable: true,
                            resizable: true,
                            scrollable: true,
                            groupable: true,
                            columnMenu: true,
                            responsible: true,
                            reorderable: true,
                            width: 'auto',
                            pageable: {
                                pageSizes: [5, 10, 15, 20, 50, 100, 200, "Todos"],
                                numeric: false
                            },

            dataSource: {
                data: data,
                pageSize: 15,
                schema: {
                    model: {
                        fields: {
                            vencimento: { type: "date" },
                            precoReal: { type: "number" },
                        }
                    },
                },
                group: [{field: "despesaCodigoDespesa"}],
                aggregate: [{ field: "precoReal", aggregate: "sum" }]
            },

            columns: [
                { field: "vencimento", title: "Data", filterable: true, width: 85, format: "{0:dd/MM/yyyy}", filterable: { cell: { template: betweenFilter}} },
                { field: "idOS", title: "N° da OS", filterable: true, width: 60 },
                { field: "razaosocialFornecedor", title: "Fornecedor", filterable: true, width: 90 },
                { field: "descricaoDespesa", title: "Despesa", filterable: true, width: 90 },
                { field: "nomeFormaPagamento", title: "Forma Pagamento", filterable: true, width: 70 },
                { field: "precoReal", title: "Valor", filterable: true, width: 80, decimals: 2, aggregates: ["sum"], groupHeaderColumnTemplate: "Total por Grupo: #: kendo.toString(sum, 'c', 'pt-BR') #", footerTemplate: "Total Geral: #: kendo.toString(sum, 'c', 'pt-BR') #", format: '{0:0.00}' },
                { field: "apelidoConta", title: "Conta", filterable: true, width: 60 },            
                { field: "despesaCodigoDespesa", title: "Cód Despesa", filterable: true, width: 60 },            
                { field: "grupoDespesa", title: "Grupo", filterable: true, width: 60 }            
                ],
                <?php echo $__env->make('layouts/helpersview/finaltabela', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('layouts/filtradata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</script>
<?php else: ?>  
<?php echo $__env->make('layouts/helpersview/finalnaoautorizado', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/relatorio/contaspagasporgrupo/index.blade.php ENDPATH**/ ?>