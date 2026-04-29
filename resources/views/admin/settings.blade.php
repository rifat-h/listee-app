@extends('layouts.app')

@section('title', 'Settings - Admin')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4"><i class="fas fa-cog text-danger"></i> Settings</h2>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Site Settings</h5>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Site Name</label>
                                <input type="text" class="form-control" value="{{ config('app.name') }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Site URL</label>
                                <input type="text" class="form-control" value="{{ config('app.url') }}" disabled>
                            </div>
                            <p class="text-muted small">Settings management coming soon.</p>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">System Info</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Laravel Version</span>
                                <span class="badge bg-secondary">{{ app()->version() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>PHP Version</span>
                                <span class="badge bg-secondary">{{ phpversion() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Environment</span>
                                <span class="badge bg-secondary">{{ config('app.env') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
