@if (Session::get('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Well done!</strong> {{ Session::get('success') }}
    </div>
@endif
@if (Session::get('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        @if ($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        <strong>Oh snap!</strong> {{ Session::get('error') }}
    </div>
@endif
@if (Session::get('warning'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Warning!</strong> {{ Session::get('warning') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    </div>
@endif