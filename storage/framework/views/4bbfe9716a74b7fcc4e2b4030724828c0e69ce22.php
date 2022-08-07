<div class="form-group row">
    <label for="idclientereceita" class="col-sm-2 col-form-label">Cliente/Receita</label>
    <div class="col-sm-10 mb-3">
        <select name="idclientereceita" id="idclientereceita" class="selecionaComInput form-control"
            style="width: -webkit-fill-available;" required <?php echo e($variavelDisabledNaView); ?>>
            <?php $__currentLoopData = $todosClientesAtivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listaClientes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($listaClientes->id); ?>">
                    <?php echo e($listaClientes->razaosocialCliente); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>


<div class="form-group row">
    <label class="col-sm-2 col-form-label">Descrição</label>
    <div class="col-sm-10">
        <?php echo Form::text('descricaoreceita', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100', 'required', $variavelReadOnlyNaView]); ?>

    </div>
</div>

<div class="form-group row">
    <label for="idformapagamentoreceita" class="col-sm-2 col-form-label">Forma Pagamento</label>
    <div class="col-sm-4">
        <select name="idformapagamentoreceita" id="idFormaPagamentoReceita"
            class="selecionaComInput form-control col-sm-12 js-example-basic-multiple" required
            <?php echo e($variavelDisabledNaView); ?>>
            <?php $__currentLoopData = $formapagamento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaPG): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($formaPG->id); ?>"><?php echo e($formaPG->nomeFormaPagamento); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="contareceita" class="col-sm-2 col-form-label">Conta</label>
    <div class="col-sm-4">
        <select name="contareceita" id="contaReceita"
            class="selecionaComInput col-sm-14 form-control js-example-basic-multiple" required
            <?php echo e($variavelDisabledNaView); ?>>
            <?php $__currentLoopData = $listaContas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($contas->id); ?>"
                    <?php if(@isset($receita->contareceita)): ?> <?php if($receita->contareceita == $contas->id): ?> selected <?php endif; ?> <?php endif; ?> >
                    <?php echo e($contas->nomeConta); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="valorreceita" class="col-sm-2 col-form-label">Valor</label>
    <div class="col-sm-2">
        <?php echo Form::text('valorreceita', $valorReceita, ['placeholder' => 'Preencha este campo', 'class' => 'campo-moeda col-sm-12 form-control', 'maxlength' => '100', 'id' => 'valorreceita', 'valor' => '0,00', 'required', $variavelReadOnlyNaView]); ?>

    </div>
</div>

<div class="form-group row">
    <label for="datapagamentoreceita" class="col-sm-2 col-form-label">Vencimento</label>
    <div class="col-sm-2">
        <?php echo Form::date('datapagamentoreceita', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100', 'required', $variavelReadOnlyNaView]); ?>

    </div>
</div>

<div class="form-group row">
    <label for="pagoreceita" class="col-sm-2 col-form-label">Pago</label>
    <div class="col-sm-2">
        <select name="pagoreceita" id="pagoreceita" style="padding:4px;" class="form-control" required
            <?php echo e($variavelDisabledNaView); ?>>
            <?php if(Request::path() == 'receita/create'): ?>
                <option value="N">Não</option>
                <option value="S" selected>Sim</option>
            <?php else: ?>
                <option value="S" <?php echo e($receita->pagoreceita == 'S' ? ' selected' : ''); ?>>Sim</option>
                <option value="N" <?php echo e($receita->pagoreceita == 'N' ? ' selected' : ''); ?>>Não</option>
            <?php endif; ?>
        </select>
    </div>
</div>


<?php echo Form::hidden('registroreceita', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100', $variavelReadOnlyNaView]); ?>

<?php echo Form::hidden('id', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']); ?>

<?php echo Form::hidden('dataemissaoreceita', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']); ?>



<?php echo Form::hidden('nfreceita', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-12 form-control', 'maxlength' => '100']); ?>

<?php /**PATH /var/www/clients/client2/web4/web/resources/views/receita/campos.blade.php ENDPATH**/ ?>