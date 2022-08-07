<tr class="linhaTabela">
    <td>
        <?php echo Form::hidden('idReceita[]', $dadosreceita->idReceita, ['placeholder' => 'Preencha este campo', 'maxlength' => '100', 'class' => 'idReceita']); ?>

        <select name="idformapagamentoreceita[]" id="idFormaPagamentoReceita" class="selecionaComInput form-control" <?php echo e($disabledOrNo); ?>>
            <?php $__currentLoopData = $listaFormaPG; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaPG): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($formaPG->id == $dadosreceita->idformapagamentoreceita): ?>            
                    <option value="<?php echo e($formaPG->id); ?>" selected><?php echo e($formaPG->nomeFormaPagamento); ?></option>
                <?php elseif($dadosreceita->idformapagamentoreceita == '0'): ?>            
                    <option value="0" selected>Sem Receita</option>
                <?php endif; ?>
                    <option value="<?php echo e($formaPG->id); ?>"><?php echo e($formaPG->nomeFormaPagamento); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </select>
    </td>
    <td>
        <?php echo Form::text('valorreceita[]', $dadosreceita->valorreceita, ['placeholder' => 'Preencha o valor', 'class' => 'col campo-moeda form-control', 'maxlength' => '100', 'step'=>'any', 'id'=>'campo-moeda','required', $readonlyOrNo]); ?>

    </td>
    <td>
        <select name="pagoreceita[]" id="pagoreceita" style="padding:0px; width:150%;" class="form-control" <?php echo e($disabledOrNo); ?>>
            <option value="S" <?php echo e($dadosreceita->pagoreceita == 'S'?' selected':''); ?> style="background-color:green;">Sim</option>
            <option value="N" <?php echo e($dadosreceita->pagoreceita == 'N'?' selected':''); ?> style="background-color: #e3342f;">Não</option>
        </select>
    </td>
    <td>
        <?php echo Form::date('dataemissaoreceita[]', $dadosreceita->dataemissaoreceita, ['placeholder' => 'Preencha este campo', 'class' => 'col form-control', 'maxlength' => '100',  $readonlyOrNo]); ?>

    </td>
    <td>
        <?php echo Form::date('datapagamentoreceita[]', $dadosreceita->datapagamentoreceita, ['placeholder' => 'Preencha este campo', 'class' => 'col form-control', 'maxlength' => '100',  $readonlyOrNo ]); ?>

    </td>
    <td>
        <select name="contareceita[]" id="contaReceita" class="col-lg-12 selecionaComInput form-control" <?php echo e($disabledOrNo); ?>>
            <?php $__currentLoopData = $listaContas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($contas->id == $dadosreceita->contareceita): ?>            
                    <option value="<?php echo e($contas->id); ?>" selected><?php echo e($contas->apelidoConta); ?></option>
                <?php endif; ?>
                    <option value="<?php echo e($contas->id); ?>"><?php echo e($contas->apelidoConta); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </td>
    <td>
        <?php echo Form::text('nfreceita[]', $dadosreceita->nfreceita, ['placeholder' => 'N° Nota', 'class' => 'form-control', 'maxlength' => '100', 'required', $readonlyOrNo]); ?>

    </td>
    <td>
        <a href="#tabelaPagamento" class="duplicar pb-2">
            <span class="badge badge-primary">
                <i class="fa fa-clone" style="color: white;" aria-hidden="true"></i>
                Duplicar
            </span>
        </a>
        <a href="#tabelaPagamento" class="deletar" style="padding: 0%;">
            <span class="badge badge-danger">
                <i class="fa fa-trash" style="color: white;" aria-hidden="true"></i>
                Excluir
            </span>
        </a>
    </td>    
</tr>

<?php /**PATH /var/www/clients/client2/web4/web/resources/views/ordemdeservicos/trview.blade.php ENDPATH**/ ?>