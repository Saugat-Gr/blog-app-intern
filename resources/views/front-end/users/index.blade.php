@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- Creator Card --}}
    <div class="card border-0 shadow-lg mb-5 overflow-hidden">

        <div class="card-header text-dark py-3 bg-danger-subtle">

            <h5 class="mb-0 fw-bold">Creator</h5>

        </div>

        <div class="card-body d-flex align-items-center">

            <div class="position-relative">

                <img src="https://i.pravatar.cc/90?u={{ $superAdmin->id }}"
                     class="rounded-circle shadow"
                     style="border:4px solid white;">

            </div>

            <div class="ms-4">

                <h4 class="mb-1 fw-bold">{{ $superAdmin->name }}</h4>

                <small class="text-muted d-block">
                    {{ $superAdmin->email }}
                </small>

                <span class="badge bg-danger mt-2">
                    Super Admin
                </span>

            </div>

        </div>

    </div>


    {{-- Community Members --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="fw-bold">Community Members</h4>

        <span class="badge bg-dark-subtle text-dark">
            {{ $users->count() }} Members
        </span>

    </div>

    <div class="row g-4">

        @foreach($users as $user)

        <div class="col-md-4 shadow-lg ">

            <div class="card border-0 shadow-sm h-100 user-card">

                <div class="card-body text-center p-4">

                    <img src="https://i.pravatar.cc/90?u={{ $user->id }}"
                         class="rounded-circle mb-3 shadow">

                    <h5 class="fw-semibold mb-1">
                        {{ $user->name }}
                    </h5>

                    <p class="text-muted small mb-3">
                        {{ $user->email }}
                    </p>

                    <span class="badge bg-primary-subtle text-primary px-3 py-2">
                        {{ $user->roles->first()->name }}
                    </span>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>


{{-- Premium hover styling --}}
<style>

.user-card{
    transition: all .25s ease;
}

.user-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

</style>

@endsection