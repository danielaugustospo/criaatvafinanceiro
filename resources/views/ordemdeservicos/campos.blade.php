{{-- <div class="form-group row">
    <label for="dataVendaOrdemdeServico" class="col-sm-2 col-form-label">Data Início</label>
    <div class="col-sm-6">
        {!! Form::text('dataVendaOrdemdeServico', $dataInicio , ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-4 form-control', 'maxlength' => '100', 'readonly']) !!}
    </div>
</div> --}}
@extends('ordemdeservicos.estilo')

<div class="form-group row">

    <label for="idClienteOrdemdeServico" class="col-sm-2 col-form-label">Cliente</label>
    <div class="col-sm-6">
        {{-- {!! Form::text('idClienteOrdemdeServico', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}  --}}
        <select name="idClienteOrdemdeServico" id="idClienteOrdemdeServico" class="selecionaComInput form-control  js-example-basic-multiple">
            @foreach ($cliente as $clientes)
            <option value="{{ $clientes->id }}">{{ $clientes->razaosocialCliente }}</option>
            @endforeach
        </select>
    </div>

    <label for="valorOrdemdeServico" class="col-sm-2 col-form-label">Valor do Projeto</label>
    <div class="col-sm-2">
        {!! Form::text('valorOrdemdeServico',$valorInput,['class' => 'padraoReal form-control','step'=>'any', 'id'=>'padraoReal']) !!}
        {{-- {!! Form::text('valorOrdemdeServico',$valorInput,['class' => 'padraoReal form-control','step'=>'any', 'id'=>'padraoReal']) !!} --}}
    </div>
</div>


<div class="form-group row">
    <label for="eventoOrdemdeServico" class="col-sm-2 col-form-label">Evento</label>
    <div class="col-sm-10">
        {!! Form::text('eventoOrdemdeServico', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}

    </div>
</div>

<div class="form-group row">
    <label for="obsOrdemdeServico" class="col-sm-2 col-form-label">Observação</label>
    <div class="col-sm-10">
        {!! Form::text('obsOrdemdeServico', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100', 'required']) !!}

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
    {!! Form::text('nfreceita', $valorInput, ['placeholder' => 'N° Nota', 'class' => 'col-sm-3 form-control', 'maxlength' => '100', 'required']) !!}

</div>

<table class="styled-table" id="tabelaPagamento">
    <thead>
        <tr>
            <input style="cursor: pointer;" id="btnAddColumn" class="btn btn-primary" value="Adicionar Parcela" readonly>
            <input onclick="removerCampos()" class="btn btn-danger" value="Remover Parcelas" readonly style="cursor:pointer;">

            <th>Forma Pagamento</th>
            <th>Valor Parcela</th>
            <th>Pago</th>
            <th>Data Emissão NF</th>
            <th>Data de Pagamento</th>
            <th>Conta</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="habilita_receita" class="habilita_receita">

        @if (Route::currentRouteName() === 'ordemdeservicos.create')
            @include('ordemdeservicos/trcreate')
           
        @else
        @foreach ($receitasPorOS as $dadosreceita)

            @include('ordemdeservicos/trview')
            @endforeach
    
        @endif
    </tbody>


</table>
<div class="novaDivReceita styled-table" id="novaDivReceita">
</div>

{!! Form::hidden('registroreceita', '0', ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-8 form-control', 'maxlength' => '100']) !!}

{!! Form::hidden('idosreceita', 'null', ['placeholder' => 'Id OS Receita', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'idosreceita']) !!}

<input type="hidden" id="valorProjetoOrdemdeServico" class="form-control" name="valorProjetoOrdemdeServico" value="0.00" placeholder="Preencha o preço real" /><br>

{!! Form::hidden('dataOrdemdeServico', '00-00-0000', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('dataCriacaoOrdemdeServico', '00-00-0000', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

{!! Form::hidden('clienteOrdemdeServico', 'Campo Nome da OS', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
{!! Form::hidden('servicoOrdemdeServico', 'Campo Serviço', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}


{!! Form::hidden('dataExclusaoOrdemdeServico', '00', ['placeholder' => 'Data Exclusão', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'dataExclusaoOrdemdeServico']) !!}
{!! Form::hidden('ativoOrdemdeServico', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoOrdemdeServico']) !!}
{!! Form::hidden('excluidoOrdemdeServico', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoOrdemdeServico']) !!}

<style>
    input,
    select {
        text-transform: uppercase;
    }
</style>

<script>
    $("#btnAddColumn").click(function() {
        // $("#habilita_receita").clone(true).appendTo("#novaDivReceita");


        var row = $("#tabelaPagamento tr:last");

        row.find(".selecionaComInput").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#tabelaPagamento").append(newrow);

        $("select.selecionaComInput").select2();
    });


    function removerCampos() {
        $('.novaDivReceita').empty();
    }

    $('body').on('click', '.delete', function() {
    var $tr = $(this).closest('tr');
    if ($tr.attr('class') == 'linhaTabela1') {
        $tr.nextUntil('tr[class=linhaTabela1]').andSelf().remove();
    }
    else {
        $tr.remove();
    }
});
</script>