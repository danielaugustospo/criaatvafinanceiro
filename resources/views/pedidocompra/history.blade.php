@isset($auditLogs)
    <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#modalHistoricoPedidoCompra">
        <i class="fa fa-history" aria-hidden="true"></i> Histórico
    </button>

    <div class="modal fade" id="modalHistoricoPedidoCompra" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="max-width: 200vh;">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Histórico do pedido n°{{ $pedido->id }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th  scope="col">Ação</th>
                            <th  scope="col">Dados Modificados</th>
                            <th  scope="col">Antes</th>
                            <th  scope="col">Depois</th>
                            <th  scope="col">Horário</th>
                            <th  scope="col">Usuário</th>
                        </tr>
                        @foreach ($auditLogs as $log)
                            <tr>
                                <td>{{ $log['action'] }}</td>
                                <td>
                                    {!! str_replace(',', ',<br>', strip_tags(json_encode($log['dirty']))) !!}
                                </td>
                                <td>
                                    {!! str_replace(',', ',<br>', strip_tags(json_encode($log['after']))) !!}
                                </td>
                                <td>
                                    {!! str_replace(',', ',<br>', strip_tags(json_encode($log['before']))) !!}
                                </td>
                                <td>{{ date('d-m-Y H:i:s', substr($log['updated_at'], 0, 10)) }}</td>
                                <td>
                                    @php
                                        $user = App\User::find($log['user_id']);
                                        $userName = $user ? $user->name : 'Usuário não encontrado';
                                        echo $userName;
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>

            </div>
        </div>
    </div>


@endisset
