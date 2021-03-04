@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Dados da Permissão: <b>{{ $role->name }}</b></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Voltar</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Regras de Permissão:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <span class="badge badge-dark">{{ $v->name }},</span>
                @endforeach
            @endif
        </div>
    </div>
</div>

 
@endsection
