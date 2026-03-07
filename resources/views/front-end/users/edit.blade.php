@extends('layouts.app')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card border-0 shadow-lg overflow-hidden">

                    {{-- Header --}}
                    <div class="card-header text-white py-3 bg-danger-subtle">

                        <h5 class="mb-0 fw-bold">
                            Edit Your Profile 
                        </h5>

                    </div>


                    <div class="card-body p-5">

                        {{-- Avatar Section --}}
                        <div class="text-center mb-4 d-flex align-items-center justify-content-between gap-2">

                            <img src="https://i.pravatar.cc/120?u={{ $user->id }}" class="rounded-circle shadow mb-3"
                                style="border:4px solid #fff;">

                            <div>
                                <h5 class="fw-semibold">
                                    {{ $user->name }}
                                </h5>

                                <small class="text-muted">
                                    {{ $user->email }}
                                </small>
                            </div>

                        </div>


                        <form method="POST" action="{{ route('user.update', $user->id) }}">

                            @csrf
                            @method('PUT')


                            {{-- Name --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Name
                                </label>

                                <input type="text" name="name" class="form-control form-control-lg"
                                    value="{{ old('name', $user->name) }}" required>

                            </div>

                            <!-- User-name -->


                            <div class="mb-4">
                                <label for="user_name" class="form-label fw-semibold">User Name</label>
                                <input type="text" name="user_name" id="user_name" class="form-control form-control-lg"
                                    value="{{ old('user_name', $user->user_name) }}" required>
                            </div>


                            {{-- Email --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input type="email" name="email" class="form-control form-control-lg"
                                    value="{{ old('email', $user->email) }}" disabled>

                            </div>


                            {{-- Image --}}
                            <div>
                                <label class="form-label fw-semibold">Image</label>
                                <input type="file" name="image" class="form-control form-control-lg">
                            </div>


                            {{-- Date Of Birth --}}

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Date Of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control form-control-lg"
                                    value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                            </div>


                            {{-- Buttons --}}
                            <div class="d-flex justify-content-between mt-5">

                                <a href="{{ route('user.index') }}" class="btn btn-dark px-4">

                                    Cancel

                                </a>


                                <button type="submit" class="btn bg-danger-subtle px-5">

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
