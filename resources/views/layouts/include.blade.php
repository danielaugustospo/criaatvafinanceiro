{{-- Popper --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>

{{-- Jquery --}}
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

{{-- TODO: Alterar a forma que o kendo grid é carregado --}}

@if(isset($relatorioKendoGrid) && !isset($paginaModal))

        <script src="{{ asset('js/kendogrid/kendo.all.min.js') }}"></script>
        <script src="{{ asset('js/kendogrid/messages.pt-BR.min.js') }}"></script>
        <!-- Carrega Pako ZLIB library para habilitar a compressão PDF -->
        <script src="https://kendo.cdn.telerik.com/2021.2.616/js/pako_deflate.min.js"></script>
        <script src="{{ asset('js/kendogrid/kendo.culture.pt-BR.min.js') }}"></script>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.4.0/jszip.min.js"></script>

@if (isset($legadoDatatables))
    @include('layouts/helpersview/incluidatatables')
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/4.1.3/css/bootstrap.min.css">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>


<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>


<script src="{{ asset('js/viacep.js') }}" defer></script>
<script src="{{ asset('js/funcionarios/validafavorecido.js') }}" defer></script>
<script src="{{ asset('js/inputmask5x/dist/jquery.inputmask.js') }}"></script>
<script src="{{ asset('js/inputmask5x/dist/bindings/inputmask.binding.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
    integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
</script>



<!-- Styles -->
<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

