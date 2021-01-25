@extends('layouts.app')


@section('content')
@extends('ordemdeservicos.estilo')

<script>
$(function() {
    addColumn = function() {
        $("#habilita_receita").clone().appendTo("#novaDivReceita");
    }

    $('#btnAddColumn').click(addColumn);
});

function removerCampos() {
    $('.novaDivReceita').empty();
}
</script>


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Ordem de Serviço</h2>
            <h5>Última OS lançada no sistema: n°
                @foreach ($ultimaOS as $OsPassada)
                {{ $OsPassada->idMaximo }}
                @endforeach
            </h5>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('ordemdeservicos.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Ops!</strong> Ocorreram alguns erros com os valores inseridos.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


{!! Form::open(array('route' => 'ordemdeservicos.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="dataVendaOrdemdeServico" class="col-sm-2 col-form-label">Data Início</label>
    <div class="col-sm-6">
        {!! Form::text('dataVendaOrdemdeServico', $dataInicio , ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-4 form-control', 'maxlength' => '100', 'readonly']) !!}
    </div>
</div>

<div class="form-group row">

    <label for="idClienteOrdemdeServico" class="col-sm-2 col-form-label">Cliente</label>
    <div class="col-sm-6">
        <!-- {!! Form::text('idClienteOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->
        <select name="idClienteOrdemdeServico" id="idClienteOrdemdeServico" class="form-control  js-example-basic-multiple">
            @foreach ($cliente as $clientes)
            <option value="{{ $clientes->id }}">{{ $clientes->nomeCliente }}</option>
            @endforeach
        </select>
    </div>

    <label for="valorTotalOrdemdeServico" class="col-sm-2 col-form-label">Valor do Projeto</label>
    <div class="col-sm-2">
        {!! Form::number('valorTotalOrdemdeServico','',['class' => 'form-control','step'=>'any']) !!}
    </div>
</div>



<div class="form-group row">
    <label for="eventoOrdemdeServico" class="col-sm-2 col-form-label">Evento</label>
    <div class="col-sm-10">
        {!! Form::text('eventoOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}

    </div>
</div>

<div class="form-group row">
    <label for="obsOrdemdeServico" class="col-sm-2 col-form-label">Observação</label>
    <div class="col-sm-10">
        {!! Form::text('obsOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}

    </div>
</div>


{!! Form::hidden('atuacao', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}


{!! Form::hidden('idOS', 'null', ['placeholder' => 'Id OS ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'idOS']) !!}
{!! Form::hidden('excluidoDespesa', '0', ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}

<div class="pull-left">
    <h4>Forma de Pagamento</h4>
</div>

<hr>
<div class="row mb-4">
    <label class="col-sm-1" for="nfreceita">Nota Fiscal</label>
    {!! Form::text('nfreceita', '', ['placeholder' => 'N° Nota', 'class' => 'col-sm-3 form-control', 'maxlength' => '100', 'required']) !!}

</div>

<table class="styled-table" id="example-table">
    <thead>
        <tr>
            <input style="cursor: pointer;" id="btnAddColumn" class="btn btn-primary" value="Adicionar Parcela" readonly>
            <input onclick="removerCampos()" class="btn btn-danger" value="Remover Parcelas Extra" readonly style="cursor:pointer;">

            <th>Forma Pagamento</th>
            <th>Valor Parcela</th>
            <th>Pago</th>
            <th>Data Emissão NF</th>
            <th>Data de Pagamento</th>
            <th>Conta</th>
            {{-- <th>Nota Fiscal</th> --}}
        </tr>
    </thead>
    <tbody id="habilita_receita" class="habilita_receita">
        <tr>
            <td>
                <select name="idformapagamentoreceita[]" id="idFormaPagamentoReceita" class="form-control">
                    <option value="0" selected="selected">Sem Receita</option>
                    @foreach ($formapagamento as $formaPG)
                    <option value="{{ $formaPG->id }}">{{ $formaPG->nomeFormaPagamento }}</option>
                    @endforeach
                </select>

            </td>
            <td>
                {!! Form::number('valorreceita[]', '', ['placeholder' => 'Preencha o valor', 'class' => 'form-control', 'maxlength' => '100', 'step'=>'any', 'required']) !!}

            </td>
            <td>
                <select name="pagoreceita[]" id="pagoreceita" style="padding:0px;" class="form-control">
                    <option value="S">Sim</option>
                    <option value="N">Não</option>
                </select>
            </td>
            <td>
                {!! Form::date('dataemissaoreceita[]', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}
            </td>
            <td>
                {!! Form::date('datapagamentoreceita[]', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}
            </td>
            <td>
                <select name="contareceita[]" id="contaReceita" class="form-control js-example-basic-multiple">
                    @foreach ($listaContas as $contas)
                    <option value="{{ $contas->id }}">Agência {{ $contas->agenciaConta }} - Conta {{ $contas->numeroConta }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    </tbody>


</table>
<div class="novaDivReceita styled-table" id="novaDivReceita">
</div>


{!! Form::hidden('registroreceita', '0', ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}

{!! Form::hidden('idosreceita', 'null', ['placeholder' => 'Id OS Receita', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'idosreceita']) !!}

<input type="hidden" id="valorProjetoOrdemdeServico" class="form-control" name="valorProjetoOrdemdeServico" value="0.00" placeholder="Preencha o preço real" /><br>
<input type="hidden" id="valorOrdemdeServico" class="form-control" name="valorOrdemdeServico" value="0.00" placeholder="Preencha o preço real" /><br>

{!! Form::hidden('dataOrdemdeServico', '00-00-0000', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('dataCriacaoOrdemdeServico', '00-00-0000', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

{!! Form::hidden('clienteOrdemdeServico', 'Campo Nome da OS', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('servicoOrdemdeServico', 'Campo Serviço', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}


{!! Form::hidden('dataExclusaoOrdemdeServico', '00', ['placeholder' => 'Data Exclusão', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'dataExclusaoOrdemdeServico']) !!}
{!! Form::hidden('ativoOrdemdeServico', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoOrdemdeServico']) !!}
{!! Form::hidden('excluidoOrdemdeServico', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoOrdemdeServico']) !!}



{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}


<div id="tooltest0" class="tooltest0">
    <label>Tool Name :</label>
    <select class="toollist" name="FSR_tool_id[]" id="FSR_tool_id0" style="width: 350px" />
    <option></option>
    <option value="1">bla 1</option>
    </select>
    antes
</div>
<div id="tool-placeholder"></div>
depois
<div>
    <input type="button" value="Add another" />
</div>

<script>
    $('.toollist').select2({ //apply select2 to my element
        placeholder: "Search your Tool",
        allowClear: true
    });


    $('input[type=button]').click(function() {

        $('.toollist').select2("destroy");
        var noOfDivs = $('.tooltest0').length;
        var clonedDiv = $('.tooltest0').first().clone(true);
        clonedDiv.insertBefore("#tool-placeholder");
        clonedDiv.attr('id', 'tooltest' + noOfDivs);


        $('.toollist').select2({ //apply select2 to my element
            placeholder: "Search your Tool",
            allowClear: true
        });

    });
</script>

@endsection