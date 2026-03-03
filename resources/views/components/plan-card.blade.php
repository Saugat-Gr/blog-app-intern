@props(['plan'])
<div class="card shadow-lg" data-status="{{ $plan->status }}">
    <div class="card-body text-center">
        <div class="d-flex justify-content-between">
            <img src="{{ asset('storage/userAvatar.png') }}"
                 class="rounded-circle mb-3"
                 width="70"
                 height="70">

            <div class="d-flex gap-1">


                <div>
                     <button class="btn bg-danger-subtle">
                        <a href="{{ route('admin.plan.show', $plan) }}"><i class="bi bi-eye-fill text-dark"></i></a>
                     </button>
                </div>

                <div>
                    <button class="btn btn-primary">
                    <a href="{{ route('admin.plan.edit', $plan) }}"> <i class="bi bi-pencil-square text-light"></i> </a>
                </div>
                

                <form action="{{ route('admin.plan.destroy', $plan) }}" method="POST">
                 @csrf
                 @method('DELETE')
                <button class="btn btn-danger" onclick="return alert('Do you want to remove this plan?')">
                    <i class="bi bi-trash-fill text-light"></i>
                </button>
                </form>

            </div>
        </div>

        <h5 class="card-title text-center">{{ $plan->name }} Plan</h5>
        <p class="card-text text-muted">Price: {{ $plan->price }}</p>

        <span class="badge bg-{{ $plan->status_color }}">
            {{ $plan->status }}
        </span>
    </div>
</div>