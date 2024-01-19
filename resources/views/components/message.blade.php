@if(Session::has('success'))
    @if(Session::get('success') === true)
        <div role="alert" class="alert alert-success mb-5">
            <span>{{ Session::get('message') }}</span>
        </div>
    @else
        <div role="alert" class="alert alert-error mb-5">
            <span>{{ Session::get('message') }}</span>
        </div>
    @endif
@endif

