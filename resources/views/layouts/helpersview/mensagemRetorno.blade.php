@isset ($mensagemExito)
<div class="alert alert-success  pr-2">
    <p><i class="fa fa-check" aria-hidden="true"></i>{{ $mensagemExito }}</p>
</div>
@endisset
@if ($message = Session::get('success'))
<div class="alert alert-success  pr-2">
    <p><i class="fa fa-check" aria-hidden="true"></i>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-error pr-2">
    <p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning">
    <p><i class="fa fa-exclamation-triangle pr-2" aria-hidden="true"></i> {{ $message }}</p>
</div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif