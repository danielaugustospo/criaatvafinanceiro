<style>
    h5,
    .card-text,
    .card-headernew {
        color: white;
    }

    .cardCustomizado {
        /* max-width: 18.5% !important; */
    }

    .acessarMinusculo {
        text-transform: lowercase !important;
    }
</style>
<script>
    function validaSandbox() {

        $.ajax({
            method: "GET",
            dataType: "json",
            url: "{{ route('sandbox.index') }}",
            beforeSend: function(xhr) {
                xhr.overrideMimeType("text/plain; charset=x-user-defined");
            },
            success: function(data) {
                if (data.ativo == '1') {
                    var title = 'Deseja desligar o modo de conciliação?';
                    var text = 'Ao confirmar, não será possível realizar lançamentos retroativos!';
                    var realizadoTitle = 'Desligado';
                    var realizadoText = 'Agora não será mais possível realizar lançamentos retroativos!';
                    var statusInverso = 0;
                    var corBackground = "black";
                    var cor           = "yellow";
                } else if (data.ativo == '0') {
                    var title = 'Deseja ligar o modo de conciliação?';
                    var text = 'Ao confirmar, será possível realizar lançamentos retroativos!';
                    var realizadoTitle = 'Ligado';
                    var realizadoText = 'Agora será possível realizar lançamentos retroativos!';
                    var statusInverso = 1;
                    var corBackground = "darkorange";
                    var cor           = "black";
                }

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, desejo prosseguir',
                    cancelButtonText: 'Não, cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var request = $.ajax({
                            url: "{{ route('sandbox.store') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                ativo: statusInverso
                            },
                            dataType: "json",
                            success: function(data) {
                                document.getElementById("navbar").style.backgroundColor = corBackground;
                                // document.getElementById("navbar").style.backgroundColor = corBackground;
                                // tamanhoCollection = document.getElementsByClassName("nav-link").length;
                                for (let index = 0; index < document.getElementsByClassName("nav-link").length; index++) {
                                    // const element = array[index];
                                    document.getElementsByClassName("nav-link")[index].style.color = cor;
                                }
                                swalWithBootstrapButtons.fire(
                                    realizadoTitle,
                                    realizadoText,
                                    'success'
                                ).then((recarrega) => {
                                    window.location.reload();  
                                    }
                                )
                            },

                            error: function (request, status, error) {
                                alert("Ocorreu um erro ao atualizar: " + status);
                            }
                        });

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Operação Cancelada',
                            'Nenhuma operação foi realizada',
                            'info'
                        )
                    }
                })
            },
        });

    }
</script>
<div style=" display: none;">

    {{ $titulo1 = 'Ordem de Serviços' }}
    {{ $titulo2 = 'Conta Corrente' }}
    {{ $titulo3 = 'Relatórios' }}
    {{ $titulo4 = 'Clientes' }}
    {{ $titulo5 = 'Fornecedores' }}
    {{ $titulo6 = 'Funcionários' }}
    {{ $titulo7 = 'Estoque' }}
    {{ $titulo8 = 'SandBox' }}
</div>
<div class="row m-2 justify-content-center">
    @can('ordemdeservico-list')
        <div class="d-flex justify-content-around mt-3">

            <a href="{{ route('ordemdeservicos.index') }}">
                <div class="card text-white bg-dark mb-3 cardCustomizado"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">
                    <div class="card-headernew d-flex justify-content-center">
                        <h4 class="pt-4">{{ $titulo1 }}</h4>
                    </div>
                    <div class="card-body mt-1"></div>

                    <div class="row col-sm-12 ">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>
                        </div>

                        <div class="col-sm-5 pb-2">
                            <img src="img/clipboard.png" style="width: 70%;" alt="">
                        </div>
                    </div>
                </div>
            </a>

        </div>
    @endcan

    @can('visualiza-contacorrente')
        <div class="d-flex justify-content-around mt-3">

            <a data-toggle="modal" onclick="alteraRotaFormularioCC();" data-target="#exampleModalCenter"
                style="cursor: pointer;">
                <div class="card text-white bg-dark mb-3 cardCustomizado"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

                    <div class="card-headernew d-flex justify-content-center">
                        <h4 class="pt-4">{{ $titulo2 }}</h4>
                    </div>
                    <div class="card-body mt-1"></div>
                    <div class="row col-sm-12">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                        </div>
                        <div class="col-sm-5">
                            <img src="img/credit-card.png" style="width: 70%;" alt="">
                        </div>
                    </div>
                    {{-- </button> --}}
                </div>
            </a>
        </div>
    @endcan
    @can('visualiza-relatoriogeral')
        <div class="d-flex justify-content-around mt-3">
            <a href="relatorio">
                <div class="card text-white bg-dark mb-3 cardCustomizado"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

                    <div class="card-headernew d-flex justify-content-center">

                        <h4 class="pt-4">{{ $titulo3 }}</h4>
                    </div>
                    <div class="card-body mt-1"></div>
                    <div class="row col-sm-12">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                        </div>
                        <div class="col-sm-5">
                            <img src="img/report.png" style="width: 70%;" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endcan

    @can('cliente-list')
        <div class="d-flex justify-content-around mt-3">

            <a href="{{ route('clientes.index') }}">

                <div class="card text-white bg-dark mb-3 cardCustomizado"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

                    <div class="card-headernew d-flex justify-content-center">

                        <h4 class="pt-4">{{ $titulo4 }}</h4>
                    </div>
                    <div class="card-body mt-1"></div>

                    <div class="row col-sm-12">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                        </div>
                        <div class="col-sm-5">
                            <img src="img/crm.png" style="width: 70%;" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endcan
    @can('fornecedor-list')
        <div class="d-flex justify-content-around mt-3">

            <a href="{{ route('fornecedores.index') }}">
                <div class="card text-white bg-dark mb-3 cardCustomizado"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

                    <div class="card-headernew d-flex justify-content-center">
                        <h4 class="pt-4">{{ $titulo5 }}</h5>
                    </div>
                    <div class="card-body mt-1"></div>

                    <div class="row col-sm-12">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                        </div>
                        <div class="col-sm-5">
                            <img src="img/help.png" style="width: 70%;" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endcan
    @can('funcionario-list')
        <div class="d-flex justify-content-around mt-3">
            <a href="{{ route('funcionarios.index') }}">

                <div class="card text-white bg-dark mb-3 cardCustomizado"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

                    <div class="card-headernew d-flex justify-content-center">
                        <h4 class="pt-4">{{ $titulo6 }}</h4>
                    </div>
                    <div class="card-body mt-1"></div>

                    <div class="row col-sm-12">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                        </div>
                        <div class="col-sm-5">
                            <img src="img/working-man.png" style="width: 70%;" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endcan
    @can('estoque-list')
        <div class="d-flex justify-content-around mt-3">
            <a href="{{ route('estoque.index') }}">
                <div class="card text-white bg-dark mb-3 cardCustomizado"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

                    <div class="card-headernew d-flex justify-content-center">
                        <h4 class="pt-4">{{ $titulo7 }}</h4>
                    </div>
                    <div class="card-body mt-1"></div>

                    <div class="row col-sm-12">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                        </div>
                        <div class="col-sm-5">
                            <img src="img/inventario.png" style="width: 130%;" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endcan
    @can('sandbox-modify')
        <div class="d-flex justify-content-around mt-3">
            <a onclick="validaSandbox();" style="cursor: pointer;">
                <div class="card text-white bg-dark mb-3 cardCustomizado"
                    style="max-width: 18rem;box-shadow: 10px 10px 30px 3px darkgrey;border-radius: 11px 37px 0px 37px;background-color: darkgrey;transition: 0.3s;color: white;">

                    <div class="card-headernew d-flex justify-content-center">
                        <h4 class="pt-4">{{ $titulo8 }}</h4>
                    </div>
                    <div class="card-body mt-1"></div>

                    <div class="row col-sm-12">
                        <div class="col-sm-7 row">
                            <h5 class="ml-5 pt-2 card-title fontenormal">Acessar</h5>

                        </div>
                        <div class="col-sm-5">
                            <img src="img/seguranca.png" style="width: 70%;" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endcan
</div>
