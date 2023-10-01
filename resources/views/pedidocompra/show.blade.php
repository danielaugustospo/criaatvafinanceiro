@extends('layouts.app')

@section('content')


    <style>
        span#select2-ped_contaaprovada-container {
            font-size: 20;
            /* color: red; */
            background-color: yellow;
        }
    </style>

    @isset($pedido)
        @if ($pedido->ped_usrsolicitante == Auth::id() || Gate::check('pedidocompra-analise'))
            @if ($pedido->ped_aprovado == '1' && $pedido->ped_novanotificacao == '1')
                {!! Form::model($pedido, ['method' => 'POST', 'route' => ['marcacomolido', $pedido->id]]) !!}

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Pedido Aprovado!</h4>
                    <p>Por padrão, esta mensagem permanece ativa para você até que seja marcada como lida. 
                        Ao fazer isso, você deixa de ver essa notificação aqui, bem como na barra de navegação superior.</p>
                    <hr>
                    <p class="mb-0">O aviso acima refere-se <b>exclusivamente para este pedido de compra.</b></p>
                    <button type="submit" class="btn btn-success">Marcar como lido</button>
                </div>
                <input type="hidden" name="id" value="{{ $pedido->id }}">
                <input type="hidden" name="ped_novanotificacao" value="0">
                {!! Form::close() !!}
            @endif

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2> Dados do Pedido <b>{{ $pedido->id }}</b></h2>
                    </div>
                    <div class="pull-right">

                        @can('pedidocompra-analise')
                            @include('pedidocompra/analise')
                        @endcan
                        <form action="{{ route('pedidocompra.destroy', $pedido->id) }}" method="POST">
                            <a class="btn btn-danger" href="{{ route('pedidocompra.index') }}"> Voltar</a>

                            @if (Gate::check('pedidocompra-analise'))
                            @else
                                @can('pedidocompra-edit')
                                    @if($pedido->ped_aprovado != 1)
                                        <a class="btn btn-primary" href="{{ route('pedidocompra.edit', $pedido->id) }}">Editar</a>
                                    @endif
                                @endcan
                            @endif

                            @csrf
                            {{-- @method('DELETE')
                @can('pedidocompra-delete')
                <button type="submit" class="btn btn-danger">Cancelar Pedido</button>
                @endcan --}}
                        </form>
                    </div>
                </div>
            </div>


            {!! Form::model($pedido, ['method' => 'PATCH', 'route' => ['pedidocompra.update', $pedido->id]]) !!}

            @include('pedidocompra/campos')
            {!! Form::close() !!}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPedidoCompra">
                <i class="fa fa-check" aria-hidden="true"></i><i class="fa fa-ban" aria-hidden="true"></i> Análise
            </button>
            <div style="background-color: rgb(0, 0, 0);" class="p-2">
                <h1 class="text-center" style="color: white;">Avaliação do pedido</h1>
                <div class="row mt-5 mb-2">
                    <label class="col-sm-2 mr-2 mt-2" for="" style="color: white;">Aprovado</label>
                    @if ($pedido->ped_aprovado == '1')
                        <h4 for="" style="color: rgb(151, 243, 151);">SIM</h4>
                    @elseif($pedido->ped_aprovado == '0')
                        <h4 for="" style="color: red;">NÃO</h4>
                    @else
                        <h4 for="" style="color: rgb(245, 205, 131);">PEDIDO AINDA NÃO AVALIADO</h4>
                    @endif

                </div>
                @if ($pedido->ped_aprovado == '1')
                    <div class="row mt-2 mb-2">
                        <label class="col-sm-2 mr-2 mt-2" for="" style="color: white;">Conta Aprovada</label>


                        <select name="ped_contaaprovada" id="ped_contaaprovada"
                            class="selecionaComInput form-control col-sm-7  js-example-basic-multiple"
                            {{ $variavelDisabledNaView }}>
                            @foreach ($listaContas as $contas)
                                @isset($pedido->ped_contaaprovada)
                                    @if ($pedido->ped_contaaprovada == $contas->id)
                                        <option value="{{ $contas->id }}" selected>{{ $contas->apelidoConta }}</option>
                                    @endif
                                @endisset
                                <option value="">SEM CONTA</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="row mt-2 mb-2 ">
                        <label class="col-sm-2 mr-2 mt-2" for="" style="color: white;">Exigência Para Aprovação</label>
                        {!! Form::text('ped_exigaprov', $pedido->ped_exigaprov, [
                            'class' => 'col-sm-7 form-control',
                            'maxlength' => '100',
                            $variavelReadOnlyNaView,
                        ]) !!}

                    </div>
                @endif
                <div class="row mt-2 mb-2 ">
                    <label class="col-sm-2 mr-2 mt-2" for="" style="color: white;">Observação</label>
                    {!! Form::text('ped_observacao', $pedido->ped_observacao, [
                        'class' => 'col-sm-7 form-control',
                        'maxlength' => '80',
                        $variavelReadOnlyNaView,
                    ]) !!}

                </div>
            </div>
        @else
            <h1 class="text-center mt-5">NÃO AUTORIZADO. <br> CONTATE O ADMINISTRADOR DO SISTEMA</h1>
        @endif
    @endisset

@endsection
