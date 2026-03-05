@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0  shadow-lg rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="bg-danger-subtle border-bottom border-danger-subtle p-4">
                    <h5 class="text-uppercase text-muted small mb-1">
                        Subscription Plan
                    </h5>
                    <h2 class="fw-bold mb-0">
                        {{ isset($plan) ? 'Edit Plan' : 'Create New Plan' }}
                    </h2>
                </div>

                {{-- Body --}}
                <div class="card-body p-5">

                    <form action="{{ isset($plan) ? route('admin.plan.update', $plan) : route('admin.plan.store') }}" method="POST">
                        @csrf
                        @if(isset($plan))
                            @method('PATCH')
                        @endif

                        {{-- Plan Name --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Plan Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   value="{{ old('name', $plan->name ?? '') }}"
                                   placeholder="Enter plan name">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Price (Rs.)</label>
                            <input type="number"
                                   name="price"
                                   step="0.01"
                                   class="form-control form-control-lg @error('price') is-invalid @enderror"
                                   value="{{ old('price', $plan->price ?? '') }}"
                                   placeholder="Enter plan price">

                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Duration --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Duration (Days)</label>
                            <input type="number"
                                   name="duration_days"
                                   class="form-control form-control-lg @error('duration_days') is-invalid @enderror"
                                   value="{{ old('duration_days', $plan->duration ?? '') }}"
                                   placeholder="Enter duration in days">

                            @error('duration_days')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status"
                                    class="form-select form-select-lg @error('status') is-invalid @enderror">
                                @foreach($statuses as $status)
                                  @if($status->value !== 'all')
                                     <option value="{{ $status->value }}"
                                        {{ old('status', $plan->status ?? '') == $status->value ? 'selected' : '' }}>
                                        {{ ucfirst($status->value) }}
                                    </option>
                                  @endif
                                @endforeach
                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description"
                                      id="editor"
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="6"
                                      placeholder="Write plan description...">{{ old('description', $plan->description ?? '') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('admin.plan.index') }}"
                               class="btn btn-outline-dark px-4">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn bg-danger-subtle px-4 shadow-sm">
                                {{ isset($plan) ? 'Update Plan' : 'Create Plan' }}
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

{{-- EasyMDE --}}
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