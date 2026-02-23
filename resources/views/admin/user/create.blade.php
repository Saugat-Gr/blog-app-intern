@extends('layouts.app')

@section('content')

 <form action="{{ route('auth.register') }}" method="POST" enctype="multipart/form-data" class="shadow-lg p-5 border rounded mt-5">
                @csrf

                <h2 class="text-center mb-2">Create A User</h2>

                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name', 'register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                 <div class="mb-2">
                    <label>User-name</label>
                    <input type="text" name="user_name" class="form-control" required>
                    @error('user_name', 'register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                    @error('email', 'register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password', 'register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                 <div class="mb-2">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            @error('password_confirmation', 'log-in')
                        <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

                <div class="mb-2">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image', 'register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control">
                    @error('date_of_birth', 'register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                 <div class="mb-3">
                    <label for="select">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option selected> SELECT STATUS</option>
                         @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" 
                                @selected(old('status'))>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="select">Role</label>
                    <select class="form-select" aria-label="Default select example" name="role">
                         <option selected>SELECT ROLE</option>
                         <option value="admin">Admin</option>
                         <option value="user">User</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-info w-100">
                    Submit
                </button>
            </form>

@endsection