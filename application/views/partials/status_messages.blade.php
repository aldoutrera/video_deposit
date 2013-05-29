@if (Session::get('status'))
    <div class="row">
        <div class="span12">
            {{ Session::get('status') }}
        </div>
    </div>
@endif
