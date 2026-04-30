@extends('layouts.app')

@section('title', 'Contact Us - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Contact Us',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Contact us']
    ]
])

{{-- Map & Info Section --}}
<section class="contact-map-section py-5">
    <div class="container">
        <div class="row g-0 contact-map-row">
            {{-- Left: Photo with Hours & Contact overlay --}}
            <div class="col-lg-6">
                <div class="contact-photo-wrapper">
                    <img src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=800&q=80"
                         alt="Contact" class="contact-photo">
                    <div class="contact-overlay-card">
                        <h5>Hours</h5>
                        <p>Tuesday - Saturday : 9am - 5pm</p>
                        <p>Monday: 10:30am - 3pm Closed on Sunday</p>
                        <h5 class="mt-3">Contact Us</h5>
                        <p>132, My Street, Kingston, New York 12401</p>
                        <p>Tel : +088 01562 1452</p>
                        <p>Email : support@listee.com</p>
                    </div>
                </div>
            </div>
            {{-- Right: Google Map --}}
            <div class="col-lg-6">
                <div class="contact-map-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2964.123456!2d-74.0059!3d41.9270!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89dd0e30c2b6c72f%3A0x5b77e56e8c3e8e1a!2s132%20Kingston%20St%2C%20Kingston%2C%20NY%2012401!5e0!3m2!1sen!2sus!4v1700000000000"
                        width="100%" height="100%" style="border:0;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Contact Form Section --}}
<section class="contact-form-section py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="contact-heading">Contact Us</h2>
            <p class="text-muted">We are here to help you</p>
        </div>
        <div class="row align-items-center">
            {{-- Left: Illustration --}}
            <div class="col-lg-5 mb-4 mb-lg-0 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/3062/3062634.png"
                     alt="Contact Us" class="contact-illustration">
            </div>
            {{-- Right: Form --}}
            <div class="col-lg-7">
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

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control contact-input"
                               value="{{ old('name', auth()->user()->name ?? '') }}"
                               placeholder="Name*" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control contact-input"
                               value="{{ old('email', auth()->user()->email ?? '') }}"
                               placeholder="Email*" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="subject" class="form-control contact-input"
                               value="{{ old('subject') }}"
                               placeholder="Subject">
                    </div>
                    <div class="mb-3">
                        <textarea name="message" class="form-control contact-input" rows="5"
                                  placeholder="Write a Message*" required>{{ old('message') }}</textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
/* Map & Info Section */
.contact-map-row {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}
.contact-photo-wrapper {
    position: relative;
    height: 100%;
    min-height: 380px;
}
.contact-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    min-height: 380px;
}
.contact-overlay-card {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: #c0392b;
    color: #fff;
    padding: 25px 30px;
    border-radius: 8px;
    width: 85%;
    max-width: 400px;
    text-align: center;
}
.contact-overlay-card h5 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 8px;
    color: #fff;
}
.contact-overlay-card p {
    font-size: 13px;
    margin-bottom: 4px;
    color: rgba(255,255,255,0.9);
    line-height: 1.6;
}
.contact-map-wrapper {
    height: 100%;
    min-height: 380px;
}
.contact-map-wrapper iframe {
    height: 100%;
    min-height: 380px;
}

/* Contact Form Section */
.contact-heading {
    color: #c0392b;
    font-weight: 700;
    font-size: 28px;
}
.contact-illustration {
    max-width: 320px;
    width: 100%;
}
.contact-input {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 12px 15px;
    font-size: 14px;
    height: auto;
}
.contact-input:focus {
    border-color: #c0392b;
    box-shadow: 0 0 0 2px rgba(192,57,43,0.1);
}
textarea.contact-input {
    resize: vertical;
}
.btn-submit {
    background: #c0392b;
    color: #fff;
    border: none;
    padding: 10px 35px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 15px;
}
.btn-submit:hover {
    background: #a93226;
    color: #fff;
}

@media (max-width: 991px) {
    .contact-photo-wrapper,
    .contact-photo,
    .contact-map-wrapper,
    .contact-map-wrapper iframe {
        min-height: 300px;
    }
}
</style>

@endsection
