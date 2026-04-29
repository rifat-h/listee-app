@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="breadcrumb-title">404 - Page Not Found</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">404</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Error Section -->
<section class="error-section section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="error-wrap text-center">
                    <div class="error-img mb-4">
                        <img src="{{ asset('assets/img/error-404.png') }}" alt="404 Error" class="img-fluid">
                    </div>
                    <h2 class="error-title">404</h2>
                    <h3>Oops! Page Not Found</h3>
                    <p class="error-description">
                        দুঃখিত! আপনি যে পেজটি খুঁজছেন সেটি পাওয়া যায়নি। 
                        পেজটি সরানো হয়েছে, মুছে ফেলা হয়েছে, অথবা URL ভুল হতে পারে।
                    </p>
                    <div class="error-actions mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fa-solid fa-house me-2"></i>Go Back to Home
                        </a>
                        <a href="{{ route('listings.grid') }}" class="btn btn-outline-primary ms-2">
                            <i class="fa-solid fa-list me-2"></i>Browse Listings
                        </a>
                    </div>
                    <!-- Search Box -->
                    <div class="error-search mt-4">
                        <p class="mb-2">অথবা এখানে সার্চ করুন:</p>
                        <form action="{{ route('listings.grid') }}" method="GET" class="d-flex justify-content-center">
                            <div class="input-group" style="max-width: 450px;">
                                <input type="text" name="keyword" class="form-control" placeholder="Search listings...">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Error Section -->
@endsection

@push('styles')
<style>
    .error-section {
        padding: 80px 0;
        min-height: 60vh;
        display: flex;
        align-items: center;
    }
    .error-wrap {
        padding: 40px 20px;
    }
    .error-title {
        font-size: 120px;
        font-weight: 800;
        color: #e74c3c;
        line-height: 1;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .error-wrap h3 {
        font-size: 28px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }
    .error-description {
        font-size: 16px;
        color: #666;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.8;
    }
    .error-img img {
        max-width: 300px;
    }
    .error-actions .btn {
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .error-actions .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }
    .error-search .form-control {
        border-radius: 8px 0 0 8px;
        padding: 12px 20px;
        border: 2px solid #e0e0e0;
    }
    .error-search .form-control:focus {
        border-color: #4c82f7;
        box-shadow: none;
    }
    .error-search .btn {
        border-radius: 0 8px 8px 0;
        padding: 12px 20px;
    }
    @media (max-width: 576px) {
        .error-title {
            font-size: 80px;
        }
        .error-wrap h3 {
            font-size: 22px;
        }
        .error-actions .btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        .error-actions .btn.ms-2 {
            margin-left: 0 !important;
        }
    }
</style>
@endpush