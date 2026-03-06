@extends('layouts.app')

@section('content')

<div class="container vh-100 d-flex align-items-center">


<div class="d-flex w-100 border p-4 bg-danger-subtle rounded" style="min-height:600px;">

    <div class="flex-fill d-flex align-items-center justify-content-center flex-column gap-4 login-text d-none">
        <h3 class="text-center">Already Registered?</h3>
        <button class="btn btn-dark" id="btn-login">Login</button>
    </div>

    
    <div class="flex-fill border bg-white shadow-lg rounded login-form p-4 d-flex flex-column justify-content-center">
        <h3 class="mt-3 text-center">Login</h3>

        <form action="{{ route('auth.login') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label>Email Or Username</label>
                <input type="text" class="form-control" name="login" required>
                @error('login', 'log-in')
                        <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            @error('password', 'log-in')
                        <span class="text-danger">{{$message}}</span>
                @enderror
                <a href="{{ route('password.request') }}" class="inline-block mt-4">Forgot Password?</a>
            </div>


        <div class="mt-2">
            @error('invalid-login', 'log-in')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

            <button type="submit" class="btn btn-info w-100 mt-3">
                Submit
            </button>

        </form>

    
    </div>

    
    <div class="flex-fill d-flex flex-column justify-content-center">

     
        <div class="register-text d-flex align-items-center justify-content-center flex-column gap-4 h-100">
            <h3 class="text-center">Haven't Registered Yet?</h3>
            <button class="btn btn-dark" id="btn-register">Register Now</button>
        </div>

        
        <div class="register-form d-none border bg-white shadow-lg rounded p-4">
            <h3 class="text-center">Register</h3>

            <form action="{{ route('auth.register') }}" method="POST" enctype="multipart/form-data">
                @csrf

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

                <button type="submit" class="btn btn-info w-100">
                    Submit
                </button>
            </form>
        </div>

    </div>

</div>


</div>

@if ($errors->register->any())
<script>
        const loginFormEL = document.querySelector('.login-form');
        const registerTextEL = document.querySelector('.register-text');
        const loginTextEL = document.querySelector('.login-text');
        const registerFormEL = document.querySelector('.register-form');
        
        loginFormEL.classList.add('d-none');
        registerTextEL.classList.add('d-none');
        registerFormEL.classList.remove('d-none');
        loginTextEL.classList.remove('d-none');
</script>
@endif

@endsection
