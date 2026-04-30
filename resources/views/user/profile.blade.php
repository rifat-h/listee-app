@extends('layouts.app')

@section('title', 'Profile - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Profile',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Profile']
    ]
])

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row">

            {{-- Tab Navigation --}}
            @include('user._sidebar')

            {{-- Main Content --}}
            <div class="col-12">
                {{-- Success/Error Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        @foreach($errors->all() as $error)
                            <p class="mb-0"><i class="fas fa-exclamation-circle me-1"></i>{{ $error }}</p>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row">
                    {{-- Profile Details --}}
                    <div class="col-lg-8">
                        <div class="profile-card">
                            <h5 class="profile-card-title">Profile Details</h5>

                            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Avatar Upload Row --}}
                                <div class="profile-avatar-row mb-4">
                                    <div class="profile-avatar-circle">
                                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}" 
                                             alt="Avatar" id="avatarImg">
                                    </div>
                                    <label for="avatarInput" class="btn btn-upload-photo">
                                        <i class="fas fa-cloud-upload-alt me-1"></i> Upload New photo
                                    </label>
                                    <span class="upload-hint">Max file size: 10 MB</span>
                                    <input type="file" name="avatar" id="avatarInput" class="d-none" accept="image/*">
                                    <button type="button" class="btn btn-avatar-delete" title="Remove photo">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>

                                {{-- Your Full Name --}}
                                <div class="mb-3">
                                    <label class="profile-label">Your Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text profile-input-icon"><i class="fas fa-user"></i></span>
                                        <input type="text" name="name" class="form-control profile-input" 
                                               value="{{ old('name', auth()->user()->name) }}" required>
                                    </div>
                                </div>

                                {{-- Phone & Email --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="profile-label">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text profile-input-icon"><i class="fas fa-phone-alt"></i></span>
                                            <input type="text" name="phone" class="form-control profile-input" 
                                                   value="{{ old('phone', auth()->user()->phone) }}" 
                                                   placeholder="+44 215346 1223">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="profile-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text profile-input-icon"><i class="fas fa-envelope"></i></span>
                                            <input type="email" name="email" class="form-control profile-input" 
                                                   value="{{ old('email', auth()->user()->email) }}" required>
                                        </div>
                                    </div>
                                </div>

                                {{-- Notes --}}
                                <div class="mb-3">
                                    <label class="profile-label">Notes</label>
                                    <textarea name="about" class="form-control profile-input" rows="4" 
                                              placeholder="Write something about yourself...">{{ old('about', auth()->user()->about) }}</textarea>
                                </div>

                                {{-- Social Links --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="profile-label">Facebook</label>
                                        <div class="input-group">
                                            <span class="input-group-text profile-input-icon"><i class="fab fa-facebook-f"></i></span>
                                            <input type="url" name="facebook" class="form-control profile-input" 
                                                   value="{{ old('facebook', auth()->user()->facebook) }}" 
                                                   placeholder="https://www.facebook.com/">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="profile-label">Twitter</label>
                                        <div class="input-group">
                                            <span class="input-group-text profile-input-icon"><i class="fab fa-twitter"></i></span>
                                            <input type="url" name="twitter" class="form-control profile-input" 
                                                   value="{{ old('twitter', auth()->user()->twitter) }}" 
                                                   placeholder="https://twitter.com/">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="profile-label">Google+</label>
                                        <div class="input-group">
                                            <span class="input-group-text profile-input-icon"><i class="fab fa-google-plus-g"></i></span>
                                            <input type="url" name="google_plus" class="form-control profile-input" 
                                                   value="{{ old('google_plus', auth()->user()->google_plus ?? '') }}" 
                                                   placeholder="https://www.google.com/">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="profile-label">Instagram</label>
                                        <div class="input-group">
                                            <span class="input-group-text profile-input-icon"><i class="fab fa-instagram"></i></span>
                                            <input type="url" name="instagram" class="form-control profile-input" 
                                                   value="{{ old('instagram', auth()->user()->instagram) }}" 
                                                   placeholder="https://www.instagram.com/">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-save-profile">
                                    <i class="fas fa-save me-1"></i> Save Changes
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Change Password --}}
                    <div class="col-lg-4">
                        <div class="profile-card">
                            <h5 class="profile-card-title">Change Password</h5>

                            <form action="{{ route('user.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="profile-label">Current Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text profile-input-icon"><i class="fas fa-lock"></i></span>
                                        <input type="password" name="current_password" class="form-control profile-input" placeholder="Password">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="profile-label">New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text profile-input-icon"><i class="fas fa-lock"></i></span>
                                        <input type="password" name="password" class="form-control profile-input" id="newPassword">
                                        <button type="button" class="btn btn-outline-secondary password-toggle" onclick="togglePassword('newPassword', this)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="profile-label">Confirm New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text profile-input-icon"><i class="fas fa-lock"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control profile-input" id="confirmPassword">
                                        <button type="button" class="btn btn-outline-secondary password-toggle" onclick="togglePassword('confirmPassword', this)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-change-password w-100">
                                    Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.profile-card {
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
}
.profile-card-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #333;
}
.profile-avatar-row {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}
.profile-avatar-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #e8e8e8;
    flex-shrink: 0;
}
.profile-avatar-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.btn-upload-photo {
    background: #d32f2f;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
}
.btn-upload-photo:hover {
    background: #b71c1c;
    color: #fff;
}
.upload-hint {
    font-size: 13px;
    color: #888;
}
.btn-avatar-delete {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #d32f2f;
    color: #fff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    cursor: pointer;
    margin-left: auto;
}
.btn-avatar-delete:hover {
    background: #b71c1c;
}
.profile-label {
    font-size: 13px;
    font-weight: 500;
    color: #555;
    margin-bottom: 6px;
    display: block;
}
.profile-input-icon {
    background: #fff;
    border-color: #e0e0e0;
    color: #999;
}
.profile-input {
    height: 46px;
    border-color: #e0e0e0;
    font-size: 14px;
}
.profile-input:focus {
    border-color: #d32f2f;
    box-shadow: 0 0 0 3px rgba(211,47,47,0.1);
}
textarea.profile-input {
    height: auto;
}
.btn-save-profile {
    background: #d32f2f;
    color: #fff;
    border: none;
    padding: 10px 30px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
}
.btn-save-profile:hover {
    background: #b71c1c;
    color: #fff;
}
.btn-change-password {
    background: #d32f2f;
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
}
.btn-change-password:hover {
    background: #b71c1c;
    color: #fff;
}
.password-toggle {
    border-color: #e0e0e0;
    color: #999;
}
.password-toggle:hover {
    color: #333;
}
</style>

@push('scripts')
<script>
document.getElementById('avatarInput')?.addEventListener('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(event) {
        document.getElementById('avatarImg').src = event.target.result;
    };
    if (e.target.files[0]) {
        reader.readAsDataURL(e.target.files[0]);
    }
});

function togglePassword(inputId, btn) {
    var input = document.getElementById(inputId);
    var icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush

@endsection
