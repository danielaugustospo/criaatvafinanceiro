@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edição de Tipo de Bem Patrimonial</h2>
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


    <form action="{{ route('products.update',$product->id) }}" method="POST">
    	@csrf
        @method('PUT')


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nome:</strong>
		            <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Nome">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detalhes:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detalhes">{{ $product->detail }}</textarea>
		        </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Ativo (Exibido na consulta):</strong>
                    <select name="ativotipobenspatrimoniais" id="ativotipobenspatrimoniais" style="padding:4px;" class="selecionaComInput form-control">
                        <option value="1" {{$product->ativotipobenspatrimoniais == 'S'?' selected':''}}>Sim</option>
                        <option value="0" {{$product->ativotipobenspatrimoniais == 'N'?' selected':''}}>Não</option>
                    </select>
            
                </div>
		        <!-- <div class="form-group">
		            <strong>Excluido:</strong> -->
                    <input type="hidden" name="excluidotipobenspatrimoniais" value="{{$product->excluidotipobenspatrimoniais}}" class="form-control" placeholder="Excluido">
		        <!-- </div> -->
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Salvar</button>
		    </div>
		</div>


    </form>

 
@endsection
