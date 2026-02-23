@extends('layouts.app')

@section('content')

<div class="container-sm border rounded p-5 mt-5 shadow shadow-lg">

         <h3 class="text-center">Edit User</h3>

      <form action="{{ route('admin.user.update', $user)   }}" method="POST">
           @method('PATCH')
           @csrf

                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                 <div class="mb-2">
                    <label>User-name</label>
                    <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $user->user_name) }}" required>
                    @error('user_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
                </div>


                <div class="mb-2">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

            <div class="mb-3">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control"  
                        value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                    @error('date_of_birth')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>

                <div class="mb-3">
                    <label for="select">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                         @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" 
                                @selected($status === $user->status)>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="select">Role</label>
                    <select class="form-select" aria-label="Default select example" name="role">
                         <option value="admin" @selected($user->role === 'admin')>Admin</option>
                         <option value="user" @selected($user->role ==='user')>User</option>
                    </select>
                </div>

                <button type="submit" class="btn  bg-danger-subtle w-100">
                    Submit
                </button>

    </form>
 </div>
 

@endsection