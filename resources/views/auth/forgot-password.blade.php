@extends('layouts.app')

@section('title', 'Forget Your Passwords - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Forget Your Passwords',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Forget Your Passwords']
    ]
])

<section class="forgot-password-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="forgot-password-card bg-white rounded shadow p-4 p-md-5">

                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Forget Your Passwords!</h3>
                        <p class="text-danger">Please Enter your Email</p>
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

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email Address"
                                       value="{{ old('email') }}" required autofocus autocomplete="username">
                            </div>
                        </div>

                        <!-- Reset Button -->
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold mb-3">Reset Your Email Address</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
.forgot-password-section {
    background-color: #f8f9fa;
}
.forgot-password-card {
    border: none;
}
.forgot-password-card .input-group-text {
    border-right: none;
}
.forgot-password-card .input-group .form-control {
    border-left: none;
}
.forgot-password-card .input-group .form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
</style>
@endpush
