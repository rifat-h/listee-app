@extends('layouts.app')

@section('title', 'How It Works - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'How It Works',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'How It Works']
    ]
])

<section class="how-it-works-page py-5">
    <div class="container">

        {{-- Main Steps Section --}}
        <div class="section-header text-center mb-5">
            <span class="section-tag">How It Works</span>
            <h2>Post Your Ad in 3 Simple Steps</h2>
            <p class="text-muted">It's easy to get started. Follow these simple steps to buy or sell on Listee.</p>
        </div>

        <div class="row steps-row mb-5">
            {{-- Step 1 --}}
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="step-card text-center">
                    <div class="step-number">01</div>
                    <div class="step-icon step-icon-red">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h4>Create an Account</h4>
                    <p>Sign up for free using your email or social media accounts. It only takes a few seconds to get started.</p>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="step-card text-center">
                    <div class="step-number">02</div>
                    <div class="step-icon step-icon-blue">
                        <i class="fas fa-ad"></i>
                    </div>
                    <h4>Post Your Ad</h4>
                    <p>Create your listing with detailed information, photos, and pricing. Select the right category and publish your ad.</p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="step-card text-center">
                    <div class="step-number">03</div>
                    <div class="step-icon step-icon-green">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4>Find a Buyer & Sell</h4>
                    <p>Interested buyers will contact you directly. Communicate via message or phone and complete the deal.</p>
                </div>
            </div>
        </div>

        {{-- Connecting Line Between Steps (Desktop) --}}
        <div class="steps-connector d-none d-md-block"></div>

        {{-- Why Choose Us Section --}}
        <div class="why-choose-section mt-5 pt-5">
            <div class="section-header text-center mb-5">
                <span class="section-tag">Why Choose Us</span>
                <h2>Benefits of Using Listee</h2>
                <p class="text-muted">Discover what makes Listee the best platform for classified ads.</p>
            </div>

            <div class="row">
                {{-- Feature 1 --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon feature-icon-red">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Fast & Easy</h5>
                            <p>Post your ad in just a few minutes with our simple and intuitive interface.</p>
                        </div>
                    </div>
                </div>

                {{-- Feature 2 --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon feature-icon-blue">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Safe & Trusted</h5>
                            <p>Verified users and secure communication system for safe transactions.</p>
                        </div>
                    </div>
                </div>

                {{-- Feature 3 --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon feature-icon-green">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Free Listings</h5>
                            <p>Post your ads absolutely free. No hidden charges for basic listings.</p>
                        </div>
                    </div>
                </div>

                {{-- Feature 4 --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon feature-icon-orange">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Large Network</h5>
                            <p>Reach thousands of potential buyers and sellers across the country.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- For Buyers & Sellers Section --}}
        <div class="buyer-seller-section mt-5 pt-4">
            <div class="row">
                {{-- For Buyers --}}
                <div class="col-lg-6 mb-4">
                    <div class="bs-card bs-card-buyer">
                        <div class="bs-card-header">
                            <i class="fas fa-shopping-bag"></i>
                            <h4>For Buyers</h4>
                        </div>
                        <ul class="bs-list">
                            <li><i class="fas fa-check-circle"></i> Browse thousands of listings across multiple categories</li>
                            <li><i class="fas fa-check-circle"></i> Use advanced filters to find exactly what you need</li>
                            <li><i class="fas fa-check-circle"></i> Contact sellers directly via messaging</li>
                            <li><i class="fas fa-check-circle"></i> Save your favorite listings for later</li>
                            <li><i class="fas fa-check-circle"></i> Get alerts for new listings in your interest</li>
                        </ul>
                    </div>
                </div>

                {{-- For Sellers --}}
                <div class="col-lg-6 mb-4">
                    <div class="bs-card bs-card-seller">
                        <div class="bs-card-header">
                            <i class="fas fa-store"></i>
                            <h4>For Sellers</h4>
                        </div>
                        <ul class="bs-list">
                            <li><i class="fas fa-check-circle"></i> Post unlimited free classified ads</li>
                            <li><i class="fas fa-check-circle"></i> Upload multiple photos for each listing</li>
                            <li><i class="fas fa-check-circle"></i> Manage all your listings from your dashboard</li>
                            <li><i class="fas fa-check-circle"></i> Get featured placement with premium plans</li>
                            <li><i class="fas fa-check-circle"></i> Track views and inquiries for your ads</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- FAQ Section --}}
        <div class="faq-section mt-5 pt-4">
            <div class="section-header text-center mb-4">
                <span class="section-tag">FAQ</span>
                <h2>Frequently Asked Questions</h2>
            </div>

            <div class="faq-container" style="max-width: 800px; margin: 0 auto;">
                {{-- FAQ 1 --}}
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Is it free to post an ad on Listee?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, basic ad posting on Listee is completely free. However, we offer premium plans for featured listings that get more visibility and reach more buyers.</p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How long does my ad stay active?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>A listing stays active for 30 days. You can renew it after expiry from your dashboard.</p>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I edit or delete my ad?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Go to your Dashboard → My Listings. From there you can edit, renew, or delete any of your ads.</p>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How does payment work?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Buyers and sellers deal directly with each other. Listee is not a payment mediator. We recommend meeting in safe public places for transactions.</p>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Can I promote my listing for more visibility?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! You can upgrade your listing to "Featured" status through our premium plans. Featured ads appear at the top of search results and category pages.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA Section --}}
        <div class="cta-section mt-5">
            <div class="cta-box text-center">
                <h3>Ready to Get Started?</h3>
                <p>Join thousands of users who buy and sell on Listee every day!</p>
                <div class="cta-buttons">
                    <a href="{{ route('register') }}" class="btn btn-white btn-lg me-2">
                        <i class="fas fa-user-plus me-1"></i> Sign Up Free
                    </a>
                    <a href="{{ route('user.add-listing') }}" class="btn btn-outline-white btn-lg">
                        <i class="fas fa-plus me-1"></i> Post an Ad
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
/* Section Header */
.section-tag {
    display: inline-block;
    background: #FFF5F5;
    color: #FF3B30;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}
.section-header h2 {
    font-size: 30px;
    font-weight: 700;
    color: #1b2a4a;
    margin-bottom: 10px;
}
.section-header p {
    max-width: 550px;
    margin: 0 auto;
    font-size: 15px;
}

/* Step Cards */
.step-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 15px;
    padding: 40px 25px;
    position: relative;
    transition: all 0.3s;
    height: 100%;
}
.step-card:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transform: translateY(-5px);
}
.step-number {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 42px;
    font-weight: 800;
    color: rgba(0,0,0,0.04);
}
.step-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.step-icon i {
    font-size: 30px;
}
.step-icon-red {
    background: linear-gradient(135deg, #FFF5F5, #FFE0E3);
}
.step-icon-red i { color: #FF3B30; }
.step-icon-blue {
    background: linear-gradient(135deg, #F0F4FF, #DCE4FF);
}
.step-icon-blue i { color: #3B82F6; }
.step-icon-green {
    background: linear-gradient(135deg, #F0FFF4, #D1FAE5);
}
.step-icon-green i { color: #10B981; }
.step-card h4 {
    font-size: 20px;
    font-weight: 700;
    color: #1b2a4a;
    margin-bottom: 10px;
}
.step-card p {
    color: #6c757d;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
}

/* Feature Cards */
.feature-card {
    display: flex;
    gap: 15px;
    padding: 25px;
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 12px;
    transition: all 0.3s;
    height: 100%;
}
.feature-card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.06);
}
.feature-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.feature-icon i { font-size: 20px; }
.feature-icon-red { background: #FFF5F5; }
.feature-icon-red i { color: #FF3B30; }
.feature-icon-blue { background: #F0F4FF; }
.feature-icon-blue i { color: #3B82F6; }
.feature-icon-green { background: #F0FFF4; }
.feature-icon-green i { color: #10B981; }
.feature-icon-orange { background: #FFF8F0; }
.feature-icon-orange i { color: #F59E0B; }
.feature-content h5 {
    font-size: 16px;
    font-weight: 600;
    color: #1b2a4a;
    margin-bottom: 6px;
}
.feature-content p {
    font-size: 13px;
    color: #6c757d;
    margin: 0;
    line-height: 1.5;
}

/* Buyer/Seller Cards */
.bs-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 15px;
    padding: 30px;
    height: 100%;
}
.bs-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
}
.bs-card-header i {
    font-size: 24px;
}
.bs-card-buyer .bs-card-header i { color: #3B82F6; }
.bs-card-seller .bs-card-header i { color: #10B981; }
.bs-card-header h4 {
    font-size: 20px;
    font-weight: 700;
    color: #1b2a4a;
    margin: 0;
}
.bs-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.bs-list li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 10px 0;
    font-size: 14px;
    color: #555;
    border-bottom: 1px solid #f5f5f5;
}
.bs-list li:last-child { border-bottom: none; }
.bs-list li i {
    color: #10B981;
    margin-top: 3px;
    flex-shrink: 0;
}

/* FAQ Section */
.faq-item {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    margin-bottom: 12px;
    overflow: hidden;
}
.faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 20px;
    cursor: pointer;
    font-weight: 600;
    font-size: 15px;
    color: #1b2a4a;
    transition: background 0.3s;
}
.faq-question:hover {
    background: #f9f9f9;
}
.faq-question i {
    font-size: 12px;
    color: #999;
    transition: transform 0.3s;
}
.faq-question.active i {
    transform: rotate(180deg);
    color: #FF3B30;
}
.faq-answer {
    display: none;
    padding: 0 20px 18px;
}
.faq-answer p {
    color: #6c757d;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
}

/* CTA Section */
.cta-box {
    background: linear-gradient(135deg, #FF3B30, #D62828);
    border-radius: 15px;
    padding: 50px 30px;
}
.cta-box h3 {
    color: #fff;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
}
.cta-box p {
    color: rgba(255,255,255,0.85);
    font-size: 16px;
    margin-bottom: 25px;
}
.cta-buttons {
    display: flex;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
}
.btn-white {
    background: #fff;
    color: #FF3B30;
    border: none;
    font-weight: 600;
    border-radius: 8px;
    padding: 12px 25px;
}
.btn-white:hover {
    background: #f8f8f8;
    color: #D62828;
}
.btn-outline-white {
    background: transparent;
    color: #fff;
    border: 2px solid #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 12px 25px;
}
.btn-outline-white:hover {
    background: #fff;
    color: #FF3B30;
}

/* Responsive */
@media (max-width: 768px) {
    .section-header h2 { font-size: 24px; }
    .cta-box { padding: 35px 20px; }
    .cta-box h3 { font-size: 22px; }
}
</style>

@endsection

@push('scripts')
<script>
function toggleFaq(element) {
    const faqItem = element.parentElement;
    const answer = faqItem.querySelector('.faq-answer');
    const allItems = document.querySelectorAll('.faq-item');

    allItems.forEach(item => {
        if (item !== faqItem) {
            item.querySelector('.faq-answer').style.display = 'none';
            item.querySelector('.faq-question').classList.remove('active');
        }
    });

    if (answer.style.display === 'block') {
        answer.style.display = 'none';
        element.classList.remove('active');
    } else {
        answer.style.display = 'block';
        element.classList.add('active');
    }
}
</script>
@endpush