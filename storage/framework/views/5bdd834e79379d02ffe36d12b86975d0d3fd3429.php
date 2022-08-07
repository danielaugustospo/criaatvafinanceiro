<div id="informacoes" class="d-flex justify-content-center">

    <?php if($despesas == '' && $valor == '' && $dtinicio == '' && $dtfim == '' && $coddespesa == '' && $fornecedor == '' && $ordemservico == '' && $conta == '' && $notafiscal == '' && $cliente == '' && $fixavariavel == '' && $pago == ''): ?>
        <label class="pr-2" style="color: red;"><b>Não há filtros previamente selecionados</b></label>
    <?php else: ?>
        <label class="pr-2" style="color: red;"><b>Filtros:</b></label>
    <?php endif; ?>

    <?php if($despesas != ''): ?>
        <label><b>Despesa:</b> <?php echo e($despesas); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($valor != ''): ?>
        <label><b>Valor:</b> <?php echo e($numberFormatter->format($valor)); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($dtinicio != ''): ?>
        <label><b>Data Inicial:</b> <?php echo e(date('d/m/Y', strtotime($dtinicio))); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($dtfim != ''): ?>
        <label><b>Data Final:</b> <?php echo e(date('d/m/Y', strtotime($dtfim))); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($coddespesa != ''): ?>
        <label><b>Cód de Despesa:</b> <?php echo e($coddespesa); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($fornecedor != ''): ?>
        <label><b>Fornecedor:</b> <?php echo e($fornecedor); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($ordemservico != ''): ?>
        <label><b>Ordem de Serviço:</b> <?php echo e($ordemservico); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($conta != ''): ?>
        <label><b>Conta:</b> <?php echo e($conta); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($notafiscal != ''): ?>
        <label><b>Nota Fiscal:</b> <?php echo e($notafiscal); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($cliente != ''): ?>
        <label><b>Cliente:</b> <?php echo e($cliente); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($fixavariavel != ''): ?>
        <label><b>Fixa ou Variável:</b> <?php echo e($fixavariavel); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($pago != ''): ?>
        <label><b>Pago:</b> <?php echo e($pago); ?> &nbsp; </label>
    <?php endif; ?>




</div>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/layouts/helpersview/infofiltrosdepesa.blade.php ENDPATH**/ ?>