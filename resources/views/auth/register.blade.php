@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f5f7fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    .login-card-header {
        background-color: #28a745;
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        text-align: center;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        padding: 1.5rem;
    }
    .login-btn {
        background-color: #28a745;
        border: none;
        font-weight: 600;
        transition: 0.3s ease;
    }
    .login-btn:hover {
        background-color: #218838;
    }
    .form-check-label {
        font-size: 0.9rem;
    }
</style>

<div class="login-wrapper">
    <div class="col-md-6 col-lg-5">
        <div class="card login-card">
            <div class="login-card-header">Create Your Account</div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email Address</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" required>
                        @error('password')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password"
                            class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="form-group mt-4 mb-2 d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-success login-btn px-4">
                            Register
                        </button>

                        <a class="text-muted small" href="{{ route('login') }}">
                            Already have an account?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
