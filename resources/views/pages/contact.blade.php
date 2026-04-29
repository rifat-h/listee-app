@extends('layouts.app')

@section('title', 'Contact Us - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Contact Us',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Contact Us']
    ]
])

<section class="contact-section py-5">
    <div class="container">
        <div class="row">

            {{-- Contact Info Cards --}}
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="contact-info-card text-center">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h5>Our Address</h5>
                    <p>123 Main Street, Gulshan<br>Dhaka 1212, Bangladesh</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="contact-info-card text-center">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h5>Call Us</h5>
                    <p>
                        <a href="tel:+8801XXXXXXXXX">+880 1XXX-XXXXXX</a><br>
                        <a href="tel:+8801XXXXXXXXX">+880 1XXX-XXXXXX</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="contact-info-card text-center">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h5>Email Us</h5>
                    <p>
                        <a href="mailto:info@listee.com">info@listee.com</a><br>
                        <a href="mailto:support@listee.com">support@listee.com</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            {{-- Contact Form --}}
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h4><i class="fas fa-paper-plane me-2"></i>Send Us a Message</h4>
                    <p class="text-muted mb-4">Fill out the form below and we'll get back to you as soon as possible.</p>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            @foreach($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" 
                                       value="{{ old('name', auth()->user()->name ?? '') }}" 
                                       placeholder="Your full name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" 
                                       value="{{ old('email', auth()->user()->email ?? '') }}" 
                                       placeholder="your@email.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" 
                                       value="{{ old('phone') }}" placeholder="+880 1XXXXXXXXX">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subject <span class="text-danger">*</span></label>
                                <select name="subject" class="form-control" required>
                                    <option value="">Select Subject</option>
                                    <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Technical Support</option>
                                    <option value="billing" {{ old('subject') == 'billing' ? 'selected' : '' }}>Billing Issue</option>
                                    <option value="report" {{ old('subject') == 'report' ? 'selected' : '' }}>Report a Listing</option>
                                    <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                                    <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="5" 
                                          placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-contact">
                                    <i class="fas fa-paper-plane me-1"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Map & Working Hours --}}
            <div class="col-lg-5">
                {{-- Map --}}
                <div class="contact-map-card mb-4">
                    <div id="contactMap" class="contact-map"></div>
                </div>

                {{-- Working Hours --}}
                <div class="working-hours-card">
                    <h5><i class="far fa-clock me-2"></i>Working Hours</h5>
                    <ul class="hours-list">
                        <li>
                            <span>Saturday - Thursday</span>
                            <span>9:00 AM - 6:00 PM</span>
                        </li>
                        <li>
                            <span>Friday</span>
                            <span class="text-danger">Closed</span>
                        </li>
                    </ul>

                    <h5 class="mt-4"><i class="fas fa-share-alt me-2"></i>Follow Us</h5>
                    <div class="contact-social">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.contact-info-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 30px 20px;
    transition: all 0.3s ease;
    height: 100%;
}
.contact-info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}
.contact-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #FFF5F5;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
}
.contact-icon i {
    font-size: 22px;
    color: #FF3B30;
}
.contact-info-card h5 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}
.contact-info-card p {
    font-size: 13px;
    color: #888;
    margin: 0;
    line-height: 1.7;
}
.contact-info-card a {
    color: #888;
    text-decoration: none;
}
.contact-info-card a:hover {
    color: #FF3B30;
}
.contact-form-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 30px;
}
.contact-form-card h4 {
    font-size: 20px;
    font-weight: 700;
    color: #333;
}
.contact-form-card .form-label {
    font-size: 13px;
    font-weight: 600;
    color: #555;
}
.contact-form-card .form-control {
    height: 44px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    font-size: 14px;
}
.contact-form-card textarea.form-control {
    height: auto;
}
.contact-form-card .form-control:focus {
    border-color: #FF3B30;
    box-shadow: 0 0 0 3px rgba(255,59,48,0.1);
}
.btn-contact {
    background: #FF3B30;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 15px;
    color: #fff;
}
.btn-contact:hover {
    background: #E0352B;
    color: #fff;
}
.contact-map-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    overflow: hidden;
}
.contact-map {
    height: 250px;
    background: #f0f0f0;
}
.working-hours-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 25px;
}
.working-hours-card h5 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 15px;
}
.hours-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.hours-list li {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
    font-size: 14px;
    color: #555;
}
.hours-list li:last-child {
    border-bottom: none;
}
.contact-social {
    display: flex;
    gap: 10px;
}
.social-link {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #888;
    text-decoration: none;
    transition: all 0.3s;
}
.social-link:hover {
    background: #FF3B30;
    color: #fff;
}
</style>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('contactMap').setView([23.7937, 90.4066], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);
    L.marker([23.7937, 90.4066]).addTo(map)
        .bindPopup('<strong>Listee Office</strong><br>123 Main Street, Gulshan, Dhaka')
        .openPopup();
});
</script>
@endpush

@endsection