@if (!empty($alerts))
    @foreach ($alerts as $alert)
        <div class="mui-alert {{ $alert['type'] }}">
            <div class="alert-message">
                {!! $alert['message'] !!}
            </div>
            <button type="button" class="close-btn" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
    @endforeach
@endif
