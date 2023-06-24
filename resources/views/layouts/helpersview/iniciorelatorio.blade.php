<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="row pull-left">
            <a class="btn btn-primary" href="{{ route("$rotavoltar") }}"> Voltar</a>
            <h2 class="pl-5">{{ $titulo }}</h2>
        </div>
        <hr />
    </div>
</div>


@include('layouts/helpersview/mensagemRetorno')

{{-- <head>
    <meta charset="utf-8">
    <title>{{$titulo}}</title>
</head>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="text-center">Relatório de {{$titulo}}</h2>
        </div>

    </div>
</div>

@include('layouts/helpersview/mensagemRetorno')


<div id="filter-menu"></div>
<br /><br />
<div id="grid"></div>
 --}}