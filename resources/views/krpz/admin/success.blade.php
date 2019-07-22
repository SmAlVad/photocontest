@if(session('success'))

    <div class="alert alert-success"
         role="alert"
         id="admin-success-message"
         style="position: absolute;right: 10px;min-width: 300px;display: none;">
        <i class="far fa-check-circle" style="font-size: 20px;"></i>

        {{ session()->get('success') }}
    </div>

@endif
