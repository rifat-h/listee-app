@extends('layouts.app')

@section('title', 'Terms & Conditions - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Terms & Conditions',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Terms & Conditions']
    ]
])

<section class="terms-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="terms-content-box">

                    <div class="terms-updated mb-4">
                        <i class="far fa-calendar-alt me-1"></i> Last Updated: {{ date('d F, Y') }}
                    </div>

                    {{-- Section 1 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">01</span> Introduction</h2>
                        <p>Welcome to Listee ("Website"). By accessing or using this website, you agree to be bound by these Terms and Conditions. Please read them carefully before using our services. If you do not agree with any part of these terms, please do not use this website.</p>
                    </div>

                    {{-- Section 2 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">02</span> Description of Service</h2>
                        <p>Listee is an online classified advertising platform where users can post and browse advertisements for products, services, and properties. We act solely as an intermediary connecting buyers and sellers. Listee does not participate in any transactions between users.</p>
                    </div>

                    {{-- Section 3 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">03</span> User Responsibilities</h2>
                        <p>As a user of Listee, you agree to the following responsibilities:</p>
                        <ul class="terms-list">
                            <li><i class="fas fa-check-circle"></i> Provide accurate and truthful information in all listings and profile details</li>
                            <li><i class="fas fa-check-circle"></i> Do not post advertisements for illegal products or services</li>
                            <li><i class="fas fa-check-circle"></i> Treat other users with courtesy and respect</li>
                            <li><i class="fas fa-check-circle"></i> Maintain the security of your account credentials</li>
                            <li><i class="fas fa-check-circle"></i> Do not use copyrighted content without proper authorization</li>
                            <li><i class="fas fa-check-circle"></i> Do not post spam or misleading advertisements</li>
                            <li><i class="fas fa-check-circle"></i> Comply with all applicable local and national laws</li>
                        </ul>
                    </div>

                    {{-- Section 4 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">04</span> Listing Policy</h2>
                        <p>The following types of listings are strictly prohibited on Listee:</p>
                        <div class="prohibited-list">
                            <div class="prohibited-item">
                                <i class="fas fa-times-circle"></i>
                                <span>Drugs, narcotics, weapons, or explosives</span>
                            </div>
                            <div class="prohibited-item">
                                <i class="fas fa-times-circle"></i>
                                <span>Obscene, offensive, or adult content</span>
                            </div>
                            <div class="prohibited-item">
                                <i class="fas fa-times-circle"></i>
                                <span>Stolen goods or counterfeit products</span>
                            </div>
                            <div class="prohibited-item">
                                <i class="fas fa-times-circle"></i>
                                <span>Fraudulent or misleading advertisements</span>
                            </div>
                            <div class="prohibited-item">
                                <i class="fas fa-times-circle"></i>
                                <span>Personal information of others without consent</span>
                            </div>
                            <div class="prohibited-item">
                                <i class="fas fa-times-circle"></i>
                                <span>Any content that violates applicable laws</span>
                            </div>
                        </div>
                        <div class="terms-note mt-3">
                            <i class="fas fa-info-circle"></i>
                            <p>Listee reserves the right to remove any listing that violates these policies without prior notice.</p>
                        </div>
                    </div>

                    {{-- Section 5 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">05</span> Intellectual Property</h2>
                        <p>All content, design, logos, trademarks, and software on the Listee website are the property of Listee. No content may be copied, modified, or distributed without prior written permission. Content posted by users remains the intellectual property of the respective user, however by posting on Listee, users grant us a non-exclusive license to display the content on our platform.</p>
                    </div>

                    {{-- Section 6 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">06</span> Limitation of Liability</h2>
                        <p>Listee is not responsible for any transactions between buyers and sellers. We only provide a platform and do not guarantee the quality, authenticity, or legality of any product or service listed. Users must exercise their own judgment when conducting transactions.</p>
                        <div class="terms-highlight">
                            <h5><i class="fas fa-exclamation-triangle me-2"></i>Important</h5>
                            <p class="mb-0">Always meet in safe, public places when conducting in-person transactions. Never share sensitive financial information with other users through our platform.</p>
                        </div>
                    </div>

                    {{-- Section 7 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">07</span> Account Suspension / Termination</h2>
                        <p>Listee reserves the right to suspend or terminate any user's account at any time, with or without cause, particularly if there is a violation of these terms and conditions. Reasons for account suspension include but are not limited to:</p>
                        <ul class="terms-list">
                            <li><i class="fas fa-check-circle"></i> Violation of listing policies</li>
                            <li><i class="fas fa-check-circle"></i> Multiple reports from other users</li>
                            <li><i class="fas fa-check-circle"></i> Fraudulent activity</li>
                            <li><i class="fas fa-check-circle"></i> Spam or automated posting</li>
                            <li><i class="fas fa-check-circle"></i> Failure to comply with these terms</li>
                        </ul>
                    </div>

                    {{-- Section 8 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">08</span> Modifications</h2>
                        <p>Listee reserves the right to modify these Terms and Conditions at any time. Changes become effective immediately upon publication on the website. We recommend that users regularly review this page to stay informed of any updates. Continued use of the website after changes constitutes acceptance of the revised terms.</p>
                    </div>

                    {{-- Section 9 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">09</span> Governing Law</h2>
                        <p>These Terms and Conditions shall be governed by and construed in accordance with the laws of Bangladesh. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of the courts located in Dhaka, Bangladesh.</p>
                    </div>

                    {{-- Section 10 --}}
                    <div class="terms-section">
                        <h2><span class="section-num">10</span> Contact Us</h2>
                        <p>If you have any questions about these Terms and Conditions, please contact us:</p>
                        <div class="contact-info-box">
                            <div class="contact-info-item">
                                <i class="fas fa-envelope"></i>
                                <span>Email: support@listee.com</span>
                            </div>
                            <div class="contact-info-item">
                                <i class="fas fa-phone"></i>
                                <span>Phone: +880-1XXX-XXXXXX</span>
                            </div>
                            <div class="contact-info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Address: Dhaka, Bangladesh</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<style>
.terms-content-box {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 15px;
    padding: 40px 45px;
}
.terms-updated {
    color: #999;
    font-size: 13px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}
.terms-section {
    padding: 25px 0;
    border-bottom: 1px solid #f0f0f0;
}
.terms-section:last-child {
    border-bottom: none;
}
.terms-section h2 {
    font-size: 20px;
    font-weight: 700;
    color: #1b2a4a;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.section-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    background: #FFF5F5;
    color: #FF3B30;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 700;
    flex-shrink: 0;
}
.terms-section p {
    color: #555;
    font-size: 15px;
    line-height: 1.8;
    margin-bottom: 12px;
}
.terms-list {
    list-style: none;
    padding: 0;
    margin: 10px 0 0;
}
.terms-list li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 8px 0;
    color: #555;
    font-size: 14px;
}
.terms-list li i {
    color: #10B981;
    margin-top: 3px;
    flex-shrink: 0;
}
.prohibited-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 10px;
    margin-top: 12px;
}
.prohibited-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    background: #FFF5F5;
    border-radius: 8px;
    font-size: 13px;
    color: #555;
}
.prohibited-item i {
    color: #FF3B30;
    flex-shrink: 0;
}
.terms-note {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 15px;
    background: #F0F4FF;
    border-radius: 8px;
    border-left: 3px solid #3B82F6;
}
.terms-note i {
    color: #3B82F6;
    margin-top: 2px;
    flex-shrink: 0;
}
.terms-note p {
    margin: 0;
    font-size: 13px;
    color: #555;
}
.terms-highlight {
    background: #FFFBEB;
    border: 1px solid #FDE68A;
    border-radius: 10px;
    padding: 20px;
    margin-top: 15px;
}
.terms-highlight h5 {
    font-size: 15px;
    font-weight: 600;
    color: #D97706;
    margin-bottom: 8px;
}
.terms-highlight p {
    font-size: 13px;
    color: #92400E;
    line-height: 1.6;
}
.contact-info-box {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin-top: 10px;
}
.contact-info-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 0;
    font-size: 14px;
    color: #555;
}
.contact-info-item i {
    color: #FF3B30;
    width: 18px;
    text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
    .terms-content-box {
        padding: 25px 20px;
    }
    .prohibited-list {
        grid-template-columns: 1fr;
    }
}
</style>

@endsection