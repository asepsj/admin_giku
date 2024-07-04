@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert"
        style="z-index: 1050;">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
