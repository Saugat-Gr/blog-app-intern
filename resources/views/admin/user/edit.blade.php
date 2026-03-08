@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="bg-danger-subtle border-bottom border-danger-subtle p-4">
                    <h5 class="text-uppercase text-muted small mb-1">
                        User Management
                    </h5>
                    <h2 class="fw-bold mb-0">
                        Edit User
                    </h2>
                </div>

                {{-- Body --}}
                <div class="card-body p-5">

                    <form action="{{ route('admin.user.update', $user) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        {{-- Name --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Username --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text"
                                   name="user_name"
                                   value="{{ old('user_name', $user->user_name) }}"
                                   class="form-control form-control-lg @error('user_name') is-invalid @enderror">

                            @error('user_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email (Readonly) --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email"
                                   class="form-control form-control-lg bg-light"
                                   value="{{ $user->email }}"
                                   disabled>
                            <small class="text-muted">Email cannot be changed.</small>
                        </div>

                        {{-- Current Image --}}
                        @if($user->image)
                            <div class="mb-3 text-center">
                                <img src="{{ asset('storage/' . $user->image) }}"
                                     class="rounded-circle shadow-sm"
                                     width="100"
                                     height="100"
                                     style="object-fit: cover;">
                            </div>
                        @endif

                        {{-- Upload New Image --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Update Profile Image</label>
                            <input type="file"
                                   name="image"
                                   class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Date of Birth --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Date of Birth</label>
                            <input type="date"
                                   name="date_of_birth"
                                   value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}"
                                   class="form-control @error('date_of_birth') is-invalid @enderror">

                            @error('date_of_birth')
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
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->value }}"
                                        {{ old('status', $user->status->value ?? $user->status) == $status->value ? 'selected' : '' }}>
                                        {{ ucfirst($status->value) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Role --}}
                       <div class="mb-4">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="role"
                                    class="form-select form-select-lg @error('status') is-invalid @enderror">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->value }}"
                                        {{ old('role', $user->role->value ?? $user->role) == $role->value ? 'selected' : '' }}>
                                        {{ ucfirst($role->value) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.index') }}"
                               class="btn btn-outline-dark px-4">
                                Cancel
                            </a>


                            <button type="submit"
                                    class="btn bg-danger-subtle text-dark px-4 shadow-sm">
                                Update User
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection