@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="text-center">{{ isset($plan) ? 'Edit Plan' : 'Create Plan' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($plan) ? route('admin.plan.update', $plan) : route('admin.plan.store') }}" method="POST">
                @csrf
                @if(isset($plan))
                    @method('PATCH')
                @endif

                <!-- Plan Name -->
                <div class="mb-3">
                    <label class="form-label">Plan Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $plan->name ?? '') }}" required>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $plan->price ?? '') }}" required>
                    @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Duration -->
                <div class="mb-3">
                    <label class="form-label">Duration (days)</label>
                    <input type="number" name="duration_days" class="form-control" value="{{ old('duration_days', $plan->duration ?? '') }}" required>
                    @error('duration_days') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        @foreach($statuses as $status)
                            <option value="{{ $status->value }}" {{ old('status', $plan->status ?? '') == $status->value ? 'selected' : '' }}>
                                {{ ucfirst($status->value) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="editor" class="form-control" rows="5" required>{{ old('description', $plan->description ?? '') }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Submit -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100">
                        {{ isset($plan) ? 'Update Plan' : 'Create Plan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<form action="{{ route('admin.plan.store') }}" method="POST">
     @csrf
     <button type="submit">SUBMIT</button>
</form>

<!-- EasyMDE Initialization -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
<script>
document.addEventListener('DOMContentLoaded', function() {
    new EasyMDE({
        element: document.getElementById('editor'),
        spellChecker: true,
        toolbar: [
            "bold", "italic", "heading", "|", 
            "quote", "unordered-list", "ordered-list", "|", 
            "link", "preview", "side-by-side", "fullscreen"
        ]
    });
});
</script>
@endpush
@endsection