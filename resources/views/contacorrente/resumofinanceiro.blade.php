@include('layouts.app')

<style>
    h5,
    .card-text,
    .card-headernew {
        color: white;
    }
</style>
<div style=" display: none;">

    {{$acessar = "cessar"}}
    {{$acessarArea = " "}}
    {{$titulo1 = "Saldo das Contas"}}
    {{$titulo2 = "Contas a Receber"}}
    {{$titulo3 = "Contas a Pagar"}}

</div>
<div class="d-flex justify-content-around mt-3">
    @can('ordemdeservico-list')

    <div class="card text-white bg-dark mb-3 mr-3" style="max-width: 22rem;">
        <div class="card-headernew d-flex justify-content-center"><p>{{$titulo1}}</p></div>
        <div class="card-body">
            <p class="card-text">Saldo Total das Contas: {{ $saldo }} </p>
            {{-- @foreach ($contasAtuais as $listaContas)
                <p class="card-text">Conta {{ $listaContas->nomeConta }} </p>
            @endforeach --}}
            @foreach ($dadosConta as $resumo)
                <p class="card-text" style="background-color: cadetblue;">{{ $resumo[0] }} Saldo: {{ $resumo[1] }} </p>
            @endforeach
        </div>
        <a style="text-transform: lowercase;" href="/contas">
            <div class="row col-sm-12">
                <div class="col-sm-6">
                    <div class="pl-5 pt-4 card-text row" style="color:white;"><p>A</p>{{$acessar}}</div>
                </div>
                <div class="col-sm-6">
                    <img src="img/credit-card.png" style="width: 70%;" alt="">
                </div>
            </div>
        </a>
        @endcan

    </div>


    <div class="card text-white bg-dark mb-3  mr-3" style="max-width: 22rem;">
        @can('conta-list')

        <a style="text-transform: lowercase;" href="{{ route('contasAReceber') }}">

            <div class="card-headernew d-flex justify-content-center"><p>{{$titulo2}}</p></div>
            <div class="card-body">
                {{-- <p class="card-text">{{ $acessarArea }} {{$titulo2}}</p> --}}

                @for ($i = 0; $i < $qtdReceitasPend; $i++)
                    <p class="card-text" style="background-color: cadetblue;">{{ $dadosContaAReceber[$i]->agenciaPorConta }} Valor a Receber: {{ $dadosContaAReceber[$i]->receitasPendentesPorConta }}</p>
                @endfor

            </div>
            <div class="row col-sm-12">
                <div class="col-sm-6">
                    <div class="pl-5 pt-4 card-text row" style="color:white;"><p>A</p>{{$acessar}}</div>
                </div>

                <div class="col-sm-6">
                    <img src="img/credit-card.png" style="width: 70%;" alt="">
                </div>
            </div>
        </a>
        @endcan
    </div>


    <div class="card text-white bg-dark mb-3" style="max-width: 22rem;">
        @can('conta-list')

        <a style="text-transform: lowercase;" href="{{ route('contasAPagar') }}">

            <div class="card-headernew d-flex justify-content-center"><p>{{$titulo3}}</p></div>
            <div class="card-body">
                {{-- <p class="card-text">{{ $acessarArea }} {{$titulo3}}</p> --}}
                @foreach ($dadosContaAPagar as $resumoAPagar)
                @if ($resumoAPagar[1] != null )
                <p class="card-text" style="background-color: cadetblue;">{{ $resumoAPagar[0] }} Valor a Receber: {{ $resumoAPagar[1] }}</p>
                @endif
                @endforeach

            </div>
            <div class="row col-sm-12">
                <div class="col-sm-6">
                    <div class="pl-5 pt-4 card-text row" style="color:white;"><p>A</p>{{$acessar}}</div>

                </div>
                <div class="col-sm-6">
                    <img src="img/report.png" style="width: 70%;" alt="">
                </div>
            </div>
        </a>
        @endcan
    </div>


</div>