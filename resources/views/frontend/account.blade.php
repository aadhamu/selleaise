@extends('layout.frontend')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Account</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Account</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Login Or Register</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
{{-- 
<style>
    body {
        
    }


    .toggle-form a {
        
    }

    .toggle-form a:hover {
        
    }
</style> --}}

<div class="body" style="
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 65vh;">

<div class="form-container" style="width: 400px;
        padding: 30px;
        border-radius: 8px;
        background-color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
    <!-- Login Form -->
    <div id="login-form">
        <h2 style="text-align: center;
        margin-bottom: 20px;
        font-size: 24px;">Login</h2>
        <form>
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" class="form-control" id="login-email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input type="password" class="form-control" id="login-password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="toggle-form" style="text-align: center;
        margin-top: 15px;">
            <p>Don't have an account? <a href="#" onclick="toggleForm('signup')" style="color: #007BFF;
        text-decoration: none hover:text-decoration: underline;">Sign up</a></p>
        </div>
    </div>

    <!-- Signup Form -->
    <div id="signup-form" style="display:none;">
        <h2>Sign Up</h2>
        <form>
            <div class="form-group">
                <label for="signup-name">Full Name</label>
                <input type="text" class="form-control" id="signup-name" name="f-name" required>
            </div>
            <div class="form-group">
                <label for="signup-email">Email</label>
                <input type="email" class="form-control" id="signup-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="signup-password">Password</label>
                <input type="password" class="form-control" id="signup-password" name="password" required>
            </div>
            <div class="form-group">
                <label for="signup-password"> confirm Password</label>
                <input type="password" class="form-control" id="signup-password" name="c-password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        </form>
        <div class="toggle-form pt-3">
            <p>Already have an account? <a href="#" onclick="toggleForm('login')">Login</a></p>
        </div>
    </div>
</div>
</div>


@endsection