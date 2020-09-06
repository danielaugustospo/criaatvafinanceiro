@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Cadastro de Tipo de Bem Patrimonial</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Voltar</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Ocorreram alguns erros com os valores inseridos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('products.store') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nome:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Nome">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detalhes:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detalhes"></textarea>
		        </div>
            </div>
            <input type="hidden" value="1" name="ativotipobenspatrimoniais" class="form-control" placeholder="Ativo">
            <input type="hidden" value="0" name="excluidotipobenspatrimoniais" class="form-control" placeholder="Excluido">

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Salvar</button>
		    </div>
		</div>


    </form>

<p class="text-center text-primary"><small>Desenvolvido por DanielTECH</small></p>
@endsection
