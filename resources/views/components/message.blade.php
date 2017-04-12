@if(session('status') == 'success')
    <div class="callout callout-info">
        <h4>{{ session('title') }}</h4>
        <p>{{ session('msg') }}</p>
    </div>
@endif
@if(session('status') == 'error')
    <div class="callout callout-danger">
        <h4>{{ session('title') }}</h4>
        <p>{{ session('msg') }}</p>
    </div>
@endif