<div id="informacoes" class="d-flex justify-content-center">
   
    <?php if(($receita == '')
    && ($valorreceita == '')
    && ($dtinicio == '')
    && ($dtfim == '')
    && ($ordemservico == '')
    && ($contareceita == '')
    && ($nfreceita == '')
    && ($cliente == '')
    && ($pagoreceita == '')): ?>
        <label class="pr-2" style="color: red;"><b>Não há filtros previamente selecionados</b></label>
    <?php else: ?>
        <label class="pr-2" style="color: red;"><b>Filtros:</b></label>
    <?php endif; ?>  
   
    <?php if($receita != ''): ?>
        <label><b>Receita:</b> <?php echo e($receita); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($valorreceita != ''): ?>
        <label><b>Valor:</b> <?php echo e($numberFormatter->format($valorreceita)); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($dtinicio != ''): ?>
        <label><b>Data Inicial:</b> <?php echo e(date('d/m/Y', strtotime($dtinicio))); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($dtfim != ''): ?>
        <label><b>Data Final:</b> <?php echo e(date('d/m/Y', strtotime($dtfim))); ?> &nbsp; </label>
    <?php endif; ?>

    <?php if($ordemservico != ''): ?>
        <label><b>Ordem de Serviço:</b> <?php echo e($ordemservico); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($contareceita != ''): ?>
        <label><b>Conta:</b> <?php echo e($contareceita); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($nfreceita != ''): ?>
        <label><b>Nota Fiscal:</b> <?php echo e($nfreceita); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($cliente != ''): ?>
        <label><b>Cliente:</b> <?php echo e($cliente); ?> &nbsp; </label>
    <?php endif; ?>
    <?php if($pagoreceita != ''): ?>
        <label><b>Pago:</b> <?php echo e($pagoreceita); ?> &nbsp; </label>
    <?php endif; ?>

</div>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/layouts/helpersview/infofiltrosreceita.blade.php ENDPATH**/ ?>