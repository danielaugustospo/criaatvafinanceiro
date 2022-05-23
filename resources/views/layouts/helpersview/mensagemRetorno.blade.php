@if ($message = Session::get('success'))
<div class="alert alert-success  pr-2">
    <p><i class="fa fa-check" aria-hidden="true"></i>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-error">
    <p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning">
    <p><i class="fa fa-exclamation-triangle pr-2" aria-hidden="true"></i> {{ $message }}</p>
</div>
@endif