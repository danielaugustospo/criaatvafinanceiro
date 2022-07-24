{!! Form::model($despesa, ['method' => 'PATCH', 'route' => ['despesas.update', $despesa->id]]) !!}

    <button type="submit" class="btn btn-primary mt-1">Salvar</button>

@include('despesas/formulario/campos')


<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
{!! Form::hidden('id', $despesa->id, ['class' => 'form-control', 'maxlength' => '500']) !!}
{!! Form::hidden('idAlteracaoUsuario', Auth::user()->id, [
    'placeholder' => 'Preencha este campo',
    'class' => 'form-control',
    'maxlength' => '5',
]) !!}

{!! Form::close() !!}
