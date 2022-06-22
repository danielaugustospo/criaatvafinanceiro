<style>
@import 'https://fonts.googleapis.com/css?family=Open+Sans:600,700';

* {font-family: 'Open Sans', sans-serif;}

.rwd-table {
  margin: auto;
  min-width: 300px;
  max-width: 100%;
  border-collapse: collapse;
}

.rwd-table tr:first-child {
  border-top: none;
  /* background: #428bca; */
  color: #fff;
}

.rwd-table tr {
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  background-color: #f5f9fc;
}

.rwd-table tr:nth-child(odd):not(:first-child) {
  background-color: #ebf3f9;
}

.rwd-table th {
  display: none;
}

.rwd-table td {
  display: block;
}

.rwd-table td:first-child {
  margin-top: .5em;
}

.rwd-table td:last-child {
  margin-bottom: .5em;
}

.rwd-table td:before {
  content: attr(data-th) ": ";
  font-weight: bold;
  width: 120px;
  display: inline-block;
  color: #000;
}

.rwd-table th,
.rwd-table td {
  text-align: left;
}

.rwd-table {
  color: #333;
  border-radius: .4em;
  overflow: hidden;
}

.rwd-table tr {
  border-color: #bfbfbf;
}

.rwd-table th,
.rwd-table td {
  padding: .5em 1em;
}
@media screen and (max-width: 601px) {
  .rwd-table tr:nth-child(2) {
    border-top: none;
  }
}
@media screen and (min-width: 600px) {
  .rwd-table tr:hover:not(:first-child) {
    background-color: #d8e7f3;
  }
  .rwd-table td:before {
    display: none;
  }
  .rwd-table th,
  .rwd-table td {
    display: table-cell;
    padding: .25em .5em;
  }
  .rwd-table th:first-child,
  .rwd-table td:first-child {
    padding-left: 0;
  }
  .rwd-table th:last-child,
  .rwd-table td:last-child {
    padding-right: 0;
  }
  .rwd-table th,
  .rwd-table td {
    padding: 1em !important;
  }
}


/* THE END OF THE IMPORTANT STUFF */

/* Basic Styling */
body {
background: #4B79A1;
background: -webkit-linear-gradient(to left, #4B79A1 , #283E51);
background: linear-gradient(to left, #4B79A1 , #283E51);        
}
h1 {
  text-align: center;
  font-size: 2.4em;
  color: #f2f2f2;
}
.container {
  display: block;
  text-align: center;
}
h3 {
  display: inline-block;
  position: relative;
  text-align: center;
  font-size: 1.5em;
  color: #cecece;
}
h3:before {
  content: "\25C0";
  position: absolute;
  left: -50px;
  -webkit-animation: leftRight 2s linear infinite;
  animation: leftRight 2s linear infinite;
}
h3:after {
  content: "\25b6";
  position: absolute;
  right: -50px;
  -webkit-animation: leftRight 2s linear infinite reverse;
  animation: leftRight 2s linear infinite reverse;
}
@-webkit-keyframes leftRight {
  0%    { -webkit-transform: translateX(0)}
  25%   { -webkit-transform: translateX(-10px)}
  75%   { -webkit-transform: translateX(10px)}
  100%  { -webkit-transform: translateX(0)}
}
@keyframes leftRight {
  0%    { transform: translateX(0)}
  25%   { transform: translateX(-10px)}
  75%   { transform: translateX(10px)}
  100%  { transform: translateX(0)}
}


.delete{
  color:red;
  background-color: white;
  border-radius: 7%;
  padding: 3%;
}

</style>
<div class="form-group row">
    <label for="dataVendaOrdemdeServico" class="col-sm-2 col-form-label">Data Início</label>
    <div class="col-sm-6">
        {!! Form::date('dataCriacaoOrdemdeServico', $dataInicio , ['placeholder' => 'Preencha este campo', 'class' => 'col-sm-4 form-control', 'maxlength' => '100']) !!}
    </div>
</div>
@extends('ordemdeservicos.estilo')

<div class="form-group row">

    <label for="idClienteOrdemdeServico" class="col-sm-2 col-form-label">Cliente</label>
    <div class="col-sm-6">
        <select name="idClienteOrdemdeServico" id="idClienteOrdemdeServico" class="selecionaComInput form-control">
            <option value="" selected disabled >Selecione...</option>
            @foreach ($cliente as $clientes)
            <option value="{{ $clientes->id }}" 
              @if(isset($ordemdeservico))
                @if($ordemdeservico->idClienteOrdemdeServico == $clientes->id) selected @endif
              @endif>{{ $clientes->razaosocialCliente }}</option>
            @endforeach
        </select>
    </div>


    <label for="valorOrdemdeServico" class="col-sm-2 col-form-label">Valor do Projeto</label>
    <div class="col-sm-2">
        {!! Form::text('valorOrdemdeServico',$valorInput,['class' => 'campo-moeda form-control','step'=>'any', 'id'=>'campo-moeda']) !!}
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
        {!! Form::text('obsOrdemdeServico', $valorInput, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100' ]) !!}

    </div>
</div>

<div class="form-group row">
    <label for="obsOrdemdeServico" class="col-sm-2 col-form-label mr-3">Serviço c/ Fator R</label>
    {{Form::radio('comFatorR', 0, null, ['class'=>'mt-3']) }} 
    <label for="obsOrdemdeServico" class="col-sm-1  mt-1 pl-0 col-form-label">Não</label>

    {{Form::radio('comFatorR', 1,  null, ['class'=>'mt-3']) }}
    <label for="obsOrdemdeServico" class="col-sm-1 mt-1 pl-0 col-form-label">Sim</label>
</div>


{!! Form::hidden('ehcompra', '0', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}


{!! Form::hidden('idOS', 'null', ['placeholder' => 'Id OS ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'idOS']) !!}
{!! Form::hidden('excluidoDespesa', '0', ['placeholder' => 'Excluído ', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoDespesa']) !!}

<div class="pull-left">
    <h4>Forma de Pagamento</h4>
</div>

<hr>


<table class="styled-table rwd-table"  id="tabelaPagamento">
    <thead>
        <tr class="col-sm-10">

            <th class="col-sm-2" style="width:20%;">Forma Pagamento</th>
            <th class="col-sm-1" style="width:-webkit-fill-available;"><nobr>Valor Parcela</nobr></th>
            <th class="col-sm-1" style="width:-webkit-fill-available;">Pago</th>
            <th class="col-sm-2" style="width:-webkit-fill-available;">Data Emissão NF</th>
            <th class="col-sm-2" style="width:-webkit-fill-available;">Data de Pagamento</th>
            <th class="col-sm-1" style="width:-webkit-fill-available;">Conta</th>
            <th class="col-sm-1" style="width:-webkit-fill-available;"><nobr>Nota Fiscal<nobr></th>
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

{!! Form::hidden('servicoOrdemdeServico', 'Campo Serviço', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}


{!! Form::hidden('dataExclusaoOrdemdeServico', '00', ['placeholder' => 'Data Exclusão', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'dataExclusaoOrdemdeServico']) !!}
{!! Form::hidden('ativoOrdemdeServico', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'ativoOrdemdeServico']) !!}
{!! Form::hidden('excluidoOrdemdeServico', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'maxlength' => '1', 'id' => 'excluidoOrdemdeServico']) !!}

<style>
    input,
    select,
    textarea {
        text-transform: uppercase;
    }
</style>

<script>
    function pegaIdFornecedor() {
        var selecionado = $('#pagoreceita').find(':selected').val();
    }

    $("#btnAddColumn").click(function() {
        var row = $("#tabelaPagamento tr:last");

        row.find(".selecionaComInput").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#tabelaPagamento").append(newrow);

        $("select.selecionaComInput").select2();

        var tr = $(this).closest('tr');
        console.log(tr.attr(newrow));        
    });

    function idSemValor(){
      $('input.idReceita').val('000000');
    }

  $('body').on('click', '.duplicar', function() {
    var row = $(this).closest('tr');
    row.find(".selecionaComInput").each(function(index) {
            
          $(this).select2('destroy');
        
    });
    row.find(".campo-moeda").each(function(index) {
        $(this).maskMoney('destroy');
    });
    var newrow = row.clone();
    $("#tabelaPagamento").append(newrow);
    $("select.selecionaComInput").select2();
    $('input.campo-moeda')
        .maskMoney({
            prefix: 'R$ ',
            allowNegative: false,
            thousands: '.',
            decimal: ',',
            affixesStay: false
        });
        newrow.find(".idReceita").each(function(index) {
        $(this).val('novo');
    });
    $('input[type=text].idReceita').val('novo');
  });

  function removerCampos() {
      $('.novaDivReceita').empty();
  }

  $('body').on('click', '.deletar', function() {
      var $tr = $(this).closest('tr');
      if ($tr.attr('class') == 'linhaTabela1') {
          $tr.nextUntil('tr[class=linhaTabela1]').andSelf().remove();
      } else {
          $tr.remove();
      }
  });
</script>