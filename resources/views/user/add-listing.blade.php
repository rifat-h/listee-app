@extends('layouts.app')

@section('title', 'Add New Listing - Listee')

@section('content')

{{-- Breadcrumb --}}
@include('components.breadcrumb', [
    'title' => 'Add New Listing',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Dashboard', 'url' => route('user.dashboard')],
        ['name' => 'Add Listing']
    ]
])

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            @include('user._sidebar')

            {{-- Main Content --}}
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('user.store-listing') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Basic Information --}}
                    <div class="dashboard-card mb-4">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                        </div>

                        <div class="row">
                            {{-- Title --}}
                            <div class="col-12 mb-3">
                                <label class="form-label">Listing Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title') }}" placeholder="Enter your listing title" required>
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories ?? [] as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Sub Category --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sub Category</label>
                                <select name="sub_category_id" class="form-control" id="subCategory">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>

                            {{-- Price --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Price (৳) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                       value="{{ old('price') }}" placeholder="0.00" min="0" step="0.01" required>
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Price Type --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Price Type</label>
                                <select name="price_type" class="form-control">
                                    <option value="fixed" {{ old('price_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    <option value="negotiable" {{ old('price_type') == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                                    <option value="free" {{ old('price_type') == 'free' ? 'selected' : '' }}>Free</option>
                                    <option value="contact" {{ old('price_type') == 'contact' ? 'selected' : '' }}>Contact for Price</option>
                                </select>
                            </div>

                            {{-- Condition --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Condition</label>
                                <select name="condition" class="form-control">
                                    <option value="">Select Condition</option>
                                    <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="used" {{ old('condition') == 'used' ? 'selected' : '' }}>Used</option>
                                    <option value="refurbished" {{ old('condition') == 'refurbished' ? 'selected' : '' }}>Refurbished</option>
                                </select>
                            </div>

                            {{-- Description --}}
                            <div class="col-12 mb-3">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                          rows="5" placeholder="Describe your listing in detail..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Tags --}}
                            <div class="col-12 mb-3">
                                <label class="form-label">Tags</label>
                                <input type="text" name="tags" class="form-control" 
                                       value="{{ old('tags') }}" placeholder="Enter tags separated by commas (e.g., electronics, mobile, phone)">
                                <small class="text-muted">Separate tags with commas</small>
                            </div>
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="dashboard-card mb-4">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-images me-2"></i>Listing Images</h5>
                        </div>

                        <div class="image-upload-area" id="imageUploadArea">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <h6>Drag & Drop Images Here</h6>
                                <p>or click to browse (Max 5 images, 5MB each)</p>
                                <label for="imageInput" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-plus me-1"></i> Choose Images
                                </label>
                            </div>
                            <input type="file" name="images[]" id="imageInput" class="d-none" 
                                   multiple accept="image/*" max="5">
                        </div>
                        <div class="image-preview-grid" id="imagePreviewGrid"></div>
                        @error('images')
                            <span class="text-danger" style="font-size:13px;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Location --}}
                    <div class="dashboard-card mb-4">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-map-marker-alt me-2"></i>Location Details</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Location / City <span class="text-danger">*</span></label>
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" 
                                       value="{{ old('location') }}" placeholder="e.g., Dhaka, Chittagong" required>
                                @error('location')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Address</label>
                                <input type="text" name="address" class="form-control" 
                                       value="{{ old('address') }}" placeholder="Street address">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Latitude</label>
                                <input type="text" name="latitude" class="form-control" 
                                       value="{{ old('latitude') }}" placeholder="e.g., 23.8103" id="latitude">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Longitude</label>
                                <input type="text" name="longitude" class="form-control" 
                                       value="{{ old('longitude') }}" placeholder="e.g., 90.4125" id="longitude">
                            </div>
                            <div class="col-12">
                                <div id="locationMap" class="location-map-preview"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="dashboard-card mb-4">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-phone-alt me-2"></i>Contact Information</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Name</label>
                                <input type="text" name="contact_name" class="form-control" 
                                       value="{{ old('contact_name', auth()->user()->name) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Phone</label>
                                <input type="text" name="contact_phone" class="form-control" 
                                       value="{{ old('contact_phone', auth()->user()->phone) }}" placeholder="+880 1XXXXXXXXX">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Email</label>
                                <input type="email" name="contact_email" class="form-control" 
                                       value="{{ old('contact_email', auth()->user()->email) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Website</label>
                                <input type="url" name="contact_website" class="form-control" 
                                       value="{{ old('contact_website') }}" placeholder="https://example.com">
                            </div>
                        </div>
                    </div>

                    {{-- Submit Buttons --}}
                    <div class="submit-actions">
                        <button type="submit" name="status" value="active" class="btn btn-primary btn-submit">
                            <i class="fas fa-paper-plane me-1"></i> Publish Listing
                        </button>
                        <button type="submit" name="status" value="draft" class="btn btn-outline-secondary btn-submit">
                            <i class="fas fa-save me-1"></i> Save as Draft
                        </button>
                        <a href="{{ route('user.my-listings') }}" class="btn btn-outline-danger btn-submit">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<style>
.image-upload-area {
    border: 2px dashed #ddd;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    transition: border-color 0.3s;
    cursor: pointer;
    margin-bottom: 15px;
}
.image-upload-area:hover,
.image-upload-area.dragover {
    border-color: #FF3B30;
    background: #FFF5F5;
}
.upload-placeholder i {
    font-size: 40px;
    color: #ccc;
    margin-bottom: 10px;
}
.upload-placeholder h6 {
    font-size: 15px;
    color: #666;
    margin-bottom: 5px;
}
.upload-placeholder p {
    font-size: 12px;
    color: #aaa;
    margin-bottom: 10px;
}
.image-preview-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.image-preview-item {
    position: relative;
    width: 100px;
    height: 100px;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e8e8e8;
}
.image-preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.image-preview-item .remove-image {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: #FF3B30;
    color: #fff;
    border: none;
    font-size: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}
.location-map-preview {
    height: 250px;
    background: #f0f0f0;
    border-radius: 8px;
    margin-top: 10px;
}
.submit-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.btn-submit {
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
}
.btn-submit.btn-primary {
    background: #FF3B30;
    border-color: #FF3B30;
}
.btn-submit.btn-primary:hover {
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
// Image Upload Preview
var imageInput = document.getElementById('imageInput');
var previewGrid = document.getElementById('imagePreviewGrid');
var uploadArea = document.getElementById('imageUploadArea');

uploadArea?.addEventListener('click', function(e) {
    if (e.target.tagName !== 'INPUT') imageInput.click();
});

// Drag & Drop
uploadArea?.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('dragover');
});
uploadArea?.addEventListener('dragleave', function() {
    this.classList.remove('dragover');
});
uploadArea?.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('dragover');
    imageInput.files = e.dataTransfer.files;
    showPreviews();
});

imageInput?.addEventListener('change', showPreviews);

function showPreviews() {
    previewGrid.innerHTML = '';
    var files = imageInput.files;
    for (var i = 0; i < Math.min(files.length, 5); i++) {
        var reader = new FileReader();
        reader.onload = (function(index) {
            return function(e) {
                var div = document.createElement('div');
                div.className = 'image-preview-item';
                div.innerHTML = '<img src="' + e.target.result + '" alt="Preview">' +
                    '<button type="button" class="remove-image" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>';
                previewGrid.appendChild(div);
            };
        })(i);
        reader.readAsDataURL(files[i]);
    }
}

// Sub Category AJAX
document.querySelector('[name="category_id"]')?.addEventListener('change', function() {
    var categoryId = this.value;
    var subSelect = document.getElementById('subCategory');
    subSelect.innerHTML = '<option value="">Loading...</option>';
    
    if (categoryId) {
        fetch('/api/subcategories/' + categoryId)
            .then(r => r.json())
            .then(data => {
                subSelect.innerHTML = '<option value="">Select Sub Category</option>';
                data.forEach(function(sub) {
                    subSelect.innerHTML += '<option value="' + sub.id + '">' + sub.name + '</option>';
                });
            })
            .catch(() => {
                subSelect.innerHTML = '<option value="">Select Sub Category</option>';
            });
    } else {
        subSelect.innerHTML = '<option value="">Select Sub Category</option>';
    }
});
</script>
@endpush

@endsection