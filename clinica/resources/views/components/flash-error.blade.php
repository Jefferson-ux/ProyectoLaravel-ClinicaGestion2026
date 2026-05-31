@if (session('error'))
    <div class="alert alert-error mb-4 shadow-sm">
        <span>{{ session('error') }}</span>
    </div>
@endif
