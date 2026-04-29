@extends('layouts.app')

@section('title', 'Pricing Plans - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Pricing Plans',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Pricing']
    ]
])

<section class="pricing-section py-5">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <span class="heading-badge">Pricing</span>
            <h2>Choose Your Perfect Plan</h2>
            <p class="text-muted">Select a plan that suits your needs. Upgrade or downgrade anytime.</p>
        </div>

        {{-- Toggle Monthly/Yearly --}}
        <div class="pricing-toggle text-center mb-5">
            <span class="toggle-label" id="monthlyLabel">Monthly</span>
            <label class="switch">
                <input type="checkbox" id="pricingToggle">
                <span class="slider round"></span>
            </label>
            <span class="toggle-label" id="yearlyLabel">Yearly</span>
            <span class="save-badge">Save 20%</span>
        </div>

        <div class="row justify-content-center">
            {{-- Free Plan --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <div class="plan-icon">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <h4>Free</h4>
                        <p class="plan-subtitle">For individuals getting started</p>
                    </div>
                    <div class="pricing-price">
                        <h2>
                            <span class="currency">৳</span>
                            <span class="amount monthly-price">0</span>
                            <span class="amount yearly-price" style="display:none;">0</span>
                        </h2>
                        <span class="period monthly-period">/ month</span>
                        <span class="period yearly-period" style="display:none;">/ year</span>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> 5 Active Listings</li>
                        <li><i class="fas fa-check"></i> Basic Support</li>
                        <li><i class="fas fa-check"></i> Standard Visibility</li>
                        <li><i class="fas fa-check"></i> 3 Images per Listing</li>
                        <li class="disabled"><i class="fas fa-times"></i> Featured Listings</li>
                        <li class="disabled"><i class="fas fa-times"></i> Priority Support</li>
                        <li class="disabled"><i class="fas fa-times"></i> Analytics Dashboard</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-pricing-outline">Get Started</a>
                </div>
            </div>

            {{-- Pro Plan --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card popular">
                    <div class="popular-badge">Most Popular</div>
                    <div class="pricing-header">
                        <div class="plan-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4>Professional</h4>
                        <p class="plan-subtitle">For sellers & small businesses</p>
                    </div>
                    <div class="pricing-price">
                        <h2>
                            <span class="currency">৳</span>
                            <span class="amount monthly-price">499</span>
                            <span class="amount yearly-price" style="display:none;">4,790</span>
                        </h2>
                        <span class="period monthly-period">/ month</span>
                        <span class="period yearly-period" style="display:none;">/ year</span>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> 50 Active Listings</li>
                        <li><i class="fas fa-check"></i> Priority Support</li>
                        <li><i class="fas fa-check"></i> Enhanced Visibility</li>
                        <li><i class="fas fa-check"></i> 10 Images per Listing</li>
                        <li><i class="fas fa-check"></i> 5 Featured Listings/month</li>
                        <li><i class="fas fa-check"></i> Analytics Dashboard</li>
                        <li class="disabled"><i class="fas fa-times"></i> API Access</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-pricing-primary">Get Started</a>
                </div>
            </div>

            {{-- Business Plan --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <div class="plan-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h4>Business</h4>
                        <p class="plan-subtitle">For agencies & large businesses</p>
                    </div>
                    <div class="pricing-price">
                        <h2>
                            <span class="currency">৳</span>
                            <span class="amount monthly-price">1,499</span>
                            <span class="amount yearly-price" style="display:none;">14,390</span>
                        </h2>
                        <span class="period monthly-period">/ month</span>
                        <span class="period yearly-period" style="display:none;">/ year</span>
                    </div>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check"></i> Unlimited Listings</li>
                        <li><i class="fas fa-check"></i> 24/7 Dedicated Support</li>
                        <li><i class="fas fa-check"></i> Maximum Visibility</li>
                        <li><i class="fas fa-check"></i> Unlimited Images</li>
                        <li><i class="fas fa-check"></i> Unlimited Featured Listings</li>
                        <li><i class="fas fa-check"></i> Advanced Analytics</li>
                        <li><i class="fas fa-check"></i> API Access</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-pricing-outline">Contact Sales</a>
                </div>
            </div>
        </div>

        {{-- FAQ --}}
        <div class="pricing-faq mt-5">
            <h4 class="text-center mb-4">Frequently Asked Questions</h4>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="pricingFaq">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Can I change my plan later?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#pricingFaq">
                                <div class="accordion-body">
                                    Yes! You can upgrade or downgrade your plan at any time. Changes take effect at the start of your next billing cycle.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Is there a free trial for paid plans?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                                <div class="accordion-body">
                                    Yes, all paid plans come with a 7-day free trial. No credit card required to start.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    What payment methods do you accept?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                                <div class="accordion-body">
                                    We accept bKash, Nagad, Rocket, credit/debit cards (Visa, MasterCard), and bank transfers.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Can I get a refund?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                                <div class="accordion-body">
                                    We offer a 30-day money-back guarantee on all paid plans. If you're not satisfied, contact our support team for a full refund.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.heading-badge {
    display: inline-block;
    background: #FFF5F5;
    color: #FF3B30;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 15px;
}
.section-heading h2 {
    font-size: 28px;
    font-weight: 700;
}
.pricing-toggle {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.toggle-label {
    font-size: 14px;
    font-weight: 600;
    color: #888;
}
.toggle-label.active {
    color: #333;
}
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}
.switch input { opacity: 0; width: 0; height: 0; }
.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
}
.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.4s;
}
input:checked + .slider { background-color: #FF3B30; }
input:checked + .slider:before { transform: translateX(24px); }
.slider.round { border-radius: 26px; }
.slider.round:before { border-radius: 50%; }
.save-badge {
    background: #ECFDF5;
    color: #10B981;
    font-size: 11px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 12px;
}
.pricing-card {
    background: #fff;
    border: 2px solid #e8e8e8;
    border-radius: 15px;
    padding: 35px 25px;
    text-align: center;
    transition: all 0.3s;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
}
.pricing-card.popular {
    border-color: #FF3B30;
    transform: scale(1.05);
}
.pricing-card.popular:hover {
    transform: scale(1.05) translateY(-5px);
}
.popular-badge {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: #FF3B30;
    color: #fff;
    padding: 4px 18px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.plan-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #FFF5F5;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
}
.plan-icon i {
    font-size: 22px;
    color: #FF3B30;
}
.pricing-header h4 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 5px;
}
.plan-subtitle {
    font-size: 13px;
    color: #888;
}
.pricing-price {
    padding: 20px 0;
    border-bottom: 1px solid #f0f0f0;
    margin-bottom: 20px;
}
.pricing-price h2 {
    font-size: 42px;
    font-weight: 700;
    color: #333;
    margin: 0;
}
.pricing-price .currency {
    font-size: 20px;
    vertical-align: top;
    margin-right: 2px;
}
.pricing-price .period {
    font-size: 13px;
    color: #aaa;
}
.pricing-features {
    list-style: none;
    padding: 0;
    margin: 0 0 25px;
    text-align: left;
    flex-grow: 1;
}
.pricing-features li {
    padding: 8px 0;
    font-size: 14px;
    color: #555;
    border-bottom: 1px solid #f8f8f8;
}
.pricing-features li i {
    width: 20px;
    text-align: center;
    margin-right: 8px;
}
.pricing-features li .fa-check {
    color: #10B981;
}
.pricing-features li.disabled {
    color: #ccc;
}
.pricing-features li.disabled .fa-times {
    color: #ccc;
}
.btn-pricing-primary {
    background: #FF3B30;
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    width: 100%;
    transition: background 0.3s;
}
.btn-pricing-primary:hover {
    background: #E0352B;
    color: #fff;
}
.btn-pricing-outline {
    border: 2px solid #FF3B30;
    color: #FF3B30;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    width: 100%;
    background: transparent;
    transition: all 0.3s;
}
.btn-pricing-outline:hover {
    background: #FF3B30;
    color: #fff;
}
.pricing-faq .accordion-item {
    border: 1px solid #e8e8e8;
    border-radius: 8px !important;
    margin-bottom: 10px;
    overflow: hidden;
}
.pricing-faq .accordion-button {
    font-weight: 600;
    font-size: 14px;
    color: #333;
}
.pricing-faq .accordion-button:not(.collapsed) {
    background: #FFF5F5;
    color: #FF3B30;
}
.pricing-faq .accordion-button:focus {
    box-shadow: none;
}
.pricing-faq .accordion-body {
    font-size: 13px;
    color: #666;
    line-height: 1.7;
}
</style>

@push('scripts')
<script>
document.getElementById('pricingToggle')?.addEventListener('change', function() {
    var isYearly = this.checked;
    document.querySelectorAll('.monthly-price, .monthly-period').forEach(el => el.style.display = isYearly ? 'none' : '');
    document.querySelectorAll('.yearly-price, .yearly-period').forEach(el => el.style.display = isYearly ? '' : 'none');
    document.getElementById('monthlyLabel').classList.toggle('active', !isYearly);
    document.getElementById('yearlyLabel').classList.toggle('active', isYearly);
});
document.getElementById('monthlyLabel')?.classList.add('active');
</script>
@endpush

@endsection