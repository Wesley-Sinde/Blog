@if ($errors->has($name))
    <span class="error">{!! $errors->first($name) !!}</span>
@endif