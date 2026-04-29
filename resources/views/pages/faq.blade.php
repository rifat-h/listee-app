@extends('layouts.app')

@section('title', 'FAQ - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Frequently Asked Questions',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'FAQ']
    ]
])

<section class="faq-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-heading text-center mb-5">
                    <span class="heading-badge">FAQ</span>
                    <h2>Have Questions? We Have Answers</h2>
                    <p class="text-muted">Find answers to commonly asked questions about Listee</p>
                </div>

                {{-- FAQ Categories --}}
                <div class="faq-categories text-center mb-4">
                    <button class="faq-cat-btn active" data-target="all">All</button>
                    <button class="faq-cat-btn" data-target="general">General</button>
                    <button class="faq-cat-btn" data-target="account">Account</button>
                    <button class="faq-cat-btn" data-target="listing">Listings</button>
                    <button class="faq-cat-btn" data-target="payment">Payment</button>
                    <button class="faq-cat-btn" data-target="safety">Safety</button>
                </div>

                {{-- FAQ Accordion --}}
                <div class="accordion faq-accordion" id="faqAccordion">

                    {{-- General --}}
                    <div class="faq-item" data-category="general">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <i class="fas fa-question-circle me-2"></i> What is Listee?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Listee is Bangladesh's leading classified ads platform. It allows users to buy, sell, 
                                    and discover products and services in their local area. From electronics to vehicles, 
                                    real estate to jobs — you can find it all on Listee.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-category="general">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <i class="fas fa-question-circle me-2"></i> Is Listee free to use?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! Basic listing is completely free. You can post up to 5 ads without any cost. 
                                    We also offer premium plans for users who want enhanced visibility and additional features.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Account --}}
                    <div class="faq-item" data-category="account">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <i class="fas fa-question-circle me-2"></i> How do I create an account?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Click the "Register" button on the top right corner. Fill in your name, email, and 
                                    password. You can also sign up using your Google or Facebook account for faster registration.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-category="account">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <i class="fas fa-question-circle me-2"></i> I forgot my password. How can I reset it?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Go to the <a href="{{ route('password.request') }}">Forgot Password</a> page, enter your 
                                    registered email address, and we'll send you a password reset link. Click the link in the 
                                    email to set a new password.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-category="account">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    <i class="fas fa-question-circle me-2"></i> How do I delete my account?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Go to your Profile settings and scroll to the "Danger Zone" section. Click "Delete My Account" 
                                    to permanently remove your account and all associated data. Please note this action cannot be undone.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Listing --}}
                    <div class="faq-item" data-category="listing">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                    <i class="fas fa-question-circle me-2"></i> How do I post an ad?
                                </button>
                            </h2>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    After logging in, go to your Dashboard and click "Add New Listing". Fill in the details like 
                                    title, category, price, description, upload images, and set your location. Click "Publish" 
                                    to make your ad live.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-category="listing">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                                    <i class="fas fa-question-circle me-2"></i> How long does my ad stay active?
                                </button>
                            </h2>
                            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Free ads stay active for 30 days. Premium and Business plan ads stay active for 60 and 90 days 
                                    respectively. You can always renew your listing from your dashboard before it expires.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Payment --}}
                    <div class="faq-item" data-category="payment">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                                    <i class="fas fa-question-circle me-2"></i> What payment methods are accepted?
                                </button>
                            </h2>
                            <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We accept bKash, Nagad, Rocket, Visa, MasterCard, and bank transfers. All payments are 
                                    processed securely through our payment gateway.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-category="payment">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq9">
                                    <i class="fas fa-question-circle me-2"></i> Can I get a refund?
                                </button>
                            </h2>
                            <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we offer a 30-day money-back guarantee on all paid plans. Contact our support team 
                                    at <a href="mailto:support@listee.com">support@listee.com</a> with your payment details 
                                    to request a refund.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Safety --}}
                    <div class="faq-item" data-category="safety">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq10">
                                    <i class="fas fa-question-circle me-2"></i> How do I report a suspicious listing?
                                </button>
                            </h2>
                            <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Click the "Report" button on any listing page to flag it. Our moderation team reviews all 
                                    reports within 24 hours. You can also contact us directly at 
                                    <a href="mailto:safety@listee.com">safety@listee.com</a>.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item" data-category="safety">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq11">
                                    <i class="fas fa-question-circle me-2"></i> Tips for safe buying & selling?
                                </button>
                            </h2>
                            <div id="faq11" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Always meet in a public, well-lit place</li>
                                        <li>Inspect items before paying</li>
                                        <li>Never share bank/mobile banking PINs</li>
                                        <li>Use cash-on-delivery when possible</li>
                                        <li>Check seller's reviews and profile</li>
                                        <li>If a deal seems too good to be true, it probably is</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Still Have Questions --}}
                <div class="faq-contact text-center mt-5">
                    <h5>Still Have Questions?</h5>
                    <p class="text-muted">Can't find the answer you're looking for? Get in touch with our team.</p>
                    <a href="{{ route('contact') }}" class="btn btn-faq-contact">
                        <i class="fas fa-envelope me-1"></i> Contact Support
                    </a>
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
.faq-categories {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
}
.faq-cat-btn {
    padding: 7px 18px;
    border-radius: 20px;
    border: 1px solid #e0e0e0;
    background: #fff;
    color: #666;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
}
.faq-cat-btn.active,
.faq-cat-btn:hover {
    background: #FF3B30;
    color: #fff;
    border-color: #FF3B30;
}
.faq-accordion .accordion-item {
    border: 1px solid #e8e8e8;
    border-radius: 8px !important;
    margin-bottom: 10px;
    overflow: hidden;
}
.faq-accordion .accordion-button {
    font-weight: 600;
    font-size: 14px;
    color: #333;
    padding: 15px 20px;
}
.faq-accordion .accordion-button:not(.collapsed) {
    background: #FFF5F5;
    color: #FF3B30;
    box-shadow: none;
}
.faq-accordion .accordion-button::after {
    background-size: 14px;
}
.faq-accordion .accordion-button:focus {
    box-shadow: none;
}
.faq-accordion .accordion-button .fa-question-circle {
    color: #FF3B30;
}
.faq-accordion .accordion-body {
    font-size: 14px;
    color: #666;
    line-height: 1.7;
    padding: 15px 20px;
}
.faq-accordion .accordion-body a {
    color: #FF3B30;
}
.faq-accordion .accordion-body ul {
    padding-left: 20px;
    margin: 0;
}
.faq-accordion .accordion-body ul li {
    margin-bottom: 5px;
}
.faq-contact h5 {
    font-size: 18px;
    font-weight: 600;
}
.btn-faq-contact {
    background: #FF3B30;
    color: #fff;
    padding: 10px 25px;
    border-radius: 8px;
    font-weight: 600;
    margin-top: 10px;
}
.btn-faq-contact:hover {
    background: #E0352B;
    color: #fff;
}
</style>

@push('scripts')
<script>
document.querySelectorAll('.faq-cat-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.faq-cat-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        var target = this.dataset.target;
        document.querySelectorAll('.faq-item').forEach(function(item) {
            if (target === 'all' || item.dataset.category === target) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endpush

@endsection