@extends('layouts.app')

@section('title', 'Create an Account - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Create an Account',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Register']
    ]
])

<section class="register-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="register-card bg-white rounded shadow p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Create an Account</h3>
                        <p>Lets start with <span class="text-danger fw-bold">Listee</span></p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger mb-3">
                            @foreach($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" name="name" class="form-control" placeholder="Full Name"
                                       value="{{ old('name') }}" required autofocus autocomplete="name">
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email Address"
                                       value="{{ old('email') }}" required autocomplete="username">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" id="registerPassword" class="form-control"
                                       placeholder="Password" required autocomplete="new-password">
                                <span class="input-group-text bg-white toggle-password" role="button" onclick="toggleRegisterPassword()">
                                    <i class="fas fa-eye text-muted" id="toggleRegisterPasswordIcon"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Create Account Button -->
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold mb-3">Create Account</button>
                    </form>

                    <!-- Sign In Link -->
                    <p class="text-center mb-3">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-danger fw-bold text-decoration-none">Sign In</a>
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
                        <button type="button" class="btn w-100 py-2 text-white" style="background-color: #1877F2; border-color: #1877F2;">
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
.register-section {
    background-color: #f8f9fa;
}
.register-card {
    border: none;
}
.register-card .input-group-text {
    border-right: none;
}
.register-card .input-group .form-control {
    border-left: none;
}
.register-card .input-group .form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
.register-card .input-group-text.toggle-password {
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
function toggleRegisterPassword() {
    var passwordInput = document.getElementById('registerPassword');
    var icon = document.getElementById('toggleRegisterPasswordIcon');
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
