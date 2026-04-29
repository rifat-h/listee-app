@extends('layouts.app')

@section('title', '500 - Server Error | Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => '500 - Server Error',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => '500 Error']
    ]
])

<section class="error-page-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="error-content-box text-center">

                    {{-- Error Illustration --}}
                    <div class="error-illustration">
                        <div class="error-code-display">
                            <span class="digit">5</span>
                            <span class="digit gear-digit">
                                <i class="fas fa-cog fa-spin"></i>
                            </span>
                            <span class="digit">0</span>
                        </div>
                    </div>

                    {{-- Error Info --}}
                    <h2 class="error-heading">Internal Server Error</h2>
                    <p class="error-message">
                        দুঃখিত! সার্ভারে একটি সমস্যা হয়েছে। আমরা এটি ঠিক করার চেষ্টা করছি।
                        অনুগ্রহ করে কিছুক্ষণ পর আবার চেষ্টা করুন।
                    </p>

                    {{-- Status Indicator --}}
                    <div class="server-status-box">
                        <div class="status-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="status-info">
                            <span class="status-label">Server Status</span>
                            <span class="status-value">Temporarily Unavailable</span>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="error-action-btns">
                        <a href="{{ url('/') }}" class="btn btn-primary btn-error">
                            <i class="fas fa-home me-2"></i> Go to Homepage
                        </a>
                        <a href="javascript:location.reload();" class="btn btn-outline-primary btn-error">
                            <i class="fas fa-redo me-2"></i> Try Again
                        </a>
                    </div>

                    {{-- Help Links --}}
                    <div class="error-help-links">
                        <p class="help-text">সাহায্য দরকার?</p>
                        <div class="help-links-row">
                            <a href="{{ url('/contact') }}" class="help-link">
                                <i class="fas fa-envelope"></i> Contact Support
                            </a>
                            <a href="{{ url('/faq') }}" class="help-link">
                                <i class="fas fa-question-circle"></i> FAQ
                            </a>
                            <a href="{{ url('/') }}" class="help-link">
                                <i class="fas fa-list"></i> Browse Listings
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Error Page Section */
.error-page-section {
    min-height: 65vh;
    display: flex;
    align-items: center;
}
.error-content-box {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 20px;
    padding: 50px 40px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.04);
}

/* Error Code Display */
.error-code-display {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
    margin-bottom: 30px;
}
.error-code-display .digit {
    font-size: 110px;
    font-weight: 800;
    color: #FF3B30;
    line-height: 1;
    text-shadow: 2px 4px 8px rgba(255, 59, 48, 0.15);
}
.gear-digit {
    display: flex;
    align-items: center;
    justify-content: center;
}
.gear-digit i {
    font-size: 90px;
    color: #FF3B30;
    animation: spin 3s linear infinite;
}
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Error Info */
.error-heading {
    font-size: 28px;
    font-weight: 700;
    color: #1b2a4a;
    margin-bottom: 12px;
}
.error-message {
    font-size: 15px;
    color: #6c757d;
    line-height: 1.8;
    max-width: 420px;
    margin: 0 auto 25px;
}

/* Server Status Box */
.server-status-box {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: #fff5f5;
    border: 1px solid #ffe0e0;
    border-radius: 12px;
    padding: 14px 24px;
    margin-bottom: 30px;
}
.status-icon {
    width: 42px;
    height: 42px;
    background: #FF3B30;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.status-icon i {
    color: #fff;
    font-size: 18px;
}
.status-info {
    text-align: left;
}
.status-label {
    display: block;
    font-size: 11px;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.status-value {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #FF3B30;
}

/* Action Buttons */
.error-action-btns {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}
.btn-error {
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}
.btn-error:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.12);
}
.error-action-btns .btn-primary {
    background: #FF3B30;
    border: none;
}
.error-action-btns .btn-primary:hover {
    background: #D62828;
}
.error-action-btns .btn-outline-primary {
    color: #FF3B30;
    border-color: #FF3B30;
}
.error-action-btns .btn-outline-primary:hover {
    background: #FF3B30;
    color: #fff;
}

/* Help Links */
.error-help-links {
    border-top: 1px solid #f0f0f0;
    padding-top: 25px;
}
.help-text {
    font-size: 13px;
    color: #999;
    margin-bottom: 12px;
}
.help-links-row {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}
.help-link {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #555;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    padding: 8px 16px;
    background: #f8f9fa;
    border-radius: 8px;
    transition: all 0.3s;
}
.help-link:hover {
    background: #FF3B30;
    color: #fff;
}
.help-link i {
    font-size: 14px;
}

/* Responsive */
@media (max-width: 576px) {
    .error-content-box {
        padding: 30px 20px;
    }
    .error-code-display .digit {
        font-size: 70px;
    }
    .gear-digit i {
        font-size: 55px;
    }
    .error-heading {
        font-size: 22px;
    }
    .error-action-btns {
        flex-direction: column;
    }
    .error-action-btns .btn-error {
        width: 100%;
    }
    .help-links-row {
        flex-direction: column;
        align-items: center;
    }
}
</style>

@endsection