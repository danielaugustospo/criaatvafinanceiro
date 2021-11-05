<head>
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

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div id="filter-menu"></div>
<br /><br />
<div id="grid"></div>