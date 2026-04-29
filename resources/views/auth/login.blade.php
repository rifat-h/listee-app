@extends('layouts.app')

@section('title', 'Login - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Login',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Login']
    ]
])

<section class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="login-card bg-white rounded shadow p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Welcome Back</h3>
                        <p class="text-danger">Please Enter your Details</p>
                    </div>

                    <!-- Session Status -->
                    @if(session('status'))
                        <div class="alert alert-success mb-3">{{ session('status') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger mb-3">
                            @foreach($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email Address"
                                       value="{{ old('email') }}" required autofocus autocomplete="username">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" id="loginPassword" class="form-control"
                                       placeholder="Password" required autocomplete="current-password">
                                <span class="input-group-text bg-white toggle-password" role="button" onclick="togglePassword()">
                                    <i class="fas fa-eye text-muted" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label" for="remember_me">Remember Me</label>
                            </div>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-danger text-decoration-none small">Forgot password?</a>
                            @endif
                        </div>

                        <!-- Sign In Button -->
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold mb-3">Sign in</button>
                    </form>

                    <!-- Signup Link -->
                    <p class="text-center mb-3">
                        No account yet?
                        <a href="{{ route('register') }}" class="text-danger fw-bold text-decoration-none">Signup</a>
                    </p>

                    <!-- Divider -->
                    <div class="divider-text text-center my-3">
                        <span class="text-muted small">Sign in with Social Media Accounts</span>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="social-login">
                        <button type="button" class="btn btn-dark w-100 mb-2 py-2">
                            <i class="fab fa-apple me-2"></i> Sign in with Apple
                        </button>
                        <button type="button" class="btn btn-outline-secondary w-100 mb-2 py-2">
                            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" width="18" class="me-2">
                            Sign in with Google
                        </button>
                        <button type="button" class="btn btn-primary w-100 py-2" style="background-color: #1877F2; border-color: #1877F2;">
                            <i class="fab fa-facebook-f me-2"></i> Continue with Facebook
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.login-section {
    background-color: #f8f9fa;
}
.login-card {
    border: none;
}
.login-card .input-group-text {
    border-right: none;
}
.login-card .input-group .form-control {
    border-left: none;
}
.login-card .input-group .form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
.login-card .input-group-text.toggle-password {
    border-left: none;
    cursor: pointer;
}
.divider-text {
    position: relative;
}
.divider-text::before,
.divider-text::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 25%;
    height: 1px;
    background: #dee2e6;
}
.divider-text::before {
    left: 0;
}
.divider-text::after {
    right: 0;
}
</style>
@endpush

@push('scripts')
<script>
function togglePassword() {
    var passwordInput = document.getElementById('loginPassword');
    var icon = document.getElementById('togglePasswordIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush
