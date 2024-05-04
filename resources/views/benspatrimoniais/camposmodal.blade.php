@include('layouts/modal/includesmodal')

@if (isset($mensagem))
    <div class="alert alert-success" role="alert">
        <p>{{ $mensagem }}</p>
    </div>
@endif


{!! Form::open(['route' => 'cadastromateriais', 'method' => 'POST']) !!}
{!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}

<div class="form-group row">
    <label for="nomeBensPatrimoniais" class="col-sm-2 col-form-label">Nome do Material </label>
    <div class="col-sm-6">
        {!! Form::text('nomeBensPatrimoniais', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
    <label for="qtdestoqueminimo" class="col-sm-1 col-form-label">Estoque Mínimo</label>
    <div class="col-sm-1">
        <input type="number" class="form-control" name="qtdestoqueminimo" id="qtdestoqueminimo">
    </div>
</div>

<div class="form-group row">
    <label for="idTipoBensPatrimoniais" class="col-sm-2 col-form-label">Tipo</label>
    <div class="col-sm-6">
        <select name="idTipoBensPatrimoniais" id="idTipoBensPatrimoniais" class="selecionaComInput form-control" style="width: 100% !important;">
            @if (!isset($benspatrimoniais->idTipoBensPatrimoniais))
            <option selected>Selecione</option>
            @endif
            @foreach ($listaTiposBensPatrimoniais as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-4">
        <button type="button" onclick="recarregaTipoMaterial()" class="btn btn-dark"><i
                class="fas fa-sync"></i></i></button>

        <input type="button" class="btn btn-primary" data-toggle="modal" data-target=".tipomaterial"
            value="Cadastrar Novo Tipo" style="cursor: pointer;">
    </div>
</div>
<div class="form-group row">
    <label for="unidademedida" class="col-sm-2 col-form-label">Unidade</label>
    <div class="col-sm-6">
        <select name="unidademedida" id="unidademedida" class="selecionaComInput form-control" style="width: 100% !important;">
            @if (!isset($benspatrimoniais->unidademedida))
            <option selected>Selecione</option>
            @endif
            @foreach ($listaUnidadeMedida as $unidade)
                <option value="{{ $unidade->id }}">{{ $unidade->sigla }} | {{ $unidade->nomeunidade }} </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="estante" class="col-sm-2 col-form-label">Setor</label>
    <div class="col-sm-6">
        {!! Form::text('estante', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="prateleira" class="col-sm-2 col-form-label">Local</label>
    <div class="col-sm-6">
        {!! Form::text('prateleira', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}
    </div>
</div>
@include('despesas/cadastratipomaterial')


{!! Form::hidden('statusbenspatrimoniais', '1', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'statusbenspatrimoniais', 'maxlength' => '100']) !!}
{!! Form::hidden('descricaoBensPatrimoniais', '0', ['placeholder' => 'Descrição', 'class' => 'form-control', 'id' => 'descricaoBensPatrimoniais', 'maxlength' => '100']) !!}


{!! Form::hidden('ativadoBensPatrimoniais', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativadoBensPatrimoniais', 'maxlength' => '1']) !!}
{!! Form::hidden('excluidoBensPatrimoniais', '0', ['placeholder' => 'Excluído', 'class' => 'form-control', 'id' => 'excluidoBensPatrimoniais', 'maxlength' => '1']) !!}

{!! Form::button('Salvar', ['class' => 'btn btn-success']) !!}
{!! Form::close() !!}


<!-- Incluir o Sweet Alert e jQuery -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    $(document).ready(function () {
        function validarFormulario() {
            // Pegar todos os campos do formulário
            var campos = $('#cadastroForm input, #cadastroForm select');

            // Verificar se todos os campos estão preenchidos
            for (var i = 0; i < campos.length; i++) {
                if ($(campos[i]).val().trim() === '') {
                    // Exibir uma mensagem de alerta usando Sweet Alert
                    swal("Oops!", "Por favor, preencha todos os campos!", "error");
                    return false; // Impedir o envio do formulário
                }
            }
            return true; // Permitir o envio do formulário se todos os campos estiverem preenchidos
        }

        // Adicionar um ouvinte de evento para o botão de envio
        $('#cadastroForm').click(function (event) {
            alert('oi');
            // Verificar a validação do formulário antes de enviar
            if (!validarFormulario()) {
                event.preventDefault(); // Impedir o envio do formulário se a validação falhar
            }
        });
    });
</script>