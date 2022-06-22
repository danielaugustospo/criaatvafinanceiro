@include('layouts/modal/includesmodal')

<div class="container panel panel-default pt-2 pb-2">

    @if (isset($mensagem))
    <div class="alert alert-success" role="alert">
        <p>{{ $mensagem }}</p>
    </div>
    @endif
	

    <form action="{{ route('cadastrotipomateriais') }}" method="POST">
    	@csrf


         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Nome:</strong>
		            <input type="text" name="name" class="form-control" placeholder="Nome" required>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detalhes:</strong>
		        </div>
            </div>
			<input type="hidden" value="0" name="detail" class="form-control" placeholder="Detalhes"/>
            <input type="hidden" value="1" name="ativotipobenspatrimoniais" class="form-control" placeholder="Ativo">
            <input type="hidden" value="0" name="excluidotipobenspatrimoniais" class="form-control" placeholder="Excluido">

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Salvar</button>
		    </div>
		</div>


    </form>

</div>