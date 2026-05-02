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

@endsection