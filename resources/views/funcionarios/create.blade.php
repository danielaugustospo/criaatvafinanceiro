
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastro de Funcionário</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('funcionarios.index') }}"> Voltar</a>
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




{!! Form::open(array('route' => 'funcionarios.store','method'=>'POST')) !!}

<div class="form-group row">
    <label for="nomeFuncionario" class="col-sm-2 col-form-label">Nome Completo do Funcionário</label>
    <div class="col-sm-10">
        {!! Form::text('nomeFuncionario', '', ['placeholder' => 'Preencha este campo', 'class' => 'form-control', 'maxlength' => '100']) !!}

        <!-- <input type="text" class="form-control" nome="nomeFuncionario" id="nomeFuncionario" placeholder="Nome do Funcionário"> -->
    </div>
</div>
<div class="form-group row">
    <label for="cepFuncionario" class="col-sm-2 col-form-label">CEP</label>
    <div class="col-sm-2">
        {!! Form::text('cepFuncionario', '', ['placeholder' => 'CEP', 'class' => 'form-control', 'maxlength' => '8', 'id' => 'cepFuncionario','onblur' =>'pesquisacep(this.value)']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
    <label for="enderecoFuncionario" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-6">
        {!! Form::text('enderecoFuncionario', '', ['placeholder' => 'Endereço', 'class' => 'form-control', 'id' => 'enderecoFuncionario', 'maxlength' => '100']) !!}
        <!-- <input type="text" class="form-control" id="enderecoFuncionario" placeholder="Endereço"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="bairroFuncionario" class="col-sm-2 col-form-label">Bairro</label>
    <div class="col-sm-3">
        {!! Form::text('bairroFuncionario', '', ['placeholder' => 'Bairro', 'class' => 'form-control', 'id' => 'bairroFuncionario', 'maxlength' => '30']) !!}
        <!-- <input type="text" class="form-control" id="bairroFuncionario" placeholder="Bairro"> -->
    </div>
    <label for="cidadeFuncionario" class="col-sm-2 col-form-label">Cidade</label>
    <div class="col-sm-3">
        {!! Form::text('cidadeFuncionario', '', ['placeholder' => 'Cidade', 'class' => 'form-control', 'id' => 'cidadeFuncionario', 'maxlength' => '30']) !!}
        <!-- <input type="text" class="form-control" id="cidadeFuncionario" placeholder="Cidade"> -->
    </div>
    <label for="ufFuncionario" class="col-sm-1 col-form-label">Estado</label>
    <div class="col-sm-1">
        {!! Form::text('ufFuncionario', '', ['placeholder' => 'Estado', 'class' => 'form-control', 'id' => 'ufFuncionario', 'maxlength' => '3']) !!}
        <!-- <input type="text" class="form-control" id="ufFuncionario" placeholder="UF"> -->
    </div>
</div>
<hr>
<h2>Contato</h2>
<div class="form-group row ">
    <label for="celularFuncionario" class="col-sm-2 col-form-label">Celular</label>
    <div class="col-sm-2">
        {!! Form::text('celularFuncionario', '219xxxxxxxx', ['placeholder' => 'Celular', 'class' => 'form-control', 'maxlength' => '11']) !!}
        <!-- <input type="text" class="form-control" id="celularFuncionario" placeholder="Celular"> -->
    </div>
    <label for="telresidenciaFuncionario" class="col-sm-2 col-form-label">Telefone Residência</label>
    <div class="col-sm-2">
        {!! Form::text('telresidenciaFuncionario', '21xxxxxxxx', ['placeholder' => 'Tel Residência', 'class' => 'form-control', 'maxlength' => '10']) !!}
        <!-- <input type="text" class="form-control" id="telresidenciaFuncionario" placeholder="Telefone Residência"> -->
    </div>
    <label for="contatoemergenciaFuncionario" class="col-sm-2 col-form-label">Contato Emergência</label>
    <div class="col-sm-2">
        {!! Form::text('contatoemergenciaFuncionario', '21xxxxxxxx', ['placeholder' => 'Contato Emergência', 'class' => 'form-control', 'maxlength' => '10']) !!}
        <!-- <input type="text" class="form-control" id="telresidenciaFuncionario" placeholder="Telefone Residência"> -->
    </div>

</div>
<div class="form-group row ">
    <label for="emailFuncionario" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
        {!! Form::email('emailFuncionario', null, ['placeholder' => 'E-mail', 'class' => 'form-control']) !!}
        <!-- <input type="email" class="form-control" id="emailFuncionario" placeholder="Email"> -->
    </div>
    <label for="redesocialFuncionario" class="col-sm-2 col-form-label">Rede Social</label>
    <div class="col-sm-4">
        {!! Form::text('redesocialFuncionario', '', ['placeholder' => 'Rede Social', 'class' => 'form-control', 'maxlength' => '20']) !!}
        <!-- <input type="text" class="form-control" id="redesocialFuncionario" placeholder="Rede Social"> -->
    </div>

</div>
<div class="form-group row ">
    <label for="facebookFuncionario" class="col-sm-2 col-form-label">Facebook</label>
    <div class="col-sm-4">
        {!! Form::text('facebookFuncionario', null, ['placeholder' => 'Facebook', 'class' => 'form-control']) !!}
        <!-- <input type="email" class="form-control" id="emailFuncionario" placeholder="Email"> -->
    </div>
    <label for="redesocialFuncionario" class="col-sm-2 col-form-label">Telegram</label>
    <div class="col-sm-4">
        {!! Form::text('telegramFuncionario', '', ['placeholder' => 'Telegram', 'class' => 'form-control', 'maxlength' => '20']) !!}
        <!-- <input type="text" class="form-control" id="redesocialFuncionario" placeholder="Rede Social"> -->
    </div>

</div>
<hr>
<h2>Documentação do Funcionário</h2>
<div class="form-group row ">
    <label for="cpfFuncionario" class="col-sm-2 col-form-label">CPF</label>
    <div class="col-sm-4">
        {!! Form::text('cpfFuncionario', '', ['placeholder' => 'CPF (somente números)', 'class' => 'form-control', 'maxlength' => '11' , 'required']) !!}
        <!-- <input type="text" class="form-control" id="cpfFuncionario" placeholder="CPF"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="rgFuncionario" class="col-sm-2 col-form-label">RG</label>
    <div class="col-sm-4">
        {!! Form::text('rgFuncionario', '', ['placeholder' => 'RG (somente números)', 'class' => 'form-control', 'maxlength' => '11']) !!}
        <!-- <input type="text" class="form-control" id="rgFuncionario" placeholder="RG"> -->
    </div>
    <label for="orgaoRGFuncionario" class="col-sm-2 col-form-label">Órgão Emissor</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('orgaoRGFuncionario', '', ['placeholder' => 'Orgão RG', 'class' => 'form-control', 'maxlength' => '11', 'list' => 'emissoresrg']) !!} -->
        <!-- <input type="text" class="form-control" id="orgaoRGFuncionario" placeholder="Orgão RG"> -->
        <select class="form-control" name="orgaoRGFuncionario">
        @foreach ($todosorgaosrg as $listarg)
            <option value="{{$listarg->id}}">{{$listarg->nome}}</option>
        @endforeach
        </select>
    </div>
    <label for="expedicaoRGFuncionario" class="col-sm-2 col-form-label">Data de Emissão</label>
    <div class="col-sm-4">
        {!! Form::date('expedicaoRGFuncionario', null, ['class' => 'form-control']) !!}
        <!-- {!! Form::date('expedicaoRGFuncionario', \Carbon\Carbon::now() , ['class' => 'form-control']) !!} -->
        <!-- {!! Form::text('expedicaoRGFuncionario', '', ['placeholder' => 'Data Expedição RG', 'class' => 'form-control', 'maxlength' => '11']) !!} -->
        <!-- <input type="text" class="form-control" id="expedicaoRGFuncionario" placeholder="Data Expedição RG"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="tituloFuncionario" class="col-sm-2 col-form-label">Título de Eleitor</label>
    <div class="col-sm-4">
        {!! Form::text('tituloFuncionario', '', ['placeholder' => 'Título de Eleitor', 'class' => 'form-control', 'maxlength' => '12']) !!}
        <!-- <input type="text" class="form-control" id="tituloFuncionario" placeholder="Título de Eleitor"> -->
    </div>
</div>
<hr>
<h2>Filiação</h2>
<div class="form-group row ">
    <label for="maeFuncionario" class="col-sm-2 col-form-label">Mãe</label>
    <div class="col-sm-8">
        {!! Form::text('maeFuncionario', '', ['placeholder' => 'Mãe', 'class' => 'form-control', 'maxlength' => '50']) !!}
        <!-- <input type="text" class="form-control" id="maeFuncionario" placeholder="Mãe"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="paiFuncionario" class="col-sm-2 col-form-label">Pai</label>
    <div class="col-sm-8">
        {!! Form::text('paiFuncionario', '', ['placeholder' => 'Pai', 'class' => 'form-control', 'maxlength' => '50']) !!}
        <!-- <input type="text" class="form-control" id="paiFuncionario" placeholder="Pai"> -->
    </div>
</div>
<hr>
<h2>Dados Profissionais</h2>
<div class="form-group row ">
    <label for="profissaoFuncionario" class="col-sm-2 col-form-label">Profissão</label>
    <div class="col-sm-4">
        {!! Form::text('profissaoFuncionario', '', ['placeholder' => 'Profissão', 'class' => 'form-control', 'maxlength' => '30']) !!}
        <!-- <input type="text" class="form-control" id="profissaoFuncionario" placeholder="Profissão"> -->
    </div>
    <label for="cargoEmpresaFuncionario" class="col-sm-2 col-form-label">Cargo na Empresa</label>
    <div class="col-sm-4">
        {!! Form::text('cargoEmpresaFuncionario', '', ['placeholder' => 'Cargo na Empresa', 'class' => 'form-control', 'maxlength' => '30']) !!}
        <!-- <input type="text" class="form-control" id="profissaoFuncionario" placeholder="Profissão"> -->
    </div>
</div>
<div class="form-group row ">
    <label for="tipocontratoFuncionario" class="col-sm-2 col-form-label">Tipo de Contrato</label>
    <div class="col-sm-4">
        {!! Form::select('tipocontratoFuncionario', [
        '1' => 'Estagiário', '2' => 'Temporário', '3' => 'Contrato Efetivo' , '4' => 'Prestador de Serviço'
        ] , null, ['class' => 'form-control']
        )!!}
        <!-- <input type="text" class="form-control" id="profissaoFuncionario" placeholder="Profissão"> -->
    </div>
</div>


<div class="form-group row ">
    <label for="grauescolaridadeFuncionario" class="col-sm-2 col-form-label">Grau de Escolaridade</label>

    <div class="col-sm-6 mt-2">
        <input type="radio" name="grauescolaridadeFuncionario" class="fundamental" value="0" style="cursor:pointer;">
        <label class="mr-2" for="">Ensino Fundamental</label>
        <br>
        <input type="radio" name="grauescolaridadeFuncionario" class="medio" value="1" style="cursor:pointer;">
        <label class="mr-2" for="">Ensino Médio</label>
        <br>
        <input type="radio" name="grauescolaridadeFuncionario" class="superior" value="2" style="cursor:pointer;">
        <label class="mr-2" for="">Ensino Superior Cursando</label>
        <br>
        <input type="radio" name="grauescolaridadeFuncionario" class="superior" value="3" style="cursor:pointer;">
        <label class="mr-2" for="">Ensino Superior Completo</label>
    </div>

    <div id="divcurso" class="form-group row col-sm-4">
        <label for="descformacaoFuncionario" class="col-sm-2 col-form-label">Curso Superior</label>
        {!! Form::text('descformacaoFuncionario', '', ['placeholder' => 'Curso', 'class' => 'form-control', 'maxlength' => '30', 'id' => 'descformacaoFuncionario']) !!}
        <!-- <input type="text" class="form-control" id="profissaoFuncionario" placeholder="Profissão"> -->
    </div>
</div>
<div class="form-group row">

    <label for="certficFuncionario" class="col-sm-2 col-form-label">Possui Certificação Profissional?</label>
    <input type="radio" name="certficFuncionario" class="semcert mr-2 mt-3" checked value="0">
    <label for="certficFuncionario" class="col-form-label pl-0">Não</label>

    <input type="radio" name="certficFuncionario" class="comcert ml-2 m-1 mt-3" value="1">
    <label for="certficFuncionario" class="col-form-label pl-0">Sim</label>

    </div>
    <div id="divcertprof" class="form-group row col-sm-12 mt-2">
        <label for="uncertificadoraFuncionario" class="col-sm-2 col-form-label pl-0">Unidade Certificadora</label>
        <input class="form-control col-sm-4 " type="text" name="uncertificadoraFuncionario"  id="uncertificadoraFuncionario" maxlength="60">

        <label for="anocertificacaoFuncionario" class="col-sm-2 col-form-label">Ano Certificação</label>
        <input class="form-control col-sm-2" type="text" name="anocertificacaoFuncionario" id="anocertificacaoFuncionario" maxlength="4">

</div>
<hr>
<h2>Dados Bancários Funcionário</h2>

<div class="form-group row">

    <label for="contacorrenteFuncionario" class="col-sm-2 col-form-label">Tipo de Conta</label>
    <div class="col-sm-4">

        {!! Form::select('contacorrenteFuncionario', [
        'cc' => 'Conta Corrente', 'cp' => 'Conta Poupança'
        ] , null, ['class' => 'form-control']
        )!!}

        <!-- {!! Form::text('contacorrentefavorecidoFuncionario', '', ['placeholder' => 'Conta Corrente', 'class' => 'form-control', 'id' => 'contacorrentefavorecidoFuncionario', 'maxlength' => '11']) !!} -->
        <!-- <input type="text" class="form-control" id="bancoFuncionario" placeholder="Banco"> -->
    </div>
    <label for="valor2" class="col-sm-2 col-form-label">Banco</label>
    <div class="col-sm-4">
        <!-- {!! Form::text('bancoFuncionario', '', ['placeholder' => 'Banco', 'class' => 'form-control', 'maxlength' => '11', 'list' => 'bancos' ]) !!} -->
        <select class="form-control" name="bancoFuncionario">
        @foreach ($todososbancos as $bancos)
            <option value="{{$bancos->codigoBanco}}">Código: {{$bancos->codigoBanco}} - Banco: {{$bancos->nomeBanco}}</option>
        @endforeach
        </select>
        <!-- <datalist id="bancos">
            <option value="001">001 - Banco do Brasil</option>
            <option value="003">003 - Banco da Amazônia</option>
            <option value="004">004 - Banco do Nordeste</option>
            <option value="021">021 - Banestes</option>
            <option value="025">025 - Banco Alfa</option>
            <option value="027">027 - Besc</option>
            <option value="029">029 - Banerj</option>
            <option value="031">031 - Banco Beg</option>
            <option value="033">033 - Banco Santander Banespa</option>
            <option value="036">036 - Banco Bem</option>
            <option value="037">037 - Banpará</option>
            <option value="038">038 - Banestado</option>
            <option value="039">039 - BEP</option>
            <option value="040">040 - Banco Cargill</option>
            <option value="041">041 - Banrisul</option>
            <option value="044">044 - BVA</option>
            <option value="045">045 - Banco Opportunity</option>
            <option value="047">047 - Banese</option>
            <option value="062">062 - Hipercard</option>
            <option value="063">063 - Ibibank</option>
            <option value="065">065 - Lemon Bank</option>
            <option value="066">066 - Banco Morgan Stanley Dean Witter</option>
            <option value="069">069 - BPN Brasil</option>
            <option value="070">070 - Banco de Brasília – BRB</option>
            <option value="072">072 - Banco Rural</option>
            <option value="073">073 - Banco Popular</option>
            <option value="074">074 - Banco J. Safra</option>
            <option value="075">075 - Banco CR2</option>
            <option value="076">076 - Banco KDB</option>
            <option value="096">096 - Banco BMF</option>
            <option value="104">104 - Caixa Econômica Federal</option>
            <option value="107">107 - Banco BBM</option>
            <option value="116">116 - Banco Único</option>
            <option value="151">151 - Nossa Caixa</option>
            <option value="175">175 - Banco Finasa</option>
            <option value="184">184 - Banco Itaú BBA</option>
            <option value="204">204 - American Express Bank</option>
            <option value="208">208 - Banco Pactual</option>
            <option value="212">212 - Banco Matone</option>
            <option value="213">213 - Banco Arbi</option>
            <option value="214">214 - Banco Dibens</option>
            <option value="217">217 - Banco Joh Deere</option>
            <option value="218">218 - Banco Bonsucesso</option>
            <option value="222">222 - Banco Calyon Brasil</option>
            <option value="224">224 - Banco Fibra</option>
            <option value="225">225 - Banco Brascan</option>
            <option value="229">229 - Banco Cruzeiro</option>
            <option value="230">230 - Unicard</option>
            <option value="233">233 - Banco GE Capital</option>
            <option value="237">237 - Bradesco</option>
            <option value="241">241 - Banco Clássico</option>
            <option value="243">243 - Banco Stock Máxima</option>
            <option value="246">246 - Banco ABC Brasil</option>
            <option value="248">248 - Banco Boavista Interatlântico</option>
            <option value="249">249 - Investcred Unibanco</option>
            <option value="250">250 - Banco Schahin</option>
            <option value="252">252 - Fininvest</option>
            <option value="254">254 - Paraná Banco</option>
            <option value="263">263 - Banco Cacique</option>
            <option value="265">265 - Banco Fator</option>
            <option value="266">266 - Banco Cédula</option>
            <option value="300">300 - Banco de la Nación Argentina</option>
            <option value="318">318 - Banco BMG</option>
            <option value="320">320 - Banco Industrial e Comercial</option>
            <option value="356">356 - ABN Amro Real</option>
            <option value="341">341 - Itau</option>
            <option value="347">347 - Sudameris</option>
            <option value="351">351 - Banco Santander</option>
            <option value="353">353 - Banco Santander Brasil</option>
            <option value="366">366 - Banco Societe Generale Brasil</option>
            <option value="370">370 - Banco WestLB</option>
            <option value="376">376 - JP Morgan</option>
            <option value="389">389 - Banco Mercantil do Brasil</option>
            <option value="394">394 - Banco Mercantil de Crédito</option>
            <option value="399">399 - HSBC</option>
            <option value="409">409 - Unibanco</option>
            <option value="412">412 - Banco Capital</option>
            <option value="422">422 - Banco Safra</option>
            <option value="453">453 - Banco Rural</option>
            <option value="456">456 - Banco Tokyo Mitsubishi UFJ</option>
            <option value="464">464 - Banco Sumitomo Mitsui Brasileiro</option>
            <option value="477">477 - Citibank</option>
            <option value="479">479 - Itaubank (antigo Bank Boston)</option>
            <option value="487">487 - Deutsche Bank</option>
            <option value="488">488 - Banco Morgan Guaranty</option>
            <option value="492">492 - Banco NMB Postbank</option>
            <option value="494">494 - Banco la República Oriental del Uruguay</option>
            <option value="495">495 - Banco La Provincia de Buenos Aires</option>
            <option value="505">505 - Banco Credit Suisse</option>
            <option value="600">600 - Banco Luso Brasileiro</option>
            <option value="604">604 - Banco Industrial</option>
            <option value="610">610 - Banco VR</option>
            <option value="611">611 - Banco Paulista</option>
            <option value="612">612 - Banco Guanabara</option>
            <option value="613">613 - Banco Pecunia</option>
            <option value="623">623 - Banco Panamericano</option>
            <option value="626">626 - Banco Ficsa</option>
            <option value="630">630 - Banco Intercap</option>
            <option value="633">633 - Banco Rendimento</option>
            <option value="634">634 - Banco Triângulo</option>
            <option value="637">637 - Banco Sofisa</option>
            <option value="638">638 - Banco Prosper</option>
            <option value="643">643 - Banco Pine</option>
            <option value="652">652 - Itaú Holding Financeira</option>
            <option value="653">653 - Banco Indusval</option>
            <option value="654">654 - Banco A.J. Renner</option>
            <option value="655">655 - Banco Votorantim</option>
            <option value="707">707 - Banco Daycoval</option>
            <option value="719">719 - Banif</option>
            <option value="721">721 - Banco Credibel</option>
            <option value="734">734 - Banco Gerdau</option>
            <option value="735">735 - Banco Pottencial</option>
            <option value="738">738 - Banco Morada</option>
            <option value="739">739 - Banco Galvão de Negócios</option>
            <option value="740">740 - Banco Barclays</option>
            <option value="741">741 - BRP</option>
            <option value="743">743 - Banco Semear</option>
            <option value="745">745 - Banco Citibank</option>
            <option value="746">746 - Banco Modal</option>
            <option value="747">747 - Banco Rabobank International</option>
            <option value="748">748 - Banco Cooperativo Sicredi</option>
            <option value="749">749 - Banco Simples</option>
            <option value="751">751 - Dresdner Bank</option>
            <option value="752">752 - BNP Paribas</option>
            <option value="753">753 - Banco Comercial Uruguai</option>
            <option value="755">755 - Banco Merrill Lynch</option>
            <option value="756">756 - Banco Cooperativo do Brasil</option>
            <option value="757">757 - KEB</option>
        </datalist> -->
        <!-- <input type="text" class="form-control" id="agenciacontaFuncionario" placeholder="Agência"> -->
    </div>
    <label for="valor2" class="col-sm-2 col-form-label">Banco</label>

</div>
<div class="form-group row">

    <label for="valor1" class="col-sm-2 col-form-label">Número Conta</label>
    <div class="col-sm-4">
        {!! Form::text('nrcontaFuncionario', '', ['placeholder' => 'Número Conta', 'class' => 'form-control', 'maxlength' => '11']) !!}
        <!-- <input type="text" class="form-control" id="bancoFuncionario" placeholder="Banco"> -->
    </div>
    <label for="valor2" class="col-sm-2 col-form-label">Agência</label>
    <div class="col-sm-4">
        {!! Form::text('agenciaFuncionario', '', ['placeholder' => 'Agência', 'class' => 'form-control', 'maxlength' => '11']) !!}
        <!-- <input type="text" class="form-control" id="agenciacontaFuncionario" placeholder="Agência"> -->
    </div>

</div>

<hr>

<br>
<br>
<input class="btn btn-primary" id="reveal" value="Cadastrar Favorecido" style="cursor:pointer;">
<input class="btn btn-danger" id="esconde" value="Remover Favorecido" style="cursor:pointer;">
<div id="ajax-content">
    <div id="div_dados_favorecido">
        <h2>Cadastro de Favorecido</h2>
        <div class="form-group row">

            <label for="valor1" class="col-sm-2 col-form-label">Nome Completo do Favorecido</label>
            <div class="col-sm-4">
                {!! Form::text('nomefavorecidoFuncionario', '', ['placeholder' => 'Nome Completo do Favorecido', 'class' => 'form-control', 'id' => 'nomefavorecido', 'maxlength' => '11']) !!}
                <!-- <input type="text" class="form-control" id="bancoFuncionario" placeholder="Banco"> -->
            </div>
            <label for="valor2" class="col-sm-2 col-form-label">CPF do Favorecido</label>
            <div class="col-sm-4">
                {!! Form::text('cpffavorecidoFuncionario', '', ['placeholder' => 'CPF do Favorecido', 'class' => 'form-control', 'id' => 'cpffavorecidoFuncionario', 'maxlength' => '11']) !!}
                <!-- <input type="text" class="form-control" id="agenciacontaFuncionario" placeholder="Agência"> -->
            </div>

        </div>
        <div class="form-group row">

            <label for="contacorrentefavorecidoFuncionario" class="col-sm-2 col-form-label">Tipo de Conta</label>
            <div class="col-sm-4">

                {!! Form::select('contacorrentefavorecidoFuncionario', [
                'cc' => 'Conta Corrente', 'cp' => 'Conta Poupança'
                ] , null, ['class' => 'form-control']
                )!!}

                <!-- {!! Form::text('contacorrentefavorecidoFuncionario', '', ['placeholder' => 'Conta Corrente', 'class' => 'form-control', 'id' => 'contacorrentefavorecidoFuncionario', 'maxlength' => '11']) !!} -->
                <!-- <input type="text" class="form-control" id="bancoFuncionario" placeholder="Banco"> -->
            </div>
            <label for="bancofavorecidoFuncionario" class="col-sm-2 col-form-label">Banco</label>
            <div class="col-sm-4">
                {!! Form::text('bancofavorecidoFuncionario', '', ['placeholder' => 'Banco', 'class' => 'form-control', 'id' => 'bancofavorecidoFuncionario', 'maxlength' => '11', 'list' => 'bancos']) !!}
                <!-- <input type="text" class="form-control" id="agenciacontaFuncionario" placeholder="Agência"> -->
            </div>

        </div>
        <div class="form-group row">

            <label for="nrcontafavorecidoFuncionario" class="col-sm-2 col-form-label">Número Conta</label>
            <div class="col-sm-4">
                {!! Form::text('nrcontafavorecidoFuncionario', '', ['placeholder' => 'Número Conta Favorecido', 'class' => 'form-control', 'id' => 'nrcontafavorecidoFuncionario', 'maxlength' => '11']) !!}
                <!-- <input type="text" class="form-control" id="bancoFuncionario" placeholder="Banco"> -->
            </div>
            <label for="agenciafavorecidoFuncionario" class="col-sm-2 col-form-label">Agência</label>
            <div class="col-sm-4">
                {!! Form::text('agenciafavorecidoFuncionario', '', ['placeholder' => 'Agência', 'class' => 'form-control', 'id' => 'agenciafavorecidoFuncionario', 'maxlength' => '11']) !!}
                <!-- <input type="text" class="form-control" id="agenciacontaFuncionario" placeholder="Agência"> -->
            </div>

        </div>
    </div>
</div>
<datalist id="bancos">
    <option value="001">001 - Banco do Brasil</option>
    <option value="003">003 - Banco da Amazônia</option>
    <option value="004">004 - Banco do Nordeste</option>
    <option value="021">021 - Banestes</option>
    <option value="025">025 - Banco Alfa</option>
    <option value="027">027 - Besc</option>
    <option value="029">029 - Banerj</option>
    <option value="031">031 - Banco Beg</option>
    <option value="033">033 - Banco Santander Banespa</option>
    <option value="036">036 - Banco Bem</option>
    <option value="037">037 - Banpará</option>
    <option value="038">038 - Banestado</option>
    <option value="039">039 - BEP</option>
    <option value="040">040 - Banco Cargill</option>
    <option value="041">041 - Banrisul</option>
    <option value="044">044 - BVA</option>
    <option value="045">045 - Banco Opportunity</option>
    <option value="047">047 - Banese</option>
    <option value="062">062 - Hipercard</option>
    <option value="063">063 - Ibibank</option>
    <option value="065">065 - Lemon Bank</option>
    <option value="066">066 - Banco Morgan Stanley Dean Witter</option>
    <option value="069">069 - BPN Brasil</option>
    <option value="070">070 - Banco de Brasília – BRB</option>
    <option value="072">072 - Banco Rural</option>
    <option value="073">073 - Banco Popular</option>
    <option value="074">074 - Banco J. Safra</option>
    <option value="075">075 - Banco CR2</option>
    <option value="076">076 - Banco KDB</option>
    <option value="096">096 - Banco BMF</option>
    <option value="104">104 - Caixa Econômica Federal</option>
    <option value="107">107 - Banco BBM</option>
    <option value="116">116 - Banco Único</option>
    <option value="151">151 - Nossa Caixa</option>
    <option value="175">175 - Banco Finasa</option>
    <option value="184">184 - Banco Itaú BBA</option>
    <option value="204">204 - American Express Bank</option>
    <option value="208">208 - Banco Pactual</option>
    <option value="212">212 - Banco Matone</option>
    <option value="213">213 - Banco Arbi</option>
    <option value="214">214 - Banco Dibens</option>
    <option value="217">217 - Banco Joh Deere</option>
    <option value="218">218 - Banco Bonsucesso</option>
    <option value="222">222 - Banco Calyon Brasil</option>
    <option value="224">224 - Banco Fibra</option>
    <option value="225">225 - Banco Brascan</option>
    <option value="229">229 - Banco Cruzeiro</option>
    <option value="230">230 - Unicard</option>
    <option value="233">233 - Banco GE Capital</option>
    <option value="237">237 - Bradesco</option>
    <option value="241">241 - Banco Clássico</option>
    <option value="243">243 - Banco Stock Máxima</option>
    <option value="246">246 - Banco ABC Brasil</option>
    <option value="248">248 - Banco Boavista Interatlântico</option>
    <option value="249">249 - Investcred Unibanco</option>
    <option value="250">250 - Banco Schahin</option>
    <option value="252">252 - Fininvest</option>
    <option value="254">254 - Paraná Banco</option>
    <option value="263">263 - Banco Cacique</option>
    <option value="265">265 - Banco Fator</option>
    <option value="266">266 - Banco Cédula</option>
    <option value="300">300 - Banco de la Nación Argentina</option>
    <option value="318">318 - Banco BMG</option>
    <option value="320">320 - Banco Industrial e Comercial</option>
    <option value="356">356 - ABN Amro Real</option>
    <option value="341">341 - Itau</option>
    <option value="347">347 - Sudameris</option>
    <option value="351">351 - Banco Santander</option>
    <option value="353">353 - Banco Santander Brasil</option>
    <option value="366">366 - Banco Societe Generale Brasil</option>
    <option value="370">370 - Banco WestLB</option>
    <option value="376">376 - JP Morgan</option>
    <option value="389">389 - Banco Mercantil do Brasil</option>
    <option value="394">394 - Banco Mercantil de Crédito</option>
    <option value="399">399 - HSBC</option>
    <option value="409">409 - Unibanco</option>
    <option value="412">412 - Banco Capital</option>
    <option value="422">422 - Banco Safra</option>
    <option value="453">453 - Banco Rural</option>
    <option value="456">456 - Banco Tokyo Mitsubishi UFJ</option>
    <option value="464">464 - Banco Sumitomo Mitsui Brasileiro</option>
    <option value="477">477 - Citibank</option>
    <option value="479">479 - Itaubank (antigo Bank Boston)</option>
    <option value="487">487 - Deutsche Bank</option>
    <option value="488">488 - Banco Morgan Guaranty</option>
    <option value="492">492 - Banco NMB Postbank</option>
    <option value="494">494 - Banco la República Oriental del Uruguay</option>
    <option value="495">495 - Banco La Provincia de Buenos Aires</option>
    <option value="505">505 - Banco Credit Suisse</option>
    <option value="600">600 - Banco Luso Brasileiro</option>
    <option value="604">604 - Banco Industrial</option>
    <option value="610">610 - Banco VR</option>
    <option value="611">611 - Banco Paulista</option>
    <option value="612">612 - Banco Guanabara</option>
    <option value="613">613 - Banco Pecunia</option>
    <option value="623">623 - Banco Panamericano</option>
    <option value="626">626 - Banco Ficsa</option>
    <option value="630">630 - Banco Intercap</option>
    <option value="633">633 - Banco Rendimento</option>
    <option value="634">634 - Banco Triângulo</option>
    <option value="637">637 - Banco Sofisa</option>
    <option value="638">638 - Banco Prosper</option>
    <option value="643">643 - Banco Pine</option>
    <option value="652">652 - Itaú Holding Financeira</option>
    <option value="653">653 - Banco Indusval</option>
    <option value="654">654 - Banco A.J. Renner</option>
    <option value="655">655 - Banco Votorantim</option>
    <option value="707">707 - Banco Daycoval</option>
    <option value="719">719 - Banif</option>
    <option value="721">721 - Banco Credibel</option>
    <option value="734">734 - Banco Gerdau</option>
    <option value="735">735 - Banco Pottencial</option>
    <option value="738">738 - Banco Morada</option>
    <option value="739">739 - Banco Galvão de Negócios</option>
    <option value="740">740 - Banco Barclays</option>
    <option value="741">741 - BRP</option>
    <option value="743">743 - Banco Semear</option>
    <option value="745">745 - Banco Citibank</option>
    <option value="746">746 - Banco Modal</option>
    <option value="747">747 - Banco Rabobank International</option>
    <option value="748">748 - Banco Cooperativo Sicredi</option>
    <option value="749">749 - Banco Simples</option>
    <option value="751">751 - Dresdner Bank</option>
    <option value="752">752 - BNP Paribas</option>
    <option value="753">753 - Banco Comercial Uruguai</option>
    <option value="755">755 - Banco Merrill Lynch</option>
    <option value="756">756 - Banco Cooperativo do Brasil</option>
    <option value="757">757 - KEB</option>
</datalist>

<datalist id="emissoresrg">
    <option value="1">DETRAN
    <option value="2">IIFP
    <option value="10">SSP
    <option value="40">Organismos Militares
    <option value="41">Comando da Aeronáutica
    <option value="42">Comando do Exército
    <option value="43">Comando da Marinha
    <option value="44">Polícia Federal
    <option value="60">Carteira de Identidade Classista
    <option value="61">Conselho Regional de Administração
    <option value="62">Conselho Regional de Assistência
    <option value="63">Conselho Regional de Biblioteconomia
    <option value="64">Conselho Regional de Contabilidade
    <option value="65">Conselho Regional de Corretores Imóveis
    <option value="66">Conselho Regional de Enfermagem
    <option value="67">Conselho Regional de Engenharia
    <option value="68">Conselho Regional de Estatística
    <option value="69">Conselho Regional de Farmácia
    <option value="70">Conselho Regional de Fisioterapia e Terapia Ocupacional
    <option value="71">Conselho Regional de Medicina
    <option value="72">Conselho Regional de Medicina Veterinária
    <option value="73">Ordem dos Músicos do Brasil
    <option value="74">Conselho Regional de Nutrição
    <option value="75">Conselho Regional de Odontologia
    <option value="76">Conselho Regional de Profissionais de Relações Públicas
    <option value="77">Conselho Regional de Psicologia
    <option value="78">Conselho Regional de Química
    <option value="79">Conselho Regional de Representantes Comerciais
    <option value="80">OAB - Ordem dos Advogados do Brasil
    <option value="81">Outros Emissores
    <option value="82">Documento Estrangeiro
</datalist>
{!! Form::submit('Salvar', ['class' => 'btn btn-success']); !!}
{!! Form::close() !!}

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>




@endsection
