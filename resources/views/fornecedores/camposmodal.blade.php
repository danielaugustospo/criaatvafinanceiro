@include('layouts/modal/includesmodal')

@if (isset($mensagem))
<div class="alert alert-success" role="alert">
    <p>{{ $mensagem }}</p>
</div>
@endif

{!! Form::open(array('route' => 'cadastrofornecedor','method'=>'POST')) !!}

<div class="form-group row">
    <label for="razaosocialFornecedor" class="col-sm-2 col-form-label">Razão Social <span style="color:red;">*</span></label> 

    <div class="col-sm-10">
        {!! Form::text('razaosocialFornecedor', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}
    </div>
</div>

{!! Form::hidden('ativoFornecedor', '1', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}
{!! Form::hidden('excluidoFornecedor', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '10']) !!}


{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}