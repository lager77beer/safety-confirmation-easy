@if ($message = Session::get('message'))
    <div class="alert alert-info">
        <span class="ml-4">{{ $message }}</span>
    </div>
@endif
