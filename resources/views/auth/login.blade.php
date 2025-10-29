@extends('auth.layout.app')

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary">Login</button>
        </div>

        <div class="text-center mt-3">
            <small>
                Don't have an account?
                <a href="{{ route('registerForm') }}" class="text-decoration-none">Register</a>
            </small>
        </div>
    </form>
@endsection
