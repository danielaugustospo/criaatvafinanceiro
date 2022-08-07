
<table class="rwd-table tabelalistadespesamultipla" id="tabelalistadespesamultipla" style="font-size: 12px;max-width: max-content;width: 120%;">

    <tbody>
        <div class="justify-content-center" style="background-color: black; color:white;"><h4>Múltiplos Lançamentos</h4></div>
        <div class="row">
            <th>ORDEM SERVIÇO</th>
            <th><nobr>NOTA FISCAL</nobr></th>
            <th>DESCRIÇÃO</th>
            <th>QUANTIDADE</th>
            <th><nobr>VALOR UNITÁRIO</nobr></th>
            <th><nobr>VALOR TOTAL</nobr></th>
            <th>VENCIMENTO</th>
            <th><nobr>PAGO EFETUADO</nobr></th>
            
            <th></th>
        </div>
        <tr name="teste">
            <td data-th="OS">
                <select class="form-control selecionaComInput" name="idOSTabelaMultiplo[]" id="idOSTabela">
                    
                    <option value="CRIAATVA">SEM OS</option>
                    <?php $__currentLoopData = $todasOSAtivas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listaOS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(isset($despesa)): ?>
                        <?php if($despesa->idOS == $listaOS->id): ?>
                          <option value="<?php echo e($listaOS->id); ?>" selected><?php echo e($listaOS->id); ?> | <?php echo e($listaOS->eventoOrdemdeServico); ?></option>
                          <?php if($despesa->idOS == 'CRIAATVA'): ?>
                            <option value="CRIAATVA" selected>SEM OS</option>              
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                          <option value="<?php echo e($listaOS->id); ?>"><?php echo e($listaOS->id); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </td>
            <td data-th="NF">
                <?php echo Form::text('notaFiscalTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]); ?>

            </td>
            <td class="col-sm-2" data-th="DESCRIÇÃO">
                <div class="form-group row mt-3" id="telaDescricaoTabelaComEstoqueMultiplo">
                    <button type="button" onclick="recarregaDescricaoDespesaTabelaMultiplo()" class="btn btn-dark"><i
                        class="fas fa-sync"></i></i></button>
                    <button type="button"  data-toggle="modal" data-target=".materiais" class="btn btn-primary"><i
                        class="fas fa-plus"></i></i></button>
                    
                    <select class="selecionaComInput pt-3 required descMultiplo descricaoTabela" name="descricaoTabelaMultiplo[]" id="descricaoDespesaTabela">
                        <?php if(!isset($despesa)): ?>
                            <option disabled value="" selected>Selecione...</option>
                        <?php endif; ?>
                        <?php $__currentLoopData = $listaBensPatrimoniais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bempatrimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($bempatrimonial->id); ?>"><?php echo e($bempatrimonial->nomeBensPatrimoniais); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        required
                    </select>
                </div>
                <div class="form-group row mt-3" id="telaDescricaoTabelaSemEstoqueMultiplo">
                    <input class="form-control descricaoTabelaSemEstoque"     style="font-size: .7rem;"  id="descricaoDespesa" <?php
                    if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa != null):
                        echo 'value="' . $despesa->descricaoDespesa . '"';
                    endif; ?> name="descricaoTabelaSemEstoqueMultiplo[]" maxlength="50">

                    
                </div>
            </td>
            <td data-th="QUANTIDADE">
                <?php echo Form::text('quantidadeTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control valoresoperacao quantidadeTabela', 'max' => '2999-12-31', 'id' => 'quantidadeTabela', $variavelReadOnlyNaView]); ?>


                


                </datalist>

            </td>
            <td data-th="VALOR UNITÁRIO">
                <?php echo Form::text('valorUnitarioTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control campo-moeda valoresoperacao valunitariomultiplo', 'maxlength' => '100', $variavelReadOnlyNaView]); ?>

            </td>

            <td data-th="VALOR TOTAL">
                <?php echo Form::text('valorparcelaTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class'
                => 'form-control campo-moeda valoresoperacao valorparcelaTabela valtotalmultiplo', 'maxlength' => '100', $variavelReadOnlyNaView]); ?>

            </td>
            <td data-th="VENCIMENTO">
                <?php echo Form::date('vencimentoTabelaMultiplo[]', $valorInput, ['placeholder' => 'Preencha este campo', 'class' =>
                'form-control vencimentoTabela', 'min' => '2000-01-01', 'max' => '2099-12-31', $variavelReadOnlyNaView]); ?>

            </td>
            <td>
                <select name="pagoTabelaMultiplo[]" id="pago" style="padding:4px;" class="selecionaComInput form-control" style=" min-width: 100px !important;"
                    <?php echo e($variavelDisabledNaView); ?>>
                    <?php if(Request::path() == 'despesas/create'): ?>
                    <option value="N">Não</option>
                    <option value="S">Sim</option>
                    <?php else: ?>
                    <option value="N" <?php echo e($despesa->pago == 'N'?' selected':''); ?>>Não</option>
                    <option value="S" <?php echo e($despesa->pago == 'S'?' selected':''); ?>>Sim</option>
                    <?php endif; ?>
                </select>
            </td>
            
            <td>
                <a href="#tabelaPagamento" class="duplicarNaoParceladoMultiplo" id="duplicarNaoParceladoMultiplo">
                    <span class="badge badge-primary">
                        <i class="fa fa-clone" style="color: white;" aria-hidden="true"></i>
                        Duplicar
                    </span>
                </a>
                <a href="#tabelaPagamento" class="deleteNaoParceladoMultiplo" id="deleteNaoParceladoMultiplo">
                    <span class="badge badge-danger">
                        <i class="fa fa-trash" style="color: white;" aria-hidden="true"></i>
                        Excluir
                    </span>
                </a>
            </td>
        </tr>
    </tbody>

</table><?php /**PATH /var/www/clients/client2/web4/web/resources/views/despesas/formulario/tabelamultiplasdespesas.blade.php ENDPATH**/ ?>