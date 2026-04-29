@extends('layouts.app')

@section('title', 'Edit Profile - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Edit Profile',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Dashboard', 'url' => route('user.dashboard')],
        ['name' => 'Profile']
    ]
])

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            @include('user._sidebar')

            {{-- Main Content --}}
            <div class="col-lg-9 col-md-8">
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

                {{-- Profile Info Form --}}
                <div class="dashboard-card mb-4">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-user-edit me-2"></i>Personal Information</h5>
                    </div>

                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Avatar Upload --}}
                        <div class="profile-avatar-upload text-center mb-4">
                            <div class="avatar-preview" id="avatarPreview">
                                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}" 
                                     alt="Avatar" id="avatarImg">
                            </div>
                            <label for="avatarInput" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="fas fa-camera me-1"></i> Change Photo
                            </label>
                            <input type="file" name="avatar" id="avatarInput" class="d-none" accept="image/*">
                            <p class="text-muted mt-1" style="font-size:11px;">Max 2MB. JPG, PNG format.</p>
                        </div>

                        <div class="row">
                            {{-- Name --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" 
                                       value="{{ old('name', auth()->user()->name) }}" required>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" 
                                       value="{{ old('email', auth()->user()->email) }}" required>
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" 
                                       value="{{ old('phone', auth()->user()->phone) }}" 
                                       placeholder="+880 1XXXXXXXXX">
                            </div>

                            {{-- Location --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" class="form-control" 
                                       value="{{ old('location', auth()->user()->location) }}" 
                                       placeholder="City, Country">
                            </div>

                            {{-- Website --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Website</label>
                                <input type="url" name="website" class="form-control" 
                                       value="{{ old('website', auth()->user()->website) }}" 
                                       placeholder="https://example.com">
                            </div>

                            {{-- Date of Birth --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" 
                                       value="{{ old('dob', auth()->user()->dob) }}">
                            </div>

                            {{-- About / Bio --}}
                            <div class="col-12 mb-3">
                                <label class="form-label">About Me</label>
                                <textarea name="about" class="form-control" rows="4" 
                                          placeholder="Write something about yourself...">{{ old('about', auth()->user()->about) }}</textarea>
                            </div>
                        </div>

                        {{-- Social Links --}}
                        <h6 class="section-subtitle mb-3"><i class="fas fa-share-alt me-1"></i> Social Links</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                                    <input type="url" name="facebook" class="form-control" 
                                           value="{{ old('facebook', auth()->user()->facebook) }}" 
                                           placeholder="Facebook URL">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                    <input type="url" name="twitter" class="form-control" 
                                           value="{{ old('twitter', auth()->user()->twitter) }}" 
                                           placeholder="Twitter URL">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                    <input type="url" name="instagram" class="form-control" 
                                           value="{{ old('instagram', auth()->user()->instagram) }}" 
                                           placeholder="Instagram URL">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-linkedin-in"></i></span>
                                    <input type="url" name="linkedin" class="form-control" 
                                           value="{{ old('linkedin', auth()->user()->linkedin) }}" 
                                           placeholder="LinkedIn URL">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-save">
                            <i class="fas fa-save me-1"></i> Save Changes
                        </button>
                    </form>
                </div>

                {{-- Change Password --}}
                <div class="dashboard-card">
                    <div class="card-header-custom">
                        <h5><i class="fas fa-lock me-2"></i>Change Password</h5>
                    </div>

                    <form action="{{ route('user.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Current Password <span class="text-danger">*</span></label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">New Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-save">
                            <i class="fas fa-key me-1"></i> Update Password
                        </button>
                    </form>
                </div>

                {{-- Delete Account --}}
                <div class="dashboard-card mt-4">
                    <div class="card-header-custom">
                        <h5 class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Danger Zone</h5>
                    </div>
                    <p class="text-muted mb-3" style="font-size:13px;">
                        Once you delete your account, all your data will be permanently removed. This action cannot be undone.
                    </p>
                    <form action="{{ route('user.account.delete') }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-trash-alt me-1"></i> Delete My Account
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
.profile-avatar-upload .avatar-preview {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto;
    border: 3px solid #FF3B30;
}
.profile-avatar-upload .avatar-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.section-subtitle {
    font-size: 15px;
    font-weight: 600;
    color: #333;
    padding-top: 10px;
    border-top: 1px solid #f0f0f0;
}
.input-group-text {
    width: 42px;
    justify-content: center;
    background: #f8f9fa;
    border-color: #e0e0e0;
    color: #888;
}
.btn-save {
    background: #FF3B30;
    border: none;
    padding: 10px 30px;
    border-radius: 8px;
    font-weight: 600;
}
.btn-save:hover {
    background: #E0352B;
}
.dashboard-card .form-label {
    font-size: 13px;
    font-weight: 600;
    color: #555;
}
.dashboard-card .form-control {
    height: 44px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    font-size: 14px;
}
.dashboard-card .form-control:focus {
    border-color: #FF3B30;
    box-shadow: 0 0 0 3px rgba(255,59,48,0.1);
}
.dashboard-card textarea.form-control {
    height: auto;
}
</style>

@push('scripts')
<script>
// Avatar preview
document.getElementById('avatarInput')?.addEventListener('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(event) {
        document.getElementById('avatarImg').src = event.target.result;
    };
    if (e.target.files[0]) {
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>
@endpush

@endsection