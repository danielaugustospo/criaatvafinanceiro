@extends('layouts.app')


@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="col-lg-12 d-flex justify-content-between">
            <h2> Dados Funcionário Daniel Augusto</h2>
            <img src="../storage/fotosFuncionarios/{{ $funcionario->fotoFuncionario }}" style="height: 200;" alt="" srcset="">

        </div>

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

        <div class="pull-right">
            <a class="btn btn-primary" href="http://localhost/criaatvafinanceiro/public/funcionarios"> Voltar</a>
            <hr>
            <br>
            <form action="http://localhost/criaatvafinanceiro/public/funcionarios/1" method="POST">
                <a class="btn btn-primary" href="http://localhost/criaatvafinanceiro/public/funcionarios/{{ $funcionario->id }}/edit">Editar</a>

                <input type="hidden" name="_token" value="4biFdpfiCrtgtFw1Fy2Qw6mMD7UyFoAul3j3r88Y"> <input type="hidden" name="_method" value="DELETE"> <button type="submit" class="btn btn-danger">Excluir</button>
            </form>

        </div>
    </div>
</div>



{!! Form::open(array('route' => 'funcionarios.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeFuncionario" class="col-sm-2 col-form-label">Nome Completo do Funcionário</label>
    <div class="col-sm-10">
        <!-- {!! Form::text('nomeFuncionario', null, ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!} -->

        <input type="text" class="form-control" nome="nomeFuncionario" value="{{ $funcionario->nomeFuncionario }}" placeholder="Nome do Funcionário" maxlength="100" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="cepFuncionario" class="col-sm-2 col-form-label">CEP</label>
    <div class="col-sm-2">
        <!-- {!! Form::text('cepFuncionario', '', ['placeholder' => 'CEP', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'cepFuncionario','onblur' =>'pesquisacep(this.value)']) !!} -->
        <input type="text" class="form-control" id="enderecoFuncionario" value="{{ $funcionario->cepFuncionario }}" placeholder="Endereço" readonly>
    </div>
    <label for="enderecoFuncionario" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-6">
        <!-- {!! Form::text('enderecoFuncionario', '', ['placeholder' => 'Endereço', 'class' => 'form-control', 'id' => 'enderecoFuncionario', 'maxlength' => '100']) !!} -->
        <input type="text" class="form-control" id="enderecoFuncionario" value="{{ $funcionario->enderecoFuncionario }}" placeholder="Endereço" readonly>
    </div>
</div>
<div class="form-group row ">
    <label for="bairroFuncionario" class="col-sm-2 col-form-label">Bairro</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('bairroFuncionario', '', ['placeholder' => 'Bairro', 'class' => 'form-control', 'id' => 'bairroFuncionario', 'maxlength' => '30', 'readonly']) !!} -->
        <input type="text" class="form-control" id="bairroFuncionario" value="{{ $funcionario->bairroFuncionario }}" placeholder="Bairro" readonly>
    </div>
    <label for="cidadeFuncionario" class="col-sm-2 col-form-label">Cidade</label>
    <div class="col-sm-3">
        <!-- {!! Form::text('cidadeFuncionario', '', ['placeholder' => 'Cidade', 'class' => 'form-control', 'id' => 'cidadeFuncionario', 'maxlength' => '30', 'readonly']) !!} -->
        <input type="text" class="form-control" id="cidadeFuncionario" value="{{ $funcionario->cidadeFuncionario }}" placeholder="Cidade" readonly>
    </div>
    <label for="ufFuncionario" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        <!-- {!! Form::text('ufFuncionario', '', ['placeholder' => 'Estado', 'class' => 'form-control', 'id' => 'ufFuncionario', 'maxlength' => '3', 'readonly']) !!} -->
        <input type="text" class="form-control" id="ufFuncionario" value="{{ $funcionario->ufFuncionario }}" placeholder="UF" readonly>
    </div>
</div>
<hr>
<h2>Contato</h2>
<div class="form-group row ">
    <label for="celularFuncionario" class="col-sm-2 col-form-label">Celular</label>
    <div class="col-sm-2">
        <!-- {!! Form::text('celularFuncionario', '219xxxxxxxx', ['placeholder' => 'Celular', 'class' => 'form-control', 'maxlength' => '11']) !!} -->
        <input type="text" class="form-control" id="celularFuncionario" value="{{ $funcionario->celularFuncionario }}" placeholder="Celular" readonly>
    </div>
    <label for="telresidenciaFuncionario" class="col-sm-2 col-form-label">Telefone Residência</label>
    <div class="col-sm-2">
        <!-- {!! Form::text('telresidenciaFuncionario', '21xxxxxxxx', ['placeholder' => 'Tel Residência', 'class' => 'form-control', 'maxlength' => '10']) !!} -->
        <input type="text" class="form-control" id="telresidenciaFuncionario" value="{{ $funcionario->telresidenciaFuncionario }}" placeholder="Telefone Residência" readonly>
    </div>
    <label for="contatoemergenciaFuncionario" class="col-sm-2 col-form-label">Contato Emergência</label>
    <div class="col-sm-2">
        <!-- {!! Form::text('contatoemergenciaFuncionario', '21xxxxxxxx', ['placeholder' => 'Contato Emergência', 'class' => 'form-control', 'maxlength' => '10']) !!} -->
        <input type="text" class="form-control" id="contatoemergenciaFuncionario" value="{{ $funcionario->contatoemergenciaFuncionario }}" placeholder="Telefone Residência" readonly>
    </div>

</div>
<div class="form-group row ">
    <label for="emailFuncionario" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
        <!-- {!! Form::email('emailFuncionario', null, ['placeholder' => 'E-mail', 'class' => 'form-control']) !!} -->
        <input type="email" class="form-control" id="emailFuncionario" value="{{ $funcionario->emailFuncionario }}" placeholder="Email" readonly>
    </div>
    <label for="redesocialFuncionario" class="col-sm-2 col-form-label">Rede Social</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('redesocialFuncionario', '', ['placeholder' => 'Rede Social', 'class' => 'form-control', 'maxlength' => '20']) !!} -->
        <input type="text" class="form-control" id="redesocialFuncionario" value="{{ $funcionario->redesocialFuncionario }}" placeholder="Rede Social" readonly>
    </div>

</div>
<div class="form-group row ">
    <label for="facebookFuncionario" class="col-sm-2 col-form-label">Facebook</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('facebookFuncionario', null, ['placeholder' => 'Facebook', 'class' => 'form-control']) !!} -->
        <input type="email" class="form-control" id="facebookFuncionario" value="{{ $funcionario->facebookFuncionario }}" placeholder="Email" readonly>
    </div>
    <label for="telegramFuncionario" class="col-sm-2 col-form-label">Telegram</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('telegramFuncionario', '', ['placeholder' => 'Telegram', 'class' => 'form-control', 'maxlength' => '20']) !!} -->
        <input type="text" class="form-control" id="telegramFuncionario" value="{{ $funcionario->telegramFuncionario }}" placeholder="Rede Social" readonly>
    </div>

</div>
<hr>
<h2>Documentação do Funcionário</h2>
<div class="form-group row ">
    <label for="cpfFuncionario" class="col-sm-2 col-form-label">CPF</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('cpfFuncionario', '', ['placeholder' => 'CPF (somente números)', 'class' => 'form-control', 'maxlength' => '11' , 'required']) !!} -->
        <input type="text" class="form-control" id="cpfFuncionario" value="{{ $funcionario->cpfFuncionario }}" placeholder="CPF" readonly>
    </div>
</div>
<div class="form-group row ">
    <label for="rgFuncionario" class="col-sm-2 col-form-label">RG</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('rgFuncionario', '', ['placeholder' => 'RG (somente números)', 'class' => 'form-control', 'maxlength' => '11']) !!} -->
        <input type="text" class="form-control" id="rgFuncionario" value="{{ $funcionario->rgFuncionario }}" placeholder="RG" readonly>
    </div>
    <label for="orgaoRGFuncionario" class="col-sm-2 col-form-label">Órgão Emissor</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('orgaoRGFuncionario', '', ['placeholder' => 'Orgão RG', 'class' => 'form-control', 'maxlength' => '11', 'list' => 'emissoresrg']) !!} -->
        <!-- <input type="text" class="form-control" id="orgaoRGFuncionario" placeholder="Orgão RG"> -->
        <select class="selecionaComInput form-control" name="orgaoRGFuncionario" disabled>
            @foreach ($todosorgaosrg as $listarg)
            <option value="{{$listarg->id}}">{{$listarg->nome}}</option>
            @endforeach
        </select>
    </div>
    <label for="expedicaoRGFuncionario" class="col-sm-2 col-form-label">Data de Emissão</label>
    <div class="col-sm-4">
        <!-- {!! Form::date('expedicaoRGFuncionario', null, ['class' => 'form-control']) !!} -->

        <!-- {!! Form::date('expedicaoRGFuncionario', \Carbon\Carbon::now() , ['class' => 'form-control']) !!} -->
        <!-- {!! Form::text('expedicaoRGFuncionario', '', ['placeholder' => 'Data Expedição RG', 'class' => 'form-control', 'maxlength' => '11']) !!} -->
        <input type="text" class="form-control" id="expedicaoRGFuncionario" value="{{ $funcionario->expedicaoRGFuncionario }}" placeholder="Data Expedição RG" readonly>
    </div>
</div>
<div class="form-group row ">
    <label for="tituloFuncionario" class="col-sm-2 col-form-label">Título de Eleitor</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('tituloFuncionario', '', ['placeholder' => 'Título de Eleitor', 'class' => 'form-control', 'maxlength' => '12']) !!} -->
        <input type="text" class="form-control" id="tituloFuncionario" value="{{ $funcionario->tituloFuncionario }}" placeholder="Título de Eleitor" readonly>
    </div>
</div>
<hr>
<h2>Filiação</h2>
<div class="form-group row ">
    <label for="maeFuncionario" class="col-sm-2 col-form-label">Mãe</label>
    <div class="col-sm-8">
        <!-- {!! Form::text('maeFuncionario', '', ['placeholder' => 'Mãe', 'class' => 'form-control', 'maxlength' => '50']) !!} -->
        <input type="text" class="form-control" id="maeFuncionario" value="{{ $funcionario->maeFuncionario }}" placeholder="Mãe" readonly>
    </div>
</div>
<div class="form-group row ">
    <label for="paiFuncionario" class="col-sm-2 col-form-label">Pai</label>
    <div class="col-sm-8">
        <!-- {!! Form::text('paiFuncionario', '', ['placeholder' => 'Pai', 'class' => 'form-control', 'maxlength' => '50']) !!} -->
        <input type="text" class="form-control" id="paiFuncionario" value="{{ $funcionario->paiFuncionario }}" placeholder="Pai" readonly>
    </div>
</div>
<hr>
<h2>Dados Profissionais</h2>
<div class="form-group row ">
    <label for="profissaoFuncionario" class="col-sm-2 col-form-label">Profissão</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('profissaoFuncionario', '', ['placeholder' => 'Profissão', 'class' => 'form-control', 'maxlength' => '30']) !!} -->
        <input type="text" class="form-control" id="profissaoFuncionario" value="{{ $funcionario->profissaoFuncionario }}" placeholder="Profissão" readonly>
    </div>
    <label for="cargoEmpresaFuncionario" class="col-sm-2 col-form-label">Cargo na Empresa</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('cargoEmpresaFuncionario', '', ['placeholder' => 'Cargo na Empresa', 'class' => 'form-control', 'maxlength' => '30']) !!} -->
        <input type="text" class="form-control" id="cargoEmpresaFuncionario" value="{{ $funcionario->cargoEmpresaFuncionario }}" placeholder="Cargo Na Empresa" readonly>
    </div>
</div>
<div class="form-group row ">
    <label for="tipocontratoFuncionario" class="col-sm-2 col-form-label">Tipo de Contrato</label>
    <div class="col-sm-4">

        @if ( $funcionario->tipocontratoFuncionario = "1")
        <label class="form-control" name="tipocontratoFuncionario" id="tipocontratoFuncionario" readonly disabled>Estagiário</label>
        @elseif ( $funcionario->tipocontratoFuncionario = "2")
        <label class="form-control" name="tipocontratoFuncionario" id="tipocontratoFuncionario" readonly disabled>Temporário</label>
        @elseif ( $funcionario->tipocontratoFuncionario = "3")
        <label class="form-control" name="tipocontratoFuncionario" id="tipocontratoFuncionario" readonly disabled>Contrato Efetivo</label>
        @elseif ( $funcionario->tipocontratoFuncionario = "4")
        <label class="form-control" name="tipocontratoFuncionario" id="tipocontratoFuncionario" readonly disabled>Prestador de Serviço</label>
        @endif


        <!-- <input type="text" class="form-control" id="profissaoFuncionario" placeholder="Profissão"> -->
    </div>
</div>


<div class="form-group row ">
    <label for="grauescolaridadeFuncionario" class="col-sm-2 col-form-label">Grau de Escolaridade</label>

    <div class="col-sm-4">
        @if ( $funcionario->grauescolaridadeFuncionario = 0)
        Ensino Fundamental
        @elseif ( $funcionario->grauescolaridadeFuncionario = 1)
        <label class="form-control" name="contacorrentefavorecidoFuncionario" id="contacorrentefavorecidoFuncionario" readonly disabled>Ensino Médio</label>
        @elseif ( $funcionario->grauescolaridadeFuncionario = 2)
        <label class="form-control" name="contacorrentefavorecidoFuncionario" id="contacorrentefavorecidoFuncionario" readonly disabled>Ensino Superior Cursando</label>
        @elseif ( $funcionario->grauescolaridadeFuncionario = 3)
        <label class="form-control" name="contacorrentefavorecidoFuncionario" id="contacorrentefavorecidoFuncionario" readonly disabled>Ensino Superior Completo</label>
        @endif
    </div>


    <label for="descformacaoFuncionario" class="col-sm-2 col-form-label">Curso Superior</label>
    <!-- {!! Form::text('descformacaoFuncionario', '', ['placeholder' => 'Curso', 'class' => 'form-control', 'maxlength' => '30', 'id' => 'descformacaoFuncionario']) !!} -->
    <div class="col-sm-4">
        <input type="text" class="form-control" id="descformacaoFuncionario" value="{{ $funcionario->descformacaoFuncionario }}" placeholder="Profissão" readonly>
    </div>
</div>
<div class="form-group row ">

    <label for="certficFuncionario" class="col-sm-2 col-form-label">Possui Certificação Profissional?</label>
    <div class="col-sm-4">

        @if ( $funcionario->certficFuncionario = 0)
        <label class="form-control" name="contacorrentefavorecidoFuncionario" id="contacorrentefavorecidoFuncionario" readonly disabled>Não</label>
        @elseif ( $funcionario->certficFuncionario = 1)
        <label class="form-control" name="contacorrentefavorecidoFuncionario" id="contacorrentefavorecidoFuncionario" readonly disabled>Sim</label>
        @endif
    </div>

    <br>


    <div id="divcertprof" class="form-group row col-sm-12 mt-2">
        <label for="uncertificadoraFuncionario" class="col-sm-2 col-form-label pl-0">Unidade Certificadora</label>
        <input class="form-control col-sm-4 " type="text" name="uncertificadoraFuncionario" id="uncertificadoraFuncionario" maxlength="60">

        <label for="anocertificacaoFuncionario" class="col-sm-2 col-form-label">Ano Certificação</label>
        <input class="form-control col-sm-2" type="text" name="anocertificacaoFuncionario" id="anocertificacaoFuncionario" maxlength="4">
    </div>

</div>
<hr>
<h2>Dados Bancários Funcionário</h2>

<div class="form-group row">

    <label for="contacorrenteFuncionario" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-4">
        @if( $funcionario->contacorrenteFuncionario = "cp" )
        <label class="form-control" name="contacorrenteFuncionario" id="contacorrenteFuncionario" readonly disabled>Conta Poupança</label>
        @elseif( $funcionario->contacorrenteFuncionario = "cc" )
        <label class="form-control" name="contacorrenteFuncionario" id="contacorrenteFuncionario" readonly disabled>Conta Corrente</label>
        @elseif(( $funcionario->contacorrenteFuncionario != "cc" ) && ( $funcionario->contacorrenteFuncionario != "cp" ))
        <label class="form-control" name="contacorrenteFuncionario" id="contacorrenteFuncionario" readonly disabled>Informação de Conta Não Localizada</label>
        @endif
    </div>
    <label for="valor2" class="col-sm-2 col-form-label">Banco</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('bancoFuncionario', '', ['placeholder' => 'Banco', 'class' => 'form-control', 'maxlength' => '11', 'list' => 'bancos' ]) !!} -->
        <select class="selecionaComInput form-control" name="bancoFuncionario" disabled>
            @foreach ($todososbancos as $bancos)
            <option value="{{$bancos->codigoBanco}}">Código: {{$bancos->codigoBanco}} - Banco: {{$bancos->nomeBanco}}</option>
            @endforeach
        </select>
    </div>

</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-4">
        <label class="form-control" name="nrcontaFuncionario" id="nrcontaFuncionario" readonly disabled>{{ $funcionario->nrcontaFuncionario }}</label>
        <!-- {!! Form::text('nrcontaFuncionario', '', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11']) !!} -->
    </div>
    <label for="valor2" class="col-sm-2 col-form-label">Agência</label>
    <div class="col-sm-4">
        <label class="form-control" name="agenciaFuncionario" id="agenciaFuncionario" readonly disabled>{{ $funcionario->agenciaFuncionario }}</label>
        <!-- {!! Form::text('agenciaFuncionario', '', ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11']) !!} -->
    </div>

</div>

<hr />

<br>
<br>
<div id="ajax-content_show">
    <div id="div_dados_favorecido_show">
        <h2>Cadastro de Favorecido</h2>
        <div class="form-group row">

            <label for="valor1" class="col-sm-2 col-form-label">Nome Completo do Favorecido</label>
            <div class="col-sm-4">
                <label class="form-control" name="nomefavorecidoFuncionario" id="nomefavorecidoFuncionario" readonly disabled>{{ $funcionario->descformacaoFuncionario }}</label>
                <!-- {!! Form::text('nomefavorecidoFuncionario', '', ['placeholder' => 'Nome Completo do Favorecido', 'class' => 'form-control', 'id' => 'nomefavorecido', 'maxlength' => '11']) !!} -->
            </div>
            <label for="valor2" class="col-sm-2 col-form-label">CPF do Favorecido</label>
            <div class="col-sm-4">
                <label class="form-control" name="cpffavorecidoFuncionario" id="cpffavorecidoFuncionario" readonly disabled>{{ $funcionario->cpffavorecidoFuncionario }}</label>
                <!-- {!! Form::text('cpffavorecidoFuncionario', '', ['placeholder' => 'CPF do Favorecido', 'class' => 'form-control', 'id' => 'cpffavorecidoFuncionario', 'maxlength' => '11']) !!} -->
            </div>

        </div>
        <div class="form-group row">

            <label for="contacorrentefavorecidoFuncionario" class="col-sm-2 col-form-label">Tipo de Conta</label>
            <div class="col-sm-4">
                @if( $funcionario->contacorrentefavorecidoFuncionario = "cp" )
                <label class="form-control" name="contacorrentefavorecidoFuncionario" id="contacorrentefavorecidoFuncionario" readonly disabled>Conta Poupança</label>
                @elseif( $funcionario->contacorrentefavorecidoFuncionario = "cc" )
                <label class="form-control" name="contacorrentefavorecidoFuncionario" id="contacorrentefavorecidoFuncionario" readonly disabled>Conta Corrente</label>
                @elseif(( $funcionario->contacorrentefavorecidoFuncionario != "cc" ) && ( $funcionario->contacorrentefavorecidoFuncionario != "cp" ))
                <label class="form-control" name="contacorrentefavorecidoFuncionario" id="contacorrentefavorecidoFuncionario" readonly disabled>Informação de Conta Não Localizada</label>
                @endif

            </div>
            <label for="bancofavorecidoFuncionario" class="col-sm-2 col-form-label">Banco</label>
            <div class="col-sm-4">
                <label class="form-control" name="bancofavorecidoFuncionario" id="bancofavorecidoFuncionario" readonly disabled>{{ $funcionario->bancofavorecidoFuncionario }}</label>
                <!-- {!! Form::text('bancofavorecidoFuncionario', '', ['placeholder' => 'Banco', 'class' => 'form-control', 'id' => 'bancofavorecidoFuncionario', 'maxlength' => '11', 'list' => 'bancos']) !!} -->
            </div>

        </div>
        <div class="form-group row">

            <label for="nrcontafavorecidoFuncionario" class="col-sm-2 col-form-label">Número Conta</label>
            <div class="col-sm-4">
                <label class="form-control" name="nrcontafavorecidoFuncionario" id="nrcontafavorecidoFuncionario" readonly disabled>{{ $funcionario->nrcontafavorecidoFuncionario }}</label>
                <!-- {!! Form::text('nrcontafavorecidoFuncionario', '', ['placeholder' => 'Número Conta Favorecido', 'class' => 'form-control', 'id' => 'nrcontafavorecidoFuncionario', 'maxlength' => '11']) !!} -->
            </div>
            <label for="agenciafavorecidoFuncionario" class="col-sm-2 col-form-label">Agência</label>
            <div class="col-sm-4">
                <label class="form-control" name="agenciafavorecidoFuncionario" id="agenciafavorecidoFuncionario" readonly disabled>{{ $funcionario->agenciafavorecidoFuncionario }}</label>
                <!-- {!! Form::text('agenciafavorecidoFuncionario', '', ['placeholder' => 'Agência', 'class' => 'form-control', 'id' => 'agenciafavorecidoFuncionario', 'maxlength' => '11']) !!} -->
            </div>
        </div>
    </div>
</div>

{!! Form::hidden('ativoFuncionario', '1', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'ativoFuncionario', 'maxlength' => '11']) !!}
{!! Form::hidden('excluidoFuncionario', '0', ['placeholder' => 'Ativo', 'class' => 'form-control', 'id' => 'excluidoFuncionario', 'maxlength' => '11']) !!}

<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('funcionarios.index') }}"> Voltar</a>
</div>

<!-- {!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!} -->
{!! Form::close() !!}




@endsection