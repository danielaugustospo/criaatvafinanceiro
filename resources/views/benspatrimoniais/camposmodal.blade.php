@include('layouts/modal/includesmodal')

@if (isset($mensagem))
<div class="alert alert-success" role="alert">
    <p>{{ $mensagem }}</p>
</div>
@endif


{!! Form::open(array('route' => 'cadastromateriais','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeBensPatrimoniais" class="col-sm-1 col-form-label">Descrição de item comprado </label>
    <div class="col-sm-10">
        {!! Form::text('nomeBensPatrimoniais', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>

<div class="form-group row">
    <label for="idTipoBensPatrimoniais" class="col-sm-1 col-form-label">Tipo</label>
    <div class="col-sm-10">
        <select name="idTipoBensPatrimoniais" id="idTipoBensPatrimoniais" class="selecionaComInput form-control">
            @foreach ($listaTiposBensPatrimoniais as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<input type="button" class="btn btn-primary" data-toggle="modal"  data-target=".tipomaterial" value="Cadastrar Novo Tipo" style="cursor: pointer;">
@include('despesas/cadastratipomaterial')



{!! Form::hidden('statusbenspatrimoniais', '1', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'statusbenspatrimoniais', 'maxlength' => '100']) !!}
{!! Form::hidden('descricaoBensPatrimoniais', '0', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'descricaoBensPatrimoniais', 'maxlength' => '100']) !!}


{!! Form::hidden('ativadoBensPatrimoniais', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativadoBensPatrimoniais', 'maxlength' => '1']) !!}
{!! Form::hidden('excluidoBensPatrimoniais', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'id' => 'excluidoBensPatrimoniais', 'maxlength' => '1']) !!}

{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}