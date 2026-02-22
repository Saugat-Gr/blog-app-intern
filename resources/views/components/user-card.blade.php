@props(['user'])
<div class="card shadow-lg" data-status="{{ $user->status }}">
    <div class="card-body text-center">
        <div class="d-flex justify-content-between">
            <img src="{{ asset('storage/userAvatar.png') }}"
                 class="rounded-circle mb-3"
                 width="70"
                 height="70">

            <div>
                <button class="btn btn-danger">
                    <a href="#"><i class="bi bi-trash-fill text-light"></i></a>
                </button>
                <button class="btn btn-primary">
                    <a href="#"><i class="bi bi-pencil-square text-light"></i></a>
                </button>
                <button class="btn btn-warning">
                    <a href="#"><i class="bi bi-ban text-light"></i></a>
                </button>
            </div>
        </div>

        <h5 class="card-title">{{ $user->name }}</h5>
        <p class="card-text text-muted">{{ $user->email }}</p>

        <span class="badge bg-{{ $user->status_color }}">
            {{ $user->status }}
        </span>
    </div>
</div>