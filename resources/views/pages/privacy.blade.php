@extends('layouts.app')

@section('title', 'Privacy Policy - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Privacy Policy',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Privacy Policy']
    ]
])

<section class="privacy-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="privacy-content-box">

                    <div class="privacy-updated mb-4">
                        <i class="far fa-calendar-alt me-1"></i> Last Updated: {{ date('d F, Y') }}
                    </div>

                    {{-- Quick Navigation --}}
                    <div class="privacy-nav mb-4">
                        <h5>Quick Navigation</h5>
                        <div class="privacy-nav-links">
                            <a href="#section-1">Introduction</a>
                            <a href="#section-2">Information We Collect</a>
                            <a href="#section-3">How We Use Information</a>
                            <a href="#section-4">Cookies Policy</a>
                            <a href="#section-5">Information Sharing</a>
                            <a href="#section-6">Data Security</a>
                            <a href="#section-7">Your Rights</a>
                            <a href="#section-8">Contact Us</a>
                        </div>
                    </div>

                    {{-- Section 1 --}}
                    <div class="privacy-section" id="section-1">
                        <h2><span class="section-num">01</span> Introduction</h2>
                        <p>Listee takes your privacy very seriously. This Privacy Policy explains how we collect, use, store, and protect your personal information. By using our website, you agree to the practices described in this policy.</p>
                        <p>This policy applies to all users of the Listee platform, including buyers, sellers, and visitors who browse our website without registering.</p>
                    </div>

                    {{-- Section 2 --}}
                    <div class="privacy-section" id="section-2">
                        <h2><span class="section-num">02</span> Information We Collect</h2>
                        <p>We may collect the following types of information:</p>

                        <div class="info-type-card mb-3">
                            <div class="info-type-header">
                                <i class="fas fa-user"></i>
                                <h5>Personal Information</h5>
                            </div>
                            <ul class="info-list">
                                <li>Name, email address, phone number</li>
                                <li>Address and location information</li>
                                <li>Profile picture</li>
                                <li>Payment information (for premium services)</li>
                                <li>Identity verification documents (when required)</li>
                            </ul>
                        </div>

                        <div class="info-type-card mb-3">
                            <div class="info-type-header">
                                <i class="fas fa-laptop"></i>
                                <h5>Automatically Collected Information</h5>
                            </div>
                            <ul class="info-list">
                                <li>IP address and browser information</li>
                                <li>Device type, operating system</li>
                                <li>Cookies and session data</li>
                                <li>Pages visited and time spent</li>
                                <li>Referral source / how you found us</li>
                            </ul>
                        </div>

                        <div class="info-type-card">
                            <div class="info-type-header">
                                <i class="fas fa-ad"></i>
                                <h5>Listing Information</h5>
                            </div>
                            <ul class="info-list">
                                <li>Ad titles, descriptions, and photos</li>
                                <li>Pricing and category data</li>
                                <li>Location associated with listings</li>
                                <li>Communication between users</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Section 3 --}}
                    <div class="privacy-section" id="section-3">
                        <h2><span class="section-num">03</span> How We Use Your Information</h2>
                        <p>Your information is used for the following purposes:</p>
                        <div class="usage-grid">
                            <div class="usage-item">
                                <i class="fas fa-user-cog"></i>
                                <span>Account creation & management</span>
                            </div>
                            <div class="usage-item">
                                <i class="fas fa-bullhorn"></i>
                                <span>Publishing & managing your ads</span>
                            </div>
                            <div class="usage-item">
                                <i class="fas fa-comments"></i>
                                <span>Facilitating buyer-seller communication</span>
                            </div>
                            <div class="usage-item">
                                <i class="fas fa-chart-line"></i>
                                <span>Improving website experience</span>
                            </div>
                            <div class="usage-item">
                                <i class="fas fa-shield-alt"></i>
                                <span>Security & fraud prevention</span>
                            </div>
                            <div class="usage-item">
                                <i class="fas fa-gavel"></i>
                                <span>Legal compliance & obligations</span>
                            </div>
                            <div class="usage-item">
                                <i class="fas fa-bell"></i>
                                <span>Notifications & important updates</span>
                            </div>
                            <div class="usage-item">
                                <i class="fas fa-star"></i>
                                <span>Personalized recommendations</span>
                            </div>
                        </div>
                    </div>

                    {{-- Section 4 --}}
                    <div class="privacy-section" id="section-4">
                        <h2><span class="section-num">04</span> Cookies Policy</h2>
                        <p>We use cookies to improve your browsing experience. Cookies are small text files stored on your device. We use the following types of cookies:</p>

                        <div class="cookies-grid">
                            <div class="cookie-type-card cookie-essential">
                                <div class="cookie-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <h5>Essential Cookies</h5>
                                <p>Required for basic site functionality like login sessions and security.</p>
                                <span class="cookie-badge">Required</span>
                            </div>
                            <div class="cookie-type-card cookie-analytics">
                                <div class="cookie-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <h5>Analytics Cookies</h5>
                                <p>Help us understand how visitors use our website to improve performance.</p>
                                <span class="cookie-badge">Optional</span>
                            </div>
                            <div class="cookie-type-card cookie-preference">
                                <div class="cookie-icon">
                                    <i class="fas fa-sliders-h"></i>
                                </div>
                                <h5>Preference Cookies</h5>
                                <p>Remember your settings and preferences for a better experience.</p>
                                <span class="cookie-badge">Optional</span>
                            </div>
                        </div>

                        <div class="privacy-note mt-3">
                            <i class="fas fa-info-circle"></i>
                            <p>You can manage your cookie preferences through your browser settings. Disabling essential cookies may affect the functionality of the website.</p>
                        </div>
                    </div>

                    {{-- Section 5 --}}
                    <div class="privacy-section" id="section-5">
                        <h2><span class="section-num">05</span> Information Sharing</h2>
                        <p>We do not sell your personal information to third parties. However, information may be shared in the following circumstances:</p>
                        <ul class="terms-list">
                            <li><i class="fas fa-check-circle"></i> When required by law or legal proceedings</li>
                            <li><i class="fas fa-check-circle"></i> With payment processing partners for premium services</li>
                            <li><i class="fas fa-check-circle"></i> With service providers who assist in operating our platform (limited basis)</li>
                            <li><i class="fas fa-check-circle"></i> With your explicit consent</li>
                            <li><i class="fas fa-check-circle"></i> To protect the rights and safety of Listee and its users</li>
                        </ul>
                    </div>

                    {{-- Section 6 --}}
                    <div class="privacy-section" id="section-6">
                        <h2><span class="section-num">06</span> Data Security</h2>
                        <p>We use advanced security measures to protect your information:</p>
                        <div class="security-grid">
                            <div class="security-item">
                                <div class="security-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <h6>SSL Encryption</h6>
                                <p>All data transmitted is encrypted using SSL technology</p>
                            </div>
                            <div class="security-item">
                                <div class="security-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h6>Regular Audits</h6>
                                <p>Periodic security audits to identify vulnerabilities</p>
                            </div>
                            <div class="security-item">
                                <div class="security-icon">
                                    <i class="fas fa-key"></i>
                                </div>
                                <h6>Access Control</h6>
                                <p>Limited access to personal data by authorized personnel only</p>
                            </div>
                            <div class="security-item">
                                <div class="security-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <h6>Data Backups</h6>
                                <p>Regular backups to prevent data loss</p>
                            </div>
                        </div>
                    </div>

                    {{-- Section 7 --}}
                    <div class="privacy-section" id="section-7">
                        <h2><span class="section-num">07</span> Your Rights</h2>
                        <p>You have the following rights regarding your personal data:</p>
                        <div class="rights-grid">
                            <div class="right-item">
                                <i class="fas fa-eye"></i>
                                <div>
                                    <h6>Right to Access</h6>
                                    <p>View all personal data we hold about you</p>
                                </div>
                            </div>
                            <div class="right-item">
                                <i class="fas fa-edit"></i>
                                <div>
                                    <h6>Right to Rectification</h6>
                                    <p>Correct inaccurate or incomplete data</p>
                                </div>
                            </div>
                            <div class="right-item">
                                <i class="fas fa-trash-alt"></i>
                                <div>
                                    <h6>Right to Erasure</h6>
                                    <p>Request deletion of your personal data</p>
                                </div>
                            </div>
                            <div class="right-item">
                                <i class="fas fa-download"></i>
                                <div>
                                    <h6>Right to Portability</h6>
                                    <p>Receive your data in a portable format</p>
                                </div>
                            </div>
                            <div class="right-item">
                                <i class="fas fa-ban"></i>
                                <div>
                                    <h6>Right to Object</h6>
                                    <p>Object to processing of your data</p>
                                </div>
                            </div>
                            <div class="right-item">
                                <i class="fas fa-hand-paper"></i>
                                <div>
                                    <h6>Right to Restrict</h6>
                                    <p>Restrict how we process your data</p>
                                </div>
                            </div>
                        </div>
                        <div class="privacy-note mt-3">
                            <i class="fas fa-info-circle"></i>
                            <p>To exercise any of these rights, please contact us at privacy@listee.com. We will respond within 30 days of receiving your request.</p>
                        </div>
                    </div>

                    {{-- Section 8 --}}
                    <div class="privacy-section" id="section-8">
                        <h2><span class="section-num">08</span> Contact Us</h2>
                        <p>For any privacy-related questions or concerns, please contact us:</p>
                        <div class="contact-info-box">
                            <div class="contact-info-item">
                                <i class="fas fa-envelope"></i>
                                <span>Email: privacy@listee.com</span>
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