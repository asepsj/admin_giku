@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert"
        style="z-index: 1050;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
