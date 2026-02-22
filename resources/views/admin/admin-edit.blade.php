@extends('layouts.app')

@section('content')

<div class="container-sm border rounded p-5 mt-5 shadow shadow-lg">

         <h3 class="text-center">Edit User</h3>

      <form action="{{ route('admin.update', auth()->user()) }}" method="POST">
           @method('PATCH')
           @csrf

                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    @error('name', 'register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                 <div class="mb-2">
                    <label>User-name</label>
                    <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $user->user_name) }}" required>
                    @error('user_name', 'register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
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
                    <input type="date" name="date_of_birth" class="form-control" value="{{ $user->date_of_birth }}">
                    @error('date_of_birth', 'register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <button type="submit" class="btn  bg-danger-subtle w-100">
                    Submit
                </button>

    </form>
 </div>
 

@endsection