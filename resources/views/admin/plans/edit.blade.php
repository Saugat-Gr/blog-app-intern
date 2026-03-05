@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4">

                {{-- Header --}}
                <div class="card-header bg-danger-subtle border rounded  p-4">
                    <h4 class="fw-bold mb-1 text-dark">
                        ✏️ Edit Plan
                    </h4>
                    <p class="text-muted mb-0">
                        Update plan details below
                    </p>
                </div>

                {{-- Body --}}
                <div class="card-body p-5">

                    <form action="{{ route('admin.plan.update', $plan) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        {{-- Plan Name --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Plan Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $plan->name) }}"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   placeholder="Enter plan name">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                           <div class="mb-4">
                            <label class="form-label fw-semibold">Duration (Days)</label>
                            <input type="number"
                                   name="duration_days"
                                   class="form-control form-control-lg @error('duration_days') is-invalid @enderror"
                                   value="{{ old('duration_days', $plan->duration_days ) }}"
                                   placeholder="Enter duration in days">

                            @error('duration_days')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Price (Rs.)</label>
                            <input type="number"
                                   step="0.01"
                                   name="price"
                                   value="{{ old('price', $plan->price) }}"
                                   class="form-control form-control-lg @error('price') is-invalid @enderror"
                                   placeholder="Enter price">

                            @error('price')
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
                                      rows="5"
                                      id="editor"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Enter plan description">{{ old('description', $plan->description) }}</textarea>

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
                                Update Plan
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection