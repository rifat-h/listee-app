@extends('layouts.app')

@section('title', 'Settings - Admin')

@section('content')

@include('components.breadcrumb', [
    'title' => 'Settings',
    'breadcrumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Admin', 'url' => route('admin.dashboard')],
        ['name' => 'Settings']
    ]
])

<section class="admin-section py-5">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-4">
                @include('admin._sidebar')
            </div>

            {{-- Main Content --}}
            <div class="col-lg-9 col-md-8">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- General Settings --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="fw-bold mb-0">General Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Site Name</label>
                                    <input type="text" class="form-control" value="{{ config('app.name', 'Listee') }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Site URL</label>
                                    <input type="text" class="form-control" value="{{ config('app.url') }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Contact Email</label>
                                    <input type="email" class="form-control" placeholder="info@listee.com" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Contact Phone</label>
                                    <input type="text" class="form-control" placeholder="+880 1XXX-XXXXXX" disabled>
                                </div>
                            </div>
                            <p class="text-muted mt-3 mb-0">
                                <i class="fas fa-info-circle"></i> Settings can be configured in the <code>.env</code> file.
                            </p>
                        </form>
                    </div>
                </div>

                {{-- System Info --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="fw-bold mb-0">System Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="fw-bold" width="200">Laravel Version</td>
                                <td>{{ app()->version() }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">PHP Version</td>
                                <td>{{ phpversion() }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Environment</td>
                                <td>{{ config('app.env') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Debug Mode</td>
                                <td>
                                    @if(config('app.debug'))
                                        <span class="badge bg-warning text-dark">Enabled</span>
                                    @else
                                        <span class="badge bg-success">Disabled</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
