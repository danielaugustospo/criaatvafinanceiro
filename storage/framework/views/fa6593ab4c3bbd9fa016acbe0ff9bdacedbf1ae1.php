<div class="form-group row">
    <label for="nomeFuncionario" class="col-sm-2 col-form-label pt-0">Nome Completo do Funcionário <span style="color:red;">*</span></label>
    <div class="col-sm-10">
        <?php echo Form::text('nomeFuncionario', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control col-sm-12', 'maxlength' => '100', 'required', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<div class="form-group row">
    <label for="cepFuncionario" class="col-sm-2 col-form-label">CEP</label>
    <div class="col-sm-2">
        <?php echo Form::text('cepFuncionario', $valorInput, ['placeholder' => 'CEP', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'cep','onblur' =>'pesquisacep(this.value)', $variavelReadOnlyNaView]); ?>

    </div>
    <label for="enderecoFuncionario" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-6">
        <?php echo Form::text('enderecoFuncionario', $valorInput, ['placeholder' => 'Endereço', 'class' => 'form-control', 'id' => 'endereco', 'maxlength' => '100', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<div class="form-group row ">
    <label for="bairroFuncionario" class="col-sm-2 col-form-label">Bairro</label>
    <div class="col-sm-3">
        <?php echo Form::text('bairroFuncionario', $valorInput, ['placeholder' => 'Bairro', 'class' => 'form-control', 'id' => 'bairro', 'maxlength' => '30', 'readonly', $variavelReadOnlyNaView]); ?>

    </div>
    <label for="cidadeFuncionario" class="col-sm-2 col-form-label">Cidade</label>
    <div class="col-sm-3">
        <?php echo Form::text('cidadeFuncionario', $valorInput, ['placeholder' => 'Cidade', 'class' => 'form-control', 'id' => 'cidade', 'maxlength' => '30', 'readonly', $variavelReadOnlyNaView]); ?>

    </div>
    <label for="ufFuncionario" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        <?php echo Form::text('ufFuncionario', $valorInput, ['placeholder' => 'Estado', 'class' => 'form-control', 'id' => 'uf', 'maxlength' => '3', 'readonly', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<hr>
<h2>Contato</h2>
<div class="form-group row ">
    <label for="celularFuncionario" class="col-sm-2 col-form-label">Celular</label>
    <div class="col-sm-2">
        <?php echo Form::number('celularFuncionario', $valorInput, ['placeholder' => 'Celular', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11', $variavelReadOnlyNaView]); ?>

    </div>
    <label for="telresidenciaFuncionario" class="col-sm-2 col-form-label">Telefone Residência</label>
    <div class="col-sm-2">
        <?php echo Form::number('telresidenciaFuncionario', $valorInput, ['placeholder' => 'Tel Residência', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '10', $variavelReadOnlyNaView]); ?>

    </div>
    <label for="contatoemergenciaFuncionario" class="col-sm-2 col-form-label">Contato Emergência</label>
    <div class="col-sm-2">
        <?php echo Form::number('contatoemergenciaFuncionario', $valorInput, ['placeholder' => 'Contato Emergência', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '10', $variavelReadOnlyNaView]); ?>

    </div>

</div>
<div class="form-group row ">
    <label for="emailFuncionario" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
        <?php echo Form::email('emailFuncionario', $valorInput, ['placeholder' => 'E-mail', 'class' => 'form-control', $variavelReadOnlyNaView]); ?>

    </div>
    <label for="redesocialFuncionario" class="col-sm-2 col-form-label">Rede Social</label>
    <div class="col-sm-4">
        <?php echo Form::text('redesocialFuncionario', $valorInput, ['placeholder' => 'Rede Social', 'class' => 'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]); ?>

    </div>

</div>
<div class="form-group row ">
    <label for="facebookFuncionario" class="col-sm-2 col-form-label">Facebook</label>
    <div class="col-sm-4">
        <?php echo Form::text('facebookFuncionario', $valorInput, ['placeholder' => 'Facebook', 'class' => 'form-control', $variavelReadOnlyNaView]); ?>

    </div>
    <label for="redesocialFuncionario" class="col-sm-2 col-form-label">Telegram</label>
    <div class="col-sm-4">
        <?php echo Form::text('telegramFuncionario', $valorInput, ['placeholder' => 'Telegram', 'class' => 'form-control', 'maxlength' => '20', $variavelReadOnlyNaView]); ?>

    </div>

</div>
<hr>
<h2>Documentação do Funcionário</h2>
<div class="form-group row ">
    <label for="cpfFuncionario" class="col-sm-2 col-form-label">CPF <span style="color:red;">*</span></label>
    <div class="col-sm-4">
        <?php echo Form::number('cpfFuncionario', $valorInput, ['placeholder' => 'CPF (somente números)', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '11' , 'required', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<div class="form-group row ">
    <label for="rgFuncionario" class="col-sm-2 col-form-label">RG</label>
    <div class="col-sm-4">
        <?php echo Form::text('rgFuncionario', $valorInput, ['placeholder' => 'RG (somente números)', 'class' => 'form-control', 'maxlength' => '11', $variavelReadOnlyNaView]); ?>

    </div>
    <label for="orgaoRGFuncionario" class="col-sm-2 col-form-label">Órgão Emissor</label>
    <div class="col-sm-4">
        <select class="selecionaComInput form-control" name="orgaoRGFuncionario" <?php echo e($variavelDisabledNaView); ?>>
            <?php $__currentLoopData = $todosorgaosrg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listarg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($listarg->id); ?>"><?php echo e($listarg->nome); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <label for="expedicaoRGFuncionario" class="col-sm-2 col-form-label">Data de Emissão</label>
    <div class="col-sm-4">
        <?php echo Form::date('expedicaoRGFuncionario', $valorInput, ['class' => 'form-control', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<div class="form-group row ">
    <label for="tituloFuncionario" class="col-sm-2 col-form-label">Título de Eleitor</label>
    <div class="col-sm-4">
        <?php echo Form::number('tituloFuncionario', $valorInput, ['placeholder' => 'Título de Eleitor', 'class' => 'form-control', 'oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength' => '12', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<hr>
<h2>Filiação</h2>
<div class="form-group row ">
    <label for="maeFuncionario" class="col-sm-2 col-form-label">Mãe</label>
    <div class="col-sm-8">
        <?php echo Form::text('maeFuncionario', $valorInput, ['placeholder' => 'Mãe', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<div class="form-group row ">
    <label for="paiFuncionario" class="col-sm-2 col-form-label">Pai</label>
    <div class="col-sm-8">
        <?php echo Form::text('paiFuncionario', $valorInput, ['placeholder' => 'Pai', 'class' => 'form-control', 'maxlength' => '50', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<hr>
<h2>Dados Profissionais</h2>
<div class="form-group row ">
    <label for="profissaoFuncionario" class="col-sm-2 col-form-label">Profissão</label>
    <div class="col-sm-4">
        <?php echo Form::text('profissaoFuncionario', $valorInput, ['placeholder' => 'Profissão', 'class' => 'form-control', 'maxlength' => '30', $variavelReadOnlyNaView]); ?>

    </div>
    <label for="cargoEmpresaFuncionario" class="col-sm-2 col-form-label">Cargo na Empresa</label>
    <div class="col-sm-4">
        <?php echo Form::text('cargoEmpresaFuncionario', $valorInput, ['placeholder' => 'Cargo na Empresa', 'class' => 'form-control', 'maxlength' => '30', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<div class="form-group row ">
    <label for="tipocontratoFuncionario" class="col-sm-2 col-form-label">Tipo de Contrato</label>
    <div class="col-sm-4">

<select name="tipocontratoFuncionario" class="selecionaComInput form-control js-example-basic-multiple" <?php echo e($variavelDisabledNaView); ?>>
    <?php if(Request::path() == 'funcionarios/create'): ?>
        <option value="1">Estagiário</option>
        <option value="2">Temporário</option>
        <option value="3">Contrato Efetivo</option>
        <option value="4">Funcionário</option>
    <?php else: ?>
        <option value="1" <?php echo e($funcionario->tipocontratoFuncionario == '1'?' selected':''); ?>>Estagiário</option>
        <option value="2" <?php echo e($funcionario->tipocontratoFuncionario == '2'?' selected':''); ?>>Temporário</option>
        <option value="3" <?php echo e($funcionario->tipocontratoFuncionario == '3'?' selected':''); ?>>Contrato Efetivo</option>
        <option value="4" <?php echo e($funcionario->tipocontratoFuncionario == '4'?' selected':''); ?>>Funcionário</option>
    <?php endif; ?>
</select>

    </div>
</div>


<div class="form-group row">
    <label for="grauescolaridadeFuncionario" class="col-sm-2 col-form-label">Grau de Escolaridade</label>

    <div class="col-sm-6 mt-2">
        <?php if(Request::path() == 'funcionarios/create'): ?>
            <input type="radio" name="grauescolaridadeFuncionario" class="fundamental" value="0" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Fundamental</label><br>
            <input type="radio" name="grauescolaridadeFuncionario" class="medio" value="1" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Médio</label><br>
            <input type="radio" name="grauescolaridadeFuncionario" class="superior" value="2" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Superior Cursando</label><br>
            <input type="radio" name="grauescolaridadeFuncionario" class="superior" value="3" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Superior Completo</label>
        <?php else: ?>
            <input type="radio" <?php echo e($funcionario->grauescolaridadeFuncionario == '0'?' checked':''); ?> name="grauescolaridadeFuncionario" class="fundamental" value="0" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Fundamental</label><br>
            <input type="radio" <?php echo e($funcionario->grauescolaridadeFuncionario == '1'?' checked':''); ?> name="grauescolaridadeFuncionario" class="medio" value="1" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Médio</label><br>
            <input type="radio" <?php echo e($funcionario->grauescolaridadeFuncionario == '2'?' checked':''); ?> name="grauescolaridadeFuncionario" class="superior" value="2" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Superior Cursando</label><br>
            <input type="radio" <?php echo e($funcionario->grauescolaridadeFuncionario == '3'?' checked':''); ?> name="grauescolaridadeFuncionario" class="superior" value="3" style="cursor:pointer;">
            <label class="mr-2" for="">Ensino Superior Completo</label>
        <?php endif; ?>
    </div>

    <div id="divcurso" class="form-group row col-sm-4">
        <label for="descformacaoFuncionario" class="col-sm-2 col-form-label">Curso Superior</label>
        <?php echo Form::text('descformacaoFuncionario', $valorInput, ['placeholder' => 'Curso', 'class' => 'form-control', 'maxlength' => '30', 'id' => 'descformacaoFuncionario', $variavelReadOnlyNaView]); ?>

    </div>
</div>
<div class="form-group row">

    <label for="certficFuncionario" class="col-sm-2 col-form-label">Possui Certificação Profissional?</label>
    <?php if(Request::path() == 'funcionarios/create'): ?>

        <input type="radio" name="certficFuncionario" class="semcert mr-2 mt-3"  value="0">
        <label for="certficFuncionario" class="col-form-label pl-0">Não</label>

        <input type="radio" name="certficFuncionario" class="comcert ml-2 m-1 mt-3"  value="1">
        <label for="certficFuncionario" class="col-form-label pl-0">Sim</label>
    <?php else: ?>

        <input type="radio" name="certficFuncionario" class="semcert mr-2 mt-3" <?php echo e($funcionario->certficFuncionario == '0'?' checked':''); ?> value="0">
        <label for="certficFuncionario" class="col-form-label pl-0">Não</label>

        <input type="radio" name="certficFuncionario" class="comcert ml-2 m-1 mt-3" <?php echo e($funcionario->certficFuncionario == '1'?' checked':''); ?> value="1">
        <label for="certficFuncionario" class="col-form-label pl-0">Sim</label>
    <?php endif; ?>
</div>
<div id="divcertprof" class="form-group row col-sm-12 mt-2">
    <label for="uncertificadoraFuncionario" class="col-sm-2 col-form-label pl-0">Unidade Certificadora</label>
    <?php echo Form::text('uncertificadoraFuncionario', $valorInput, ['placeholder' => 'Unidade Certificadora', 'class' => 'form-control col-sm-4', 'maxlength' => '60', 'id' => 'uncertificadoraFuncionario', $variavelReadOnlyNaView]); ?>



    <label for="anocertificacaoFuncionario" class="col-sm-2 col-form-label">Ano Certificação</label>
    <?php echo Form::text('anocertificacaoFuncionario', $valorInput, ['placeholder' => 'Ano Certificação', 'class' => 'form-control col-sm-2', 'maxlength' => '4', 'id' => 'anocertificacaoFuncionario', $variavelReadOnlyNaView]); ?>


</div>
<hr>
<h2>Dados Bancários Funcionário</h2>
<?php echo $__env->make('funcionarios/dadosbancarios', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/funcionarios/campos.blade.php ENDPATH**/ ?>