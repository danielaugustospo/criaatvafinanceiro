<div class="container" id="container">
    <div id="areaTabela">
        <div id="div_BuscaPersonalizada">
            <h4 class="text-center">Busca Personalizada</h4>
            <div class="row">

                <label for="" class="col-sm-1">Id</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple" name="id" id="id">
                    <option value="">Listar todos</option>
                    @foreach ($listaFuncionarios as $funcionarios)
                    <option value="{{ $funcionarios->id }}">{{ $funcionarios->id }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-2">CPF</label>
                <select class="selecionaComInput form-control col-sm-4 js-example-basic-multiple" name="cpfFuncionario" id="cpfFuncionario">
                    <option value="">Listar todos</option>
                    @foreach ($listaFuncionarios as $funcionarios)
                    <option value="{{ $funcionarios->cpfFuncionario }}">{{ $funcionarios->cpfFuncionario }}</option>
                    @endforeach
                </select>

                <label for="" class="col-sm-1">Nome</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple" name="nomeFuncionario" id="nomeFuncionario">
                    <option value="">Listar todos</option>
                    @foreach ($listaFuncionarios as $funcionarios)
                    <option value="{{ $funcionarios->nomeFuncionario }}">{{ $funcionarios->nomeFuncionario }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row">
                <label for="" class="col-sm-1">Celular</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple" name="celularFuncionario" id="celularFuncionario">
                    <option value="">Listar todos</option>
                    @foreach ($listaFuncionarios as $funcionarios)
                    <option value="{{ $funcionarios->celularFuncionario }}">{{ $funcionarios->celularFuncionario }}</option>
                    @endforeach
                </select>
                <label for="" class="col-sm-2">Email</label>
                <select class="selecionaComInput form-control col-sm-2 js-example-basic-multiple" name="emailFuncionario" id="emailFuncionario">
                    <option value="">Listar todos</option>
                    @foreach ($listaFuncionarios as $funcionarios)
                    <option value="{{ $funcionarios->emailFuncionario }}">{{ $funcionarios->emailFuncionario }}</option>
                    @endforeach
                </select>

            </div>
            <div class="row mt-3">
                <input class="btn btn-primary ml-2" type="button" name="pesquisar" id="pesquisar" value="Pesquisar">
            </div>
        </div>
        <hr>
    </div>
    <br>
