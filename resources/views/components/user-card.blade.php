@props(['user'])
<div class="card shadow-lg" data-status="{{ $user->status }}">
    <div class="card-body text-center">
        <div class="d-flex justify-content-between">
            <img src="{{ asset('storage/userAvatar.png') }}"
                 class="rounded-circle mb-3"
                 width="70"
                 height="70">

            <div class="d-flex gap-1">

                <form action="{{ route('admin.user.destroy', $user) }}" method="POST">
                 @csrf
                 @method('DELETE')
                <button class="btn btn-danger" onclick="return alert('Do you want to remove this user?')">
                    <i class="bi bi-trash-fill text-light"></i>
                </button>
                </form>

                <div>
                <button class="btn btn-primary">
                  <a href="{{ route('admin.user.edit', $user) }}"> <i class="bi bi-pencil-square text-light"></i> </a>
                </button>
            </div>


                 <form action="{{ route('admin.user.suspend', $user) }}" method="POST">
                 @csrf
                 @method('PATCH')
                 <button class="btn btn-{{ $user->status === App\Enums\UserStatus::SUSPENDED ? 'secondary' :'warning' }}" onclick="return alert('Do you want to suspend this user?')"
                  @disabled($user->status === App\Enums\UserStatus::SUSPENDED)
                 >
                    <i class="bi bi-ban text-light"></i>
                </button>
                </form>
                
               
            </div>
        </div>

        <h5 class="card-title">{{ $user->name }}</h5>
        <p class="card-text text-muted">{{ $user->email }}</p>

        <span class="badge bg-{{ $user->status_color }}">
            {{ $user->status }}
        </span>
    </div>
</div>