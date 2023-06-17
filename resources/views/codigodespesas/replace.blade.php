@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Submeter Dados</div>

                    <div class="card-body">
                        @include('layouts/helpersview/mensagemRetorno')


                        <form method="POST" action="{{ route('replacecodigodespesa') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="idCodigoDespesa" class=" col-sm-2 col-form-label">Selecione o Código</label>
                                <div class="col-sm-10">
                                    <select name="codigoDespesa" id="codigoDespesa"
                                        class="selecionaComInput col-sm-12" style="width:500px;" required>
                                        @foreach ($listaCodigoDespesa as $codigoDespesa)
                                            <option value="{{ $codigoDespesa->despesaCodigoDespesa }}">Id: {{ $codigoDespesa->id }} - Código:
                                                {{ $codigoDespesa->despesaCodigoDespesa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submeter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
