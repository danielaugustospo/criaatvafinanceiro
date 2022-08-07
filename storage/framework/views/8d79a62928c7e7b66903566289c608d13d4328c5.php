<?php if(isset($mensagemExito)): ?>
<div class="alert alert-success  pr-2">
    <p><i class="fa fa-check" aria-hidden="true"></i><?php echo e($mensagemExito); ?></p>
</div>
<?php endif; ?>
<?php if($message = Session::get('success')): ?>
<div class="alert alert-success  pr-2">
    <p><i class="fa fa-check" aria-hidden="true"></i><?php echo e($message); ?></p>
</div>
<?php endif; ?>
<?php if($message = Session::get('error')): ?>
<div class="alert alert-error">
    <p><?php echo e($message); ?></p>
</div>
<?php endif; ?>
<?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning">
    <p><i class="fa fa-exclamation-triangle pr-2" aria-hidden="true"></i> <?php echo e($message); ?></p>
</div>
<?php endif; ?><?php /**PATH /var/www/clients/client2/web4/web/resources/views/layouts/helpersview/mensagemRetorno.blade.php ENDPATH**/ ?>