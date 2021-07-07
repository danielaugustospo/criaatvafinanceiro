@include('layouts/modal/includesmodal')

<div class="container panel panel-default pt-2 pb-2">

    @if (isset($mensagem))
    <div class="alert alert-success" role="alert">
        <p>{{ $mensagem }}</p>
    </div>
    @endif
    {!! Form::open(array('route' => 'salvarmodalgrupodespesa','method'=>'POST')) !!}

    <div class="form-group row">
        <label for="grupoDespesa" class="col-sm-2 col-form-label">Nome do Grupo</label>
        <div class="col-sm-10">
            {!! Form::text('grupoDespesa', '', ['placeholder' => 'Grupo', 'class' => 'form-control', 'maxlength' => '100', 'id' => 'grupoDespesa']) !!}
        </div>

        {!! Form::hidden('ativoDespesa', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoDespesa']) !!}
        {!! Form::hidden('excluidoDespesa', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}

    </div>
    <button class="btn btn-success" id="submit">Salvar</button>

    {!! Form::close() !!}

</div>