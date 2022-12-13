{!! Form::model($despesa, ['method' => 'PATCH', 'id' => 'criaDespesas', 'route' => ['despesas.update', $despesa->id]]) !!}

<input type="button" class="btn btn-success" id="btnSalvareVisualizar" value="Salvar"
onclick="alteraRetornoCadastroDespesa(retorno = 'visualiza');" />

@include('despesas/formulario/campos')


<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <input type="hidden" name="tpRetorno" id="tpRetorno" value="" />
    <input type="button" class="btn btn-success" id="btnSalvareVisualizar" value="Salvar"
        onclick="alteraRetornoCadastroDespesa(retorno = 'visualiza');" />

</div>
{!! Form::hidden('id', $despesa->id, ['class' => 'form-control', 'maxlength' => '500']) !!}
{!! Form::hidden('idAlteracaoUsuario', Auth::user()->id, [
    'placeholder' => 'Preencha este campo',
    'class' => 'form-control',
    'maxlength' => '5',
]) !!}

{!! Form::close() !!}
