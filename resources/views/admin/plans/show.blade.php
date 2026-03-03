@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden ">

                {{-- Header --}}
                <div class="bg-gradient bg-danger-subtle text-dark p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 text-uppercase text-dark small">Subscription Plan:</h5>
                        <h2 class="fw-bold mb-0">{{ $plan->name }}</h2>
                    </div>

                    <div class="text-end">
                        <span class="badge bg-{{ $plan->status_color }} px-3 py-2">
                            {{ ($plan->status) }}
                        </span>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body p-5">

                    {{-- Price Section --}}
                    <div class="mb-5 text-center">
                        <h1 class="display-4 fw-bold text-body-secondary">
                            Rs. {{ number_format($plan->price, 2) }}
                        </h1>
                        <p class="text-muted mb-0">Per Subscription</p>
                    </div>

                    {{-- Divider --}}
                    <hr class="my-4">

                    {{-- Description --}}
                    <div class="mb-4">
                        <h6 class="fw-bold text-uppercase text-muted">
                            Plan Description
                        </h6>

                        <p class="fs- text-secondary" style="white-space: pre-line;">
                            {{ $plan->description }}
                        </p>
                    </div>

                </div>

                {{-- Footer Actions --}}
                <div class="bg-light p-4 d-flex justify-content-end gap-3">

                    <a href="{{ route('admin.plan.edit', $plan) }}" 
                       class="btn btn-outline-primary px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Plan
                    </a>

                    <form action="{{ route('admin.plan.destroy', $plan) }}" 
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this plan?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-danger-subtle px-4 text-danger">
                            <i class="bi bi-trash me-1 text-danger"></i>
                            Delete Plan
                        </button>
                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection