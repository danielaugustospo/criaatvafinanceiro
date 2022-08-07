<div class="form-group row"><label class="col-sm-2 col-form-label"><u>1° Conta</u></label></div>

<div class="form-group row">

    <label for="contacorrenteFornecedor1" class="col-sm-2 col-form-label">Dados Bancários - Sistema Legado</label>
    <div class="col-sm-8">
        <?php echo Form::text('dadoslegado', $valorInput, [
            'placeholder' => 'Preencha este campo',
            'class' => 'form-control',
            'maxlength' => '50',
            'readonly',
        ]); ?>

    </div>
</div>
<div class="form-group row">

    <label for="contacorrenteFornecedor1" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

        <select name="contacorrenteFornecedor1" class="selecionaComInput  form-control js-example-basic-multiple"
            <?php echo e($variavelDisabledNaView); ?>>
            <?php if(Request::path() == 'fornecedores/create'): ?>
                <option value="cc">Conta Corrente</option>
                <option value="cp">Conta Poupança</option>
            <?php else: ?>
                <option value="cc" <?php echo e($fornecedor->contacorrenteFornecedor1 == 'cc' ? ' selected' : ''); ?>>Conta Corrente
                </option>
                <option value="cp" <?php echo e($fornecedor->contacorrenteFornecedor1 == 'cp' ? ' selected' : ''); ?>>Conta Poupança
                </option>
            <?php endif; ?>

        </select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor1" <?php echo e($variavelDisabledNaView); ?>>
            <?php $__currentLoopData = $todososbancos1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bancos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($bancos->codigoBanco); ?>">
                    <?php echo e($bancos->codigoBanco); ?> | <?php echo e($bancos->nomeBanco); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        <?php echo Form::text('nrcontaFornecedor1', $valorInput, [
            'placeholder' => 'Número Conta',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]); ?>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        <?php echo Form::text('agenciaFornecedor1', $valorInput, [
            'placeholder' => 'Agência',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]); ?>

    </div>
    <label for="chavePixFornecedor1" class="col-sm-1 col-form-label">1° PIX</label>
    <div class="col-sm-4">
        <?php echo Form::text('chavePixFornecedor1', $valorInput, [
            'placeholder' => 'Preencha este campo',
            'class' => 'form-control',
            'maxlength' => '50',
            $variavelReadOnlyNaView,
        ]); ?>

    </div>
</div>


<hr>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>2° Conta</u></label></div>
<div class="form-group row">

    <label for="contacorrenteFornecedor2" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

        <select name="contacorrenteFornecedor2" class="selecionaComInput  form-control js-example-basic-multiple"
            <?php echo e($variavelDisabledNaView); ?>>
            <?php if(Request::path() == 'fornecedores/create'): ?>
                <option value="cc">Conta Corrente</option>
                <option value="cp">Conta Poupança</option>
            <?php else: ?>
                <option value="cc" <?php echo e($fornecedor->contacorrenteFornecedor2 == 'cc' ? ' selected' : ''); ?>>Conta Corrente
                </option>
                <option value="cp" <?php echo e($fornecedor->contacorrenteFornecedor2 == 'cp' ? ' selected' : ''); ?>>Conta Poupança
                </option>
            <?php endif; ?>

        </select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor2" <?php echo e($variavelDisabledNaView); ?>>
            <?php $__currentLoopData = $todososbancos2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bancos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($bancos->codigoBanco); ?>"> <?php echo e($bancos->codigoBanco); ?> | <?php echo e($bancos->nomeBanco); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        <?php echo Form::text('nrcontaFornecedor2', $valorInput, [
            'placeholder' => 'Número Conta',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]); ?>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        <?php echo Form::text('agenciaFornecedor2', $valorInput, [
            'placeholder' => 'Agência',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]); ?>

    </div>
    <label for="chavePixFornecedor2" class="col-sm-1 col-form-label">2° PIX</label>
    <div class="col-sm-4">
        <?php echo Form::text('chavePixFornecedor2', $valorInput, [
            'placeholder' => 'Preencha este campo',
            'class' => 'form-control',
            'maxlength' => '50',
            $variavelReadOnlyNaView,
        ]); ?>

    </div>
</div>

<hr>
<div class="form-group row"><label class="col-sm-2 col-form-label"><u>3° Conta</u></label></div>
<div class="form-group row">

    <label for="contacorrenteFornecedor2" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-2">

        <select name="contacorrenteFornecedor3" class="selecionaComInput  form-control js-example-basic-multiple"
            <?php echo e($variavelDisabledNaView); ?>>
            <?php if(Request::path() == 'fornecedores/create'): ?>
                <option value="cc">Conta Corrente</option>
                <option value="cp">Conta Poupança</option>
            <?php else: ?>
                <option value="cc" <?php echo e($fornecedor->contacorrenteFornecedor3 == 'cc' ? ' selected' : ''); ?>>Conta
                    Corrente</option>
                <option value="cp" <?php echo e($fornecedor->contacorrenteFornecedor3 == 'cp' ? ' selected' : ''); ?>>Conta
                    Poupança</option>
            <?php endif; ?>

        </select>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Banco</label>
    <div class="col-sm-7">
        <select class="selecionaComInput form-control" name="bancoFornecedor3" <?php echo e($variavelDisabledNaView); ?>>
            <?php $__currentLoopData = $todososbancos3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bancos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($bancos->codigoBanco); ?>"><?php echo e($bancos->codigoBanco); ?> | <?php echo e($bancos->nomeBanco); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-2">
        <?php echo Form::text('nrcontaFornecedor3', $valorInput, [
            'placeholder' => 'Número Conta',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]); ?>

    </div>
    <label for="valor2" class="col-sm-1 col-form-label">Agência</label>
    <div class="col-sm-2">
        <?php echo Form::text('agenciaFornecedor3', $valorInput, [
            'placeholder' => 'Agência',
            'class' => 'form-control',
            'maxlength' => '11',
            $variavelReadOnlyNaView,
        ]); ?>

    </div>
    <label for="chavePixFornecedor3" class="col-sm-1 col-form-label">3° PIX</label>
    <div class="col-sm-4">
        <?php echo Form::text('chavePixFornecedor3', $valorInput, [
            'placeholder' => 'Preencha este campo',
            'class' => 'form-control',
            'maxlength' => '50',
            $variavelReadOnlyNaView,
        ]); ?>

    </div>
</div>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/fornecedores/dadosbancarios.blade.php ENDPATH**/ ?>