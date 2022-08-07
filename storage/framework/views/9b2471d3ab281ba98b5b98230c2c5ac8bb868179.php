<?php echo $__env->make('despesas/script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('despesas/estilo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    // Show full page LoadingOverlay
    $.LoadingOverlay("show", {
        image: "",
        text: "Carregando..."
    });

    setTimeout(function() {
        $.LoadingOverlay("text", "Finalizando...");
        $.LoadingOverlay("hide");
    }, 2500);
    // setTimeout(function() {
    //     $.LoadingOverlay("hide");
    // }, 900);
</script>
<?php echo csrf_field(); ?>

<br>
<hr>

<?php echo $__env->make('despesas/formulario/perguntaslancamento', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="pl-2 pr-2" id="telaGeral">
    <div class="tabelaDespesas" id="tabelaMultiplasDespesas">
        <div class="pb-2 container row">
        </div>
        <?php echo $__env->make('despesas/formulario/tabelamultiplasdespesas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <br>
    <hr>

    <div class="form-group row">
        <label for="despesaCodigoDespesas" class="col-sm-2 col-form-label">Código da Despesa</label>
        <div class="col-sm-4">
            <select name="despesaCodigoDespesas" id="despesaCodigoDespesas"
                class="selecionaComInput col-sm-12 despesaCodigoDespesas" <?php echo e($variavelDisabledNaView); ?> required>

                <?php if(!isset($despesa->despesaCodigoDespesas) ||
                    $despesa->despesaCodigoDespesas == null ||
                    $despesa->despesaCodigoDespesas == '' ||
                    $despesa->despesaCodigoDespesas == 0): ?>
                    <?php echo $infoSelectVazio; ?>

                <?php endif; ?>

                <?php $__currentLoopData = $codigoDespesa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listaCodigoDespesas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($listaCodigoDespesas->id); ?>" <?php if(isset($despesa) && $despesa->despesaCodigoDespesas == $listaCodigoDespesas->id): ?> selected <?php endif; ?>>
                        <?php echo e($listaCodigoDespesas->despesaCodigoDespesa); ?> | <?php echo e($listaCodigoDespesas->grupoDespesa); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div class="divRecarregaCodigoDespesa"></div>
        </div>

        <div class="col-sm2">
            <button type="button" onclick="recarregaCodigoDespesa()" class="btn btn-dark"><i
                    class="fas fa-sync"></i></i></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".codigodespesa"><i
                    class="fas fa-industry pr-1"></i>Cadastrar Código de Despesa</button>
        </div>

    </div>

    <div class="form-group row" id="telaOS">
        <label for="idOS" class="col-sm-2 col-form-label">OS</label>
        <div class="col-sm-7">

            <select name="idOS" id="idOS" class="selecionaComInput col-sm-10" <?php echo e($variavelDisabledNaView); ?>>
                <option value="CRIAATVA">SEM OS</option>
                <?php $__currentLoopData = $todasOSAtivas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listaOS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($despesa)): ?>
                        <?php if($despesa->idOS == $listaOS->id): ?>
                            <option value="<?php echo e($listaOS->id); ?>" selected><?php echo e($listaOS->id); ?> |
                                <?php echo e($listaOS->eventoOrdemdeServico); ?></option>
                            <?php if($despesa->idOS == 'CRIAATVA'): ?>
                                <option value="CRIAATVA" selected>SEM OS</option>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <option value="<?php echo e($listaOS->id); ?>"><?php echo e($listaOS->id); ?> |
                        <?php echo e($listaOS->eventoOrdemdeServico); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    
    <div class="form-group row" id="telaDescricao">
        <label for="descricaoDespesa" class="col-sm-2 col-form-label">Descrição da Despesa</label>
        <div class="col-sm-6">

            <div id="despesaCompra">
                <select class="selecionaComInput form-control descricaoDespesaCompra" id="descricaoDespesa"
                    name="descricaoDespesaCompra">
                    <?php if(!isset($despesa)): ?>
                        <option disabled selected>Selecione...</option>
                    <?php endif; ?>
                    <?php $__currentLoopData = $listaBensPatrimoniais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bempatrimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($bempatrimonial->id); ?>" <?php
                            if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa == $bempatrimonial->id):
                                echo 'selected';
                            endif;
                        ?>>
                            <?php echo e($bempatrimonial->nomeBensPatrimoniais); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

            </div>
            <div id="despesaCompraSemEstoque">
                <input class="form-control descricaoDespesaSemEstoque" id="descricaoDespesa" <?php
                    if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa != null):
                        echo 'value="' . $despesa->descricaoDespesa . '"' . $variavelDisabledNaView;
                    endif;
                ?>
                    name="descricaoDespesaSemEstoque">
            </div>
            <div id="despesaNaoCompra">
                <input class="form-control descricaoDespesa" list="datalistDescricao" id="descricaoDespesa"
                    <?php
                        if (isset($despesa->descricaoDespesa) && $despesa->descricaoDespesa != null):
                            echo 'value="' . $despesa->descricaoDespesa . '"' . $variavelDisabledNaView;
                        endif;
                    ?> name="descricaoDespesaNaoCompra" placeholder="Digite ou selecione...">
                <datalist id="datalistDescricao">
                    <?php $__currentLoopData = $listaDespesas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listaDespesas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($listaDespesas->descricaoDespesa); ?>">
                            <?php echo e($listaDespesas->descricaoDespesa); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </datalist>
            </div>
        </div>

        
        <div class="col-sm-4" id="telaCadastrarMateriais">
            <button type="button" onclick="recarregaDescricaoDespesa()" class="btn btn-dark"><i
                    class="fas fa-sync"></i></i></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".materiais"><i
                    class="fas fa-industry pr-1"></i>Cadastrar Materiais</button>
        </div>

    </div>

    
    <div class="form-group row" id="telaFornecedor">
        <label for="" class="col-sm-2 col-form-label">Fornecedor/Prestador de Serviço</label>
        <div class="col-sm-4">
            <select name="idFornecedor" id="selecionaFornecedor"
                class="selecionaComInput selecionaFornecedor form-control col-sm-12" <?php echo e($variavelDisabledNaView); ?>>
                <?php if(!isset($despesa->idFornecedor) ||
                    $despesa->idFornecedor == null ||
                    $despesa->idFornecedor == '' ||
                    $despesa->idFornecedor == 0): ?>
                    <?php echo $infoSelectVazio; ?>

                <?php endif; ?>
                <?php $__currentLoopData = $listaFornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($fornecedor->id); ?>" <?php if(isset($despesa) && $despesa->idFornecedor == $fornecedor->id): ?> selected <?php endif; ?>>
                        <?php echo e($fornecedor->razaosocialFornecedor); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="col-sm-4 pl-0">
            <button type="button" onclick="recarregaFornecedorDespesa()" class="btn btn-dark"><i
                    class="fas fa-sync"></i></i></button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".fornecedor"><i
                    class="fas fa-industry pr-1"></i>Cadastrar Fornecedor</button>
        </div>
    </div>

    <br>

    <div class="form-group row">
        <label for="idFormaPagamento" class="col-sm-2 col-form-label">Forma Pagamento</label>
        <div class="col-sm-4">
            <select name="idFormaPagamento" id="idFormaPagamento"
                class="selecionaComInput form-control col-sm-12 idFormaPagamento" <?php echo e($variavelDisabledNaView); ?>>
                <?php if(!isset($despesa->idFormaPagamento) ||
                    $despesa->idFormaPagamento == null ||
                    $despesa->idFormaPagamento == '' ||
                    $despesa->idFormaPagamento == 0): ?>
                    <?php echo $infoSelectVazio; ?>

                <?php endif; ?>
                <?php $__currentLoopData = $formapagamento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaPG): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($formaPG->id); ?>" <?php if(isset($despesa) && $despesa->idFormaPagamento == $formaPG->id): ?> selected <?php endif; ?>>
                        <?php echo e($formaPG->nomeFormaPagamento); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="conta" class="col-sm-2 col-form-label">Conta</label>
        <div class="col-sm-4">
            <select name="conta" id="conta"
                class="selecionaComInput form-control col-sm-12  js-example-basic-multiple conta"
                <?php echo e($variavelDisabledNaView); ?>>

                <?php if(!isset($despesa->conta) || $despesa->conta == null || $despesa->conta == '' || $despesa->conta == 0): ?>
                    <?php echo $infoSelectVazio; ?>

                <?php endif; ?>

                <?php $__currentLoopData = $listaContas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($contas->id); ?>" <?php if(isset($despesa) && $despesa->conta == $contas->id): ?> selected <?php endif; ?>>
                        <?php echo e($contas->nomeConta); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    
    <div class="form-group row" id="telaQuantidade">
        <label for="quantidade" class="col-sm-2 col-form-label">Quantidade / Unidade</label>
        <div class="col-sm-2">
            <?php echo Form::text('quantidade', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'class' => 'form-control',
                'maxlength' => '20',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
        <label for="valorUnitario" class="col-sm-1 col-form-label">Valor Unitário</label>
        <div class="col-sm-2">
            <?php echo Form::text('valorUnitario', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'class' => 'form-control campo-moeda valoresoperacao',
                'maxlength' => '50',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
    </div>

    <div class="form-group row" id="telaValor">
        <label for="precoReal" class="col-sm-2 col-form-label">Valor</label>
        <div class="col-sm-2">
            <?php echo Form::text('precoReal', $precoReal, [
                'class' => 'campo-moeda form-control precoReal',
                'maxlength' => '100',
                'id' => 'precoReal',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
        <label for="vale" style="color: red;" class="col-sm-1 col-form-label">Vale</label>
        <div class="col-sm-2">
            <?php echo Form::text('vale', $vale, [
                'class' => 'campo-moeda form-control',
                'style' => 'color: red;',
                'maxlength' => '100',
                'id' => 'vale',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
        <label for="datavale" style="color: red;" class="col-sm-1 col-form-label">Data Vale</label>
        <div class="col-sm-2">
            <?php echo Form::date('datavale', $valorInput, [
                'class' => 'campo-moeda form-control',
                'style' => 'color: red;',
                'min' => '2000-01-01',
                'max' => '2099-12-31',
                'id' => 'datavale',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
    </div>

    <div class="form-group row" id="telaDataCompra">
        <label for="dataDaCompra" class="col-sm-2 col-form-label">Data da Compra</label>
        <div class="col-sm-3">
            <?php echo Form::date('dataDaCompra', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'min' => '2000-01-01',
                'max' => '2099-12-31',
                'class' => 'form-control',
                'id' => 'dataDaCompra',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
    </div>

    <div class="form-group row" id="telaDataTrabalho">
        <label for="dataDoTrabalho" class="col-sm-2 col-form-label">Data do Trabalho</label>
        <div class="col-sm-3">
            <?php echo Form::date('dataDoTrabalho', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'min' => '2000-01-01',
                'max' => '2099-12-31',
                'class' => 'form-control',
                'id' => 'dataDoTrabalho',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
    </div>


    <div class="form-group row" id="telaDataPagamento">
        <label for="vencimento" class="col-sm-2 col-form-label">Data do Pagamento (Vencimento)</label>
        <div class="col-sm-3">
            <?php echo Form::date('vencimento', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'min' => '2000-01-01',
                'max' => '2099-12-31',
                'class' => 'form-control',
                'id' => 'vencimento',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
    </div>


    <div class="form-group row" id="telaNF">
        <label for="notaFiscal" class="col-sm-2 col-form-label">Nota Fiscal</label>
        <div class="col-sm-2">
            <?php echo Form::text('notaFiscal', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'class' => 'form-control',
                'maxlength' => '20',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
    </div>

    <div class="form-group row" id="divComprou">
        <label for="quemComprouSelect" class="col-sm-2 col-form-label">Quem Comprou</label>
        <div class="col-sm-4">
            <select onchange="alteraIdComprador();" name="quemComprouSelect" id="selecionaComprador"
                class="selecionaComInput quemComprouSelect form-control" <?php echo e($variavelDisabledNaView); ?>>

                <?php if(!isset($despesa->quemcomprou) ||
                    $despesa->quemcomprou == null ||
                    $despesa->quemcomprou == '' ||
                    $despesa->quemcomprou == 0): ?>
                    <?php echo $infoSelectVazio; ?>

                <?php endif; ?>

                <?php $__currentLoopData = $listaFornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($fornecedor->id); ?>" <?php if(isset($despesa) && $despesa->quemcomprou == $fornecedor->id): ?> selected <?php endif; ?>>
                        <?php echo e($fornecedor->razaosocialFornecedor); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <input type="hidden" value="<?php echo e(old('quemcomprou')); ?>" name="quemcomprou" id="quemcomprou">
    </div>

    <div class="form-group row">
        <label for="idBanco" class="col-sm-2 col-form-label">Banco</label>
        <div class="col-sm-4">
            <select name="idBanco" id="idBanco" class="selecionaComInput form-control"
                <?php echo e($variavelDisabledNaView); ?>>
                <?php if(!isset($despesa->idBanco) || $despesa->idBanco == null || $despesa->idBanco == '' || $despesa->idBanco == 0): ?>
                    <?php echo $infoSelectVazio; ?>

                <?php endif; ?>
                <?php $__currentLoopData = $listaBancos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listaBancosViewEdit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($listaBancosViewEdit->id); ?>" <?php if(isset($despesa) && $despesa->idBanco == $listaBancosViewEdit->id): ?> selected <?php endif; ?>>
                        <?php echo e($listaBancosViewEdit->codigoBanco); ?> | <?php echo e($listaBancosViewEdit->nomeBanco); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="cheque" class="col-sm-2 col-form-label">Cheque</label>
        <div class="col-sm-2">
            <?php echo Form::text('cheque', $valorInput, [
                'placeholder' => 'Preencha este campo',
                'class' => 'form-control',
                'maxlength' => '100',
                $variavelReadOnlyNaView,
            ]); ?>

        </div>
    </div>

    
    <div class="form-group row" id="telaPago">
        <label for="pago" class="col-sm-2 col-form-label">Pago</label>
        <div class="col-sm-2">
            <select name="pago" id="pago" style="padding:4px;" class="selecionaComInput form-control"
                <?php echo e($variavelDisabledNaView); ?>>
                <?php if(Request::path() == 'despesas/create'): ?>
                    <option value="N">Não</option>
                    <option value="S">Sim</option>
                <?php else: ?>
                    <?php if(!isset($despesa->pago) || $despesa->pago == null || $despesa->pago == '' || $despesa->pago == 0): ?>
                        <?php echo $infoSelectVazio; ?>

                    <?php endif; ?>
                    <option value="S" <?php echo e($despesa->pago == 'S' ? ' selected' : ''); ?>>Sim</option>
                    <option value="N" <?php echo e($despesa->pago == 'N' ? ' selected' : ''); ?>>Não</option>
                <?php endif; ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="reembolsado" class="col-sm-2 col-form-label">Reembolsado</label>

        <div class="col-sm-4">
            <select name="reembolsado" id="reembolsado" class="selecionaComInput reembolsado form-control col-sm-12"
                <?php echo e($variavelDisabledNaView); ?>>

                <?php if(!isset($despesa->reembolsado) ||
                    $despesa->reembolsado == null ||
                    $despesa->reembolsado == '' ||
                    $despesa->reembolsado == 0): ?>
                    <?php echo $infoSelectVazio; ?>

                <?php endif; ?>

                <?php $__currentLoopData = $listaFornecedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fornecedor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($fornecedor->id); ?>" <?php if(isset($despesa) && $despesa->reembolsado == $fornecedor->id): ?> selected <?php endif; ?>>
                        <?php echo e($fornecedor->razaosocialFornecedor); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>


    <div class="form-group row">
        <?php if(Request::path() == 'despesas/create'): ?>
            <label for="despesaFixa" class="col-sm-2 col-form-label">Despesa Fixa?</label>
            <div class="col-sm-2">
                <select name="despesaFixa" id="despesaFixa"
                    class="selecionaComInput form-control col-sm-12  js-example-basic-multiple"
                    <?php echo e($variavelDisabledNaView); ?>>
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
        <?php elseif($despesa->idDespesaPai == 0 || $despesa->despesaFixa == null || $despesa->idDespesaPai == null): ?>
            <label for="despesaFixa" class="col-sm-2 col-form-label">Despesa Fixa?</label>
            <div class="col-sm-2">
                <select name="despesaFixa" id="despesaFixa"
                    class="selecionaComInput form-control col-sm-12  js-example-basic-multiple"
                    <?php echo e($variavelDisabledNaView); ?>>
                    <option value="0" <?php if($despesa->despesaFixa == '0' || $despesa->despesaFixa == null): ?> : <?php echo e('selected'); ?> <?php endif; ?>>Não
                    </option>
                    <option value="1" <?php echo e($despesa->despesaFixa == '1' ? ' selected' : ''); ?>>Sim</option>
                </select>
            </div>
        <?php else: ?>
            <label for="despesaFixa" class="text-center col-sm-12 mt-5 pr-2" style="color:red;">Esta despesa já é uma
                despesa fixa. Despesa Pai id n°<?php echo e($despesa->idDespesaPai); ?></label>
        <?php endif; ?>

        
        <div class="ml-5 pl-5 form-group row" id="telaPrestador">
            <label for="" class="col-sm-3 col-form-label ">Código Funcionário</label>
            <div class="col-sm-6">
                <select name="idFuncionario" id="idFuncionario" class="selecionaComInput form-control col-sm-12"
                    <?php echo e($variavelDisabledNaView); ?>>

                    <?php if(!isset($despesa->idFuncionario) ||
                        $despesa->idFuncionario == null ||
                        $despesa->idFuncionario == '' ||
                        $despesa->idFuncionario == 0): ?>
                        <?php echo $infoSelectVazio; ?>

                    <?php endif; ?>

                    <?php $__currentLoopData = $listaFuncionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($funcionario->id); ?>" <?php if(isset($despesa) && $despesa->idFuncionario == $funcionario->id): ?> selected <?php endif; ?>>
                            <?php echo e($funcionario->nomeFuncionario); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </select>
            </div>
        </div>

    </div>

    <?php echo $__env->make('despesas/cadastracodigodespesa', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('despesas/cadastramaterial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts/cadastrafornecedor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(!isset($despesa)): ?>
        <div class="tabelaDespesas" id="tabelaDespesas">
            <div class="pb-2 container row">
            </div>
            <?php echo $__env->make('despesas/formulario/tabelaparcelas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($paginaModal)): ?>
        <input type="hidden" value="1" name="paginaModal">
    <?php else: ?>
        <input type="hidden" value="0" name="paginaModal">
    <?php endif; ?>

    <?php echo e(Form::hidden('nRegistro', $valorSemCadastro, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10', $variavelReadOnlyNaView])); ?>


    <?php echo Form::hidden('idDespesaPai', $valorSemCadastro, [
        'placeholder' => 'Preencha este campo',
        'class' => 'form-control',
        'maxlength' => '2',
    ]); ?>

    <?php echo Form::hidden('ativoDespesa', '1', [
        'placeholder' => 'Ativo ',
        'class' => 'form-control',
        'maxlength' => '1',
        'id' => 'ativoDespesa',
    ]); ?>

    <?php echo Form::hidden('excluidoDespesa', $valorSemCadastro, [
        'placeholder' => 'Excluído ',
        'class' => 'form-control',
        'maxlength' => '1',
        'id' => 'excluidoDespesa',
    ]); ?>


</div>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/despesas/formulario/campos.blade.php ENDPATH**/ ?>