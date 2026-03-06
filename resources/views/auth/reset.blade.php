@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Reset Password</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  <form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ request()->token }}">
    <input type="hidden" name="email" value="{{ request()->email }}">

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Reset Password</button>
</form>
</div>
@endsection